<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class HelpdeskMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'user_id',
        'sender_type',
        'message',
    ];

    /**
     * Tiket tempat pesan ini berada.
     */
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(
            HelpdeskTicket::class,
            'ticket_id'
        );
    }

    /**
     * User pengirim pesan.
     *
     * NULL dapat berarti guest atau system.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Lampiran pada pesan ini.
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(
            HelpdeskAttachment::class,
            'message_id'
        );
    }

    public function approvalRequests(): MorphMany
    {
        return $this->morphMany(ApprovalRequest::class, 'requestable');
    }

}