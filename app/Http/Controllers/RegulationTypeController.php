<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegulationTypeRequest;
use App\Http\Requests\UpdateRegulationTypeRequest;
use App\Models\RegulationType;
use App\Services\RegulationTypeOrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RegulationTypeController extends Controller
{
    public function index(Request $request): View
    {
        $perPage = (int) $request->input(
            'per_page',
            10
        );

        if (! in_array(
            $perPage,
            [10, 25, 50, 100]
        )) {
            $perPage = 10;
        }

        $query = RegulationType::query()
            ->orderBy('sort_order')
            ->orderBy('name');

        if ($request->filled('search')) {

            $search = $request
                ->string('search')
                ->toString();

            $query->where(function ($q) use ($search) {

                $q->where(
                    'name',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'description',
                    'like',
                    "%{$search}%"
                );

            });
        }

        if ($request->filled('status')) {

            $query->where(
                'is_active',
                $request->input('status') === 'active'
            );
        }

        $regulationTypes = $query
            ->paginate($perPage)
            ->withQueryString();

        return view('regulation-types.index', [
            'regulationTypes' => $regulationTypes,
            'perPage' => $perPage,
        ]);
    }


    public function create(): View
    {
        $nextSortOrder = (
            RegulationType::max('sort_order') ?? 0
        ) + 1;

        return view('regulation-types.create', [
            'nextSortOrder' => $nextSortOrder,
        ]);
    }


    public function store(
        StoreRegulationTypeRequest $request,
        RegulationTypeOrderService $orderService
        ): RedirectResponse {

        $data = $request->validated();

        $data['slug'] = Str::slug(
            $data['name']
        );

        /*
        |--------------------------------------------------------------------------
        | Default urutan otomatis
        |--------------------------------------------------------------------------
        |
        | Jika user mengosongkan urutan, gunakan urutan berikutnya.
        |
        */

        if (empty($data['sort_order'])) {

            $data['sort_order'] = (
                RegulationType::max('sort_order') ?? 0
            ) + 1;
        }

        $orderService->create($data);

        return redirect()
            ->route('regulation-types.index')
            ->with(
                'success',
                'Jenis regulasi berhasil ditambahkan.'
            );
    }


    public function edit(
        RegulationType $regulationType
    ): View {

        return view('regulation-types.edit', [
            'regulationType' => $regulationType,
        ]);
    }

    public function show(
        RegulationType $regulationType
    ): View {

        $regulationType->loadCount('posts');

        return view('regulation-types.show', [
            'regulationType' => $regulationType,
        ]);
    }


    public function update(
        UpdateRegulationTypeRequest $request,
        RegulationType $regulationType,
        RegulationTypeOrderService $orderService
    ): RedirectResponse {

        $data = $request->validated();

        $data['slug'] = Str::slug(
            $data['name']
        );

        $orderService->update(
            $regulationType,
            $data
        );

        return redirect()
            ->route('regulation-types.index')
            ->with(
                'success',
                'Jenis regulasi berhasil diperbarui.'
            );
    }


    /**
     * Mengecek apakah posisi urutan sudah digunakan.
     */
    public function checkPosition(Request $request)
    {
        $data = $request->validate([
            'sort_order' => [
                'nullable',
                'integer',
                'min:1',
            ],

            'ignore_id' => [
                'nullable',
                'integer',
                'exists:regulation_types,id',
            ],
        ]);

        $total = RegulationType::count();

        $isEdit = ! empty($data['ignore_id']);

        /*
        |--------------------------------------------------------------------------
        | Tentukan posisi maksimal
        |--------------------------------------------------------------------------
        |
        | Create:
        | Total 6 → posisi maksimal 7
        |
        | Edit:
        | Total 6 → posisi maksimal 6
        |
        */

        $maxPosition = $isEdit
            ? $total
            : $total + 1;

        $requestedPosition = isset($data['sort_order'])
            ? (int) $data['sort_order']
            : $maxPosition;

        /*
        |--------------------------------------------------------------------------
        | Tentukan apakah input melebihi batas
        |--------------------------------------------------------------------------
        */

        $isOutOfRange = $requestedPosition > $maxPosition;

        /*
        |--------------------------------------------------------------------------
        | Posisi final
        |--------------------------------------------------------------------------
        */

        $finalPosition = $requestedPosition;

        if ($finalPosition < 1) {
            $finalPosition = 1;
        }

        if ($finalPosition > $maxPosition) {
            $finalPosition = $maxPosition;
        }

        /*
        |--------------------------------------------------------------------------
        | Cek apakah posisi digunakan
        |--------------------------------------------------------------------------
        */

        $query = RegulationType::query()
            ->where(
                'sort_order',
                $requestedPosition
            );

        if (! empty($data['ignore_id'])) {

            $query->whereKeyNot(
                $data['ignore_id']
            );
        }

        $regulationType = $query->first();

        return response()->json([

            'exists' => (bool) $regulationType,

            'requested_position' => $requestedPosition,

            'max_position' => $maxPosition,

            'final_position' => $finalPosition,

            'is_out_of_range' => $isOutOfRange,

            'regulation_type' => $regulationType
                ? [
                    'id' => $regulationType->id,
                    'name' => $regulationType->name,
                ]
                : null,

        ]);
    }


    public function destroy(
        RegulationType $regulationType,
        RegulationTypeOrderService $orderService
    ): RedirectResponse {

        if ($regulationType->posts()->exists()) {

            return back()->with(
                'error',
                'Jenis regulasi tidak dapat dihapus karena masih digunakan oleh konten regulasi.'
            );
        }

        $orderService->delete(
            $regulationType
        );

        return redirect()
            ->route('regulation-types.index')
            ->with(
                'success',
                'Jenis regulasi berhasil dihapus.'
            );
    }
}