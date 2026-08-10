<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    /**
     * Atribut yang boleh diisi melalui mass assignment.
     */
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
    ];

    /**
     * Casting atribut.
     */
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    /**
     * User yang membuat konten.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Scope untuk konten yang sudah dipublikasikan.
     */
    public function scopePublished($query)
    {
        return $query
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope berdasarkan jenis konten.
     */
    public function scopeType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Apakah konten merupakan berita?
     */
    public function isNews(): bool
    {
        return $this->type === 'news';
    }

    /**
     * Apakah konten merupakan pengumuman?
     */
    public function isAnnouncement(): bool
    {
        return $this->type === 'announcement';
    }

    /**
     * Apakah konten merupakan regulasi?
     */
    public function isRegulation(): bool
    {
        return $this->type === 'regulation';
    }

    /**
     * Apakah konten sudah dipublikasikan?
     */
    public function isPublished(): bool
    {
        return $this->status === 'published'
            && $this->published_at !== null
            && $this->published_at->isPast();
    }
}