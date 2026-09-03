<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Position extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Position Codes
    |--------------------------------------------------------------------------
    */

    public const PENYEDIA = 'PENYEDIA';

    public const NON_PENYEDIA = 'NON_PENYEDIA';

    public const BUPATI = 'BUPATI';

    public const WAKIL_BUPATI = 'WAKIL_BUPATI';

    public const SEKDA = 'SEKDA';


    /**
     * Jabatan yang tidak boleh dipilih
     * melalui registrasi mandiri.
     */
    public static function restrictedForRegistration(): array
    {
        return [
            self::PENYEDIA,
            self::NON_PENYEDIA,
            self::BUPATI,
            self::WAKIL_BUPATI,
            self::SEKDA,
        ];
    }


    /**
     * User yang memiliki jabatan ini.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}