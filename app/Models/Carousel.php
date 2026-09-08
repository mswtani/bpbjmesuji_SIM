<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Carousel extends Model
{
    protected $fillable = [
        'post_id',
        'banner',
        'caption_type',
        'custom_title',
        'custom_description',
        'show_overlay',
        'show_button',
        'button_text',
        'sort_order',
        'is_active',
        'starts_at',
        'ends_at',
    ];

    protected $casts = [
        'show_overlay' => 'boolean',
        'show_button' => 'boolean',
        'is_active' => 'boolean',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    /**
     * Content yang ditampilkan pada Carousel.
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Apakah Carousel sedang aktif berdasarkan
     * status dan periode tayang.
     */
    public function isCurrentlyActive(): bool
    {
        $now = now();

        return $this->is_active
            && (
                is_null($this->starts_at)
                || $this->starts_at <= $now
            )
            && (
                is_null($this->ends_at)
                || $this->ends_at >= $now
            );
    }

    /**
     * Judul yang digunakan oleh Carousel.
     */
    public function getDisplayTitleAttribute(): ?string
    {
        return match ($this->caption_type) {
            'custom' => $this->custom_title,
            'auto' => $this->post?->title,
            default => null,
        };
    }

    /**
     * Deskripsi yang digunakan oleh Carousel.
     */
    public function getDisplayDescriptionAttribute(): ?string
    {
        return match ($this->caption_type) {
            'custom' => $this->custom_description,
            'auto' => $this->post?->excerpt
                ? strip_tags($this->post->excerpt)
                : null,
            default => null,
        };
}
}