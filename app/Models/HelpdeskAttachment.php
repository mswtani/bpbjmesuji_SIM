<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HelpdeskAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'message_id',
        'original_name',
        'file_path',
        'mime_type',
        'file_size',
        'uploaded_by_user_id',
    ];

    protected function casts(): array
    {
        return [
            'file_size' => 'integer',
        ];
    }

    /**
     * Tiket tempat lampiran berada.
     */
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(
            HelpdeskTicket::class,
            'ticket_id'
        );
    }

    /**
     * Pesan tempat lampiran berada.
     */
    public function message(): BelongsTo
    {
        return $this->belongsTo(
            HelpdeskMessage::class,
            'message_id'
        );
    }

    /**
     * User yang mengunggah file.
     *
     * NULL jika guest atau sistem.
     */
    public function uploadedBy(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'uploaded_by_user_id'
        );
    }
}