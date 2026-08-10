<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'role_id',
        'nip',
        'name',
        'position_id',
        'email',
        'phone',
        'avatar',
        'password',
        'must_change_password',
        'last_login_at',
        'is_active',
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
     * Konten yang dibuat oleh user.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'author_id');
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
}