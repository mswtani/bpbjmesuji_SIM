<?php

namespace App\Services;

use App\Models\RegulationType;
use Illuminate\Support\Facades\DB;

class RegulationTypeOrderService
{
    /**
     * Menyisipkan jenis regulasi baru pada posisi tertentu.
     */
    public function create(array $data): RegulationType
    {
        return DB::transaction(function () use ($data) {

            /*
            |--------------------------------------------------------------------------
            | Lock seluruh data
            |--------------------------------------------------------------------------
            |
            | Karena jumlah jenis regulasi relatif kecil, kita mengunci seluruh
            | daftar agar dua proses bersamaan tidak menghasilkan urutan ganda.
            |
            */

            RegulationType::query()
                ->lockForUpdate()
                ->get();

            $total = RegulationType::count();

            /*
            |--------------------------------------------------------------------------
            | Tentukan posisi
            |--------------------------------------------------------------------------
            */

            $requestedPosition = isset($data['sort_order'])
                ? (int) $data['sort_order']
                : $total + 1;

            /*
            |--------------------------------------------------------------------------
            | Jika posisi kosong / terlalu kecil
            |--------------------------------------------------------------------------
            */

            if ($requestedPosition < 1) {
                $requestedPosition = 1;
            }

            /*
            |--------------------------------------------------------------------------
            | Jika melebihi posisi terakhir
            |--------------------------------------------------------------------------
            */

            if ($requestedPosition > $total + 1) {
                $requestedPosition = $total + 1;
            }

            /*
            |--------------------------------------------------------------------------
            | Geser data mulai posisi tersebut
            |--------------------------------------------------------------------------
            */

            RegulationType::query()
                ->where('sort_order', '>=', $requestedPosition)
                ->increment('sort_order');

            /*
            |--------------------------------------------------------------------------
            | Simpan posisi final
            |--------------------------------------------------------------------------
            */

            $data['sort_order'] = $requestedPosition;

            return RegulationType::create($data);
        });
    }


    /**
     * Memindahkan jenis regulasi ke posisi baru.
     */
    public function update(
        RegulationType $regulationType,
        array $data
    ): RegulationType {
        return DB::transaction(function () use (
            $regulationType,
            $data
        ) {

            /*
            |--------------------------------------------------------------------------
            | Lock seluruh data
            |--------------------------------------------------------------------------
            */

            RegulationType::query()
                ->lockForUpdate()
                ->get();

            /*
            |--------------------------------------------------------------------------
            | Ambil posisi lama
            |--------------------------------------------------------------------------
            */

            $oldPosition = (int) $regulationType->sort_order;

            $total = RegulationType::count();

            /*
            |--------------------------------------------------------------------------
            | Tentukan posisi baru
            |--------------------------------------------------------------------------
            */

            $newPosition = isset($data['sort_order'])
                ? (int) $data['sort_order']
                : $oldPosition;

            /*
            |--------------------------------------------------------------------------
            | Batasi posisi
            |--------------------------------------------------------------------------
            */

            if ($newPosition < 1) {
                $newPosition = 1;
            }

            if ($newPosition > $total) {
                $newPosition = $total;
            }

            /*
            |--------------------------------------------------------------------------
            | Pindah ke atas
            |--------------------------------------------------------------------------
            |
            | Contoh:
            |
            | Lama: 8
            | Baru: 3
            |
            | Posisi 3-7 digeser +1
            |
            */

            if ($newPosition < $oldPosition) {

                RegulationType::query()
                    ->whereKeyNot($regulationType->id)
                    ->whereBetween(
                        'sort_order',
                        [
                            $newPosition,
                            $oldPosition - 1,
                        ]
                    )
                    ->increment('sort_order');
            }

            /*
            |--------------------------------------------------------------------------
            | Pindah ke bawah
            |--------------------------------------------------------------------------
            |
            | Contoh:
            |
            | Lama: 3
            | Baru: 8
            |
            | Posisi 4-8 digeser -1
            |
            */

            if ($newPosition > $oldPosition) {

                RegulationType::query()
                    ->whereKeyNot($regulationType->id)
                    ->whereBetween(
                        'sort_order',
                        [
                            $oldPosition + 1,
                            $newPosition,
                        ]
                    )
                    ->decrement('sort_order');
            }

            /*
            |--------------------------------------------------------------------------
            | Simpan posisi baru
            |--------------------------------------------------------------------------
            */

            $data['sort_order'] = $newPosition;

            $regulationType->update($data);

            return $regulationType->fresh();
        });
    }


    /**
     * Menghapus jenis regulasi dan menutup celah urutan.
     */
    public function delete(
        RegulationType $regulationType
    ): void {
        DB::transaction(function () use ($regulationType) {

            /*
            |--------------------------------------------------------------------------
            | Lock seluruh data
            |--------------------------------------------------------------------------
            */

            RegulationType::query()
                ->lockForUpdate()
                ->get();

            $deletedPosition = (int) $regulationType->sort_order;

            /*
            |--------------------------------------------------------------------------
            | Hapus data
            |--------------------------------------------------------------------------
            */

            $regulationType->delete();

            /*
            |--------------------------------------------------------------------------
            | Tutup celah urutan
            |--------------------------------------------------------------------------
            |
            | Contoh:
            |
            | Sebelum:
            | 1
            | 2
            | 3 ← dihapus
            | 4
            | 5
            |
            | Sesudah:
            | 1
            | 2
            | 3
            | 4
            |
            */

            RegulationType::query()
                ->where('sort_order', '>', $deletedPosition)
                ->decrement('sort_order');
        });
    }
}