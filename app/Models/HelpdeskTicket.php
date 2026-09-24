<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HelpdeskTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'position_id',
        'ticket_number',
        'access_token_hash',
        'access_token',
        'requester_name',
        'requester_email',
        'requester_phone',
        'subject',
        'status',
        'priority',
        'last_message_at',
        'closed_at',
    ];

    protected function casts(): array
    {
        return [
            'access_token' => 'encrypted',
            'last_message_at' => 'datetime',
            'closed_at' => 'datetime',
        ];
    }

    /**
     * User pemilik tiket.
     *
     * NULL jika tiket dibuat oleh guest.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Kategori tiket.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(
            HelpdeskCategory::class,
            'category_id'
        );
    }

    /**
     * Posisi pemohon tiket.
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(
            Position::class,
            'position_id'
        );
    }

    /**
     * Seluruh pesan dalam tiket.
     */
    public function messages(): HasMany
    {
        return $this->hasMany(
            HelpdeskMessage::class,
            'ticket_id'
        )->oldest();
    }

    /**
     * Seluruh lampiran tiket.
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(
            HelpdeskAttachment::class,
            'ticket_id'
        );
    }
}