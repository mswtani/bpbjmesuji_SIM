<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegulationRelation extends Model
{
    protected $fillable = [
        'post_id',
        'related_post_id',
        'relation_type',
    ];


    /**
     * Regulasi yang menjadi sumber hubungan.
     *
     * Contoh:
     * Perbup A --amends--> Perbup B
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(
            Post::class,
            'post_id'
        );
    }


    /**
     * Regulasi yang menjadi tujuan hubungan.
     */
    public function relatedPost(): BelongsTo
    {
        return $this->belongsTo(
            Post::class,
            'related_post_id'
        );
    }
}