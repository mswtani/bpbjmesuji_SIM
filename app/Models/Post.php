<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\RegulationRelation;

class Post extends Model
{
    protected $fillable = [
        'author_id',
        'type',
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'status',
        'published_at',

        // Regulasi
        'regulation_type_id',
        'regulation_number',
        'regulation_year',
        'regulation_date',
        'legal_status',
        'document_path',
        'document_original_name',
        'document_size',
    ];


    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'regulation_date' => 'date',
            'regulation_year' => 'integer',
            'document_size' => 'integer',
        ];
    }


    /**
     * Author konten.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'author_id'
        );
    }


    /**
     * Jenis regulasi.
     */
    public function regulationType(): BelongsTo
    {
        return $this->belongsTo(
            RegulationType::class,
            'regulation_type_id'
        );
    }


    /**
     * Hubungan regulasi yang dibuat oleh regulasi ini.
     *
     * Misalnya:
     *
     * Perbup 5/2026
     *     └── repeals → Perbup 12/2021
     */
    public function regulationRelations(): HasMany
    {
        return $this->hasMany(
            RegulationRelation::class,
            'post_id'
        );
    }


    /**
     * Regulasi yang diubah oleh regulasi ini.
     */
    public function amendments(): HasMany
    {
        return $this->hasMany(
            RegulationRelation::class,
            'post_id'
        )->where(
            'relation_type',
            'amends'
        );
    }


    /**
     * Regulasi yang dicabut oleh regulasi ini.
     */
    public function repeals(): HasMany
    {
        return $this->hasMany(
            RegulationRelation::class,
            'post_id'
        )->where(
            'relation_type',
            'repeals'
        );
    }


    /**
     * Regulasi yang mengubah regulasi ini.
     *
     * Misalnya:
     *
     * Perbup 12/2021
     *     ↑
     * Perbup 5/2026
     */
    public function amendedBy(): HasMany
    {
        return $this->hasMany(
            RegulationRelation::class,
            'related_post_id'
        )->where(
            'relation_type',
            'amends'
        );
    }


    /**
     * Regulasi yang mencabut regulasi ini.
     */
    public function repealedBy(): HasMany
    {
        return $this->hasMany(
            RegulationRelation::class,
            'related_post_id'
        )->where(
            'relation_type',
            'repeals'
        );
    }
}