<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'role_id',

        'user_type',
        'position_id',
        'nip',

        'name',
        'email',

        'avatar',
        'appointment_document',

        'password',

        'must_change_password',
        'last_login_at',
        'is_active',

        'approval_status',
        'approved_by',
        'approved_at',
        'rejected_at',
        'rejection_reason',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute casting.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',

            'password' => 'hashed',

            'must_change_password' => 'boolean',
            'is_active' => 'boolean',

            'last_login_at' => 'datetime',

            'approved_at' => 'datetime',
            'rejected_at' => 'datetime',
        ];
    }

    /**
     * Role user.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Position/jabatan user.
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

        /**
     * User ASN yang disetujui oleh user ini.
     */
    public function approvedUsers(): HasMany
    {
        return $this->hasMany(User::class, 'approved_by');
    }

    /**
     * Konten yang dibuat oleh user.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    /**
     * Tiket Helpdesk yang dibuat oleh user.
     */
    public function helpdeskTickets(): HasMany
    {
        return $this->hasMany(
            HelpdeskTicket::class
        );
    }

    /**
     * Pesan Helpdesk yang dibuat oleh user.
     */
    public function helpdeskMessages(): HasMany
    {
        return $this->hasMany(
            HelpdeskMessage::class
        );
    }


    
    /**
     * User yang menyetujui akun ini.
     */
    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'approved_by'
        );
    }

    /**
     * Lampiran Helpdesk yang diunggah oleh user.
     */
    public function helpdeskAttachments(): HasMany
    {
        return $this->hasMany(
            HelpdeskAttachment::class,
            'uploaded_by_user_id'
        );
    }

    /**
     * Mengecek apakah user merupakan Public.
     */
    public function isPublic(): bool
    {
        return $this->user_type === 'public';
    }

    /**
     * Mengecek apakah user merupakan ASN.
     */
    public function isInternal(): bool
    {
        return $this->user_type === 'asn';
    }

    /**
     * Mengecek apakah akun masih menunggu persetujuan.
     */
    public function isPendingApproval(): bool
    {
        return $this->approval_status === 'pending';
    }

    /**
     * Mengecek apakah akun telah disetujui.
     */
    public function isApproved(): bool
    {
        return $this->approval_status === 'approved';
    }

    /**
     * Mengecek apakah akun ditolak.
     */
    public function isRejected(): bool
    {
        return $this->approval_status === 'rejected';
    }

    

    /**
     * Mengecek role berdasarkan kode role.
     */
    public function hasRole(string $roleCode): bool
    {
        return $this->role?->code === $roleCode;
    }

    /**
     * Mengecek apakah user memiliki permission tertentu.
     */
    public function hasPermission(string $permission): bool
    {
        return $this->role
            ? $this->role->permissions()
                ->where('code', $permission)
                ->exists()
            : false;
    }

    /**
     * Send the password reset notification.
     */
    public function sendPasswordResetNotification(
        $token
    ): void {

        $this->notify(
            new ResetPasswordNotification($token)
        );

    }
}