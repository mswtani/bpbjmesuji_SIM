<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Position;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Menampilkan daftar user.
     */
    public function index(): View
    {
        $currentUser = auth()->user();

        $search = request('search');

        $roleId = request('role');
        
        $positionId = request('position');

        $query = User::with([
            'role',
            'position',
        ])->orderBy('name');

        /*
        |--------------------------------------------------------------------------
        | Filter akses berdasarkan role
        |--------------------------------------------------------------------------
        |
        | SUPER_ADMIN:
        | - dapat melihat semua user.
        |
        | Selain SUPER_ADMIN:
        | - tidak boleh melihat SUPER_ADMIN.
        | - boleh melihat role lain:
        |   - role di atas
        |   - role selevel
        |   - role di bawah
        |
        */

        if (! $currentUser->hasRole('SUPER_ADMIN')) {
            $query->whereHas('role', function ($roleQuery) {
                $roleQuery->where(
                    'code',
                    '!=',
                    'SUPER_ADMIN'
                );
            });
        }

        // Role
        $rolesQuery = Role::query()
            ->orderBy('level', 'desc')
            ->orderBy('name');

        if (! $currentUser->hasRole('SUPER_ADMIN')) {
            $rolesQuery->where('code', '!=', 'SUPER_ADMIN');
        }

        $roles = $rolesQuery->get(['id', 'name']);

        // Jabatan
        $positions = Position::query()->orderBy('name')->get(['id', 'name']);

        /*
        |--------------------------------------------------------------------------
        | Search user
        |--------------------------------------------------------------------------
        */

        if ($search) {
            $query->where(function ($searchQuery) use ($search) {
                $searchQuery
                    ->where(
                        'name',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhereHas('role', function ($roleQuery) use ($search) {
                        $roleQuery->where('name', 'like', "%{$search}%");
                    })

                    ->orWhere(
                        'email',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'nip',
                        'like',
                        "%{$search}%"
                    );
            });
        }

        // Filter Role
        if ($roleId) {
            $query->where('role_id', $roleId);
        }

        // Filter Jabatan
        if ($positionId) {
            $query->where('position_id', $positionId);
        }

        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */

        $allowedPerPage = [
            10,
            25,
            50,
            100,
        ];

        $perPage = (int) request(
            'per_page',
            10
        );

        if (
            ! in_array(
                $perPage,
                $allowedPerPage,
                true
            )
        ) {
            $perPage = 10;
        }

        $users = $query
            ->paginate($perPage)
            ->withQueryString();

        return view(
            'users.index',
            compact(
                'users',
                'search',
                'roleId',
                'positionId',
                'positions',
                'roles',
                'perPage'
            )
        );
    }


    /**
     * Mendapatkan role yang boleh diberikan
     * oleh user yang sedang login.
     */
    private function availableRoles()
    {
        $currentUser = auth()->user();

        $query = Role::query()
            ->orderBy('level', 'desc')
            ->orderBy('name');

        /*
         * SUPER_ADMIN dapat memilih semua role.
         */
        if ($currentUser->hasRole('SUPER_ADMIN')) {
            return $query->get();
        }

        /*
         * User selain SUPER_ADMIN hanya dapat
         * memberikan role dengan level lebih rendah.
         */
        $currentLevel = $currentUser->role?->level ?? 0;

        return $query
            ->where(
                'level',
                '<',
                $currentLevel
            )
            ->get();
    }


    /**
     * Memastikan user boleh melihat target user.
     *
     * Aturan:
     *
     * - SUPER_ADMIN dapat melihat semua user.
     *
     * - User selain SUPER_ADMIN:
     *   tidak dapat melihat SUPER_ADMIN.
     *
     * - Selain itu boleh melihat:
     *   - role di atas
     *   - role selevel
     *   - role di bawah
     */
    private function ensureCanViewUser(
        User $user
    ): void {
        $currentUser = auth()->user();

        if (! $currentUser) {
            abort(403);
        }

        /*
         * SUPER_ADMIN dapat melihat semua user.
         */
        if ($currentUser->hasRole('SUPER_ADMIN')) {
            return;
        }

        /*
         * User selain SUPER_ADMIN tidak boleh
         * melihat akun SUPER_ADMIN.
         */
        if ($user->hasRole('SUPER_ADMIN')) {
            abort(
                403,
                'Anda tidak memiliki izin untuk melihat akun Super Administrator.'
            );
        }
    }


    /**
     * Memastikan user boleh mengedit
     * target user.
     *
     * Aturan:
     *
     * SUPER_ADMIN:
     * - dapat mengedit semua user.
     * - termasuk akun sendiri.
     *
     * Selain SUPER_ADMIN:
     * - tidak dapat mengedit SUPER_ADMIN.
     * - dapat mengedit akun sendiri.
     * - dapat mengedit role yang lebih rendah.
     * - tidak dapat mengedit role selevel.
     * - tidak dapat mengedit role yang lebih tinggi.
     */
    private function ensureCanManageUser(
        User $user
    ): void {
        $currentUser = auth()->user();

        if (! $currentUser) {
            abort(403);
        }

        /*
         * SUPER_ADMIN dapat mengedit semua user,
         * termasuk dirinya sendiri.
         */
        if ($currentUser->hasRole('SUPER_ADMIN')) {
            return;
        }

        /*
         * Tidak boleh mengelola akun SUPER_ADMIN.
         */
        if ($user->hasRole('SUPER_ADMIN')) {
            abort(
                403,
                'Anda tidak memiliki izin untuk mengelola akun Super Administrator.'
            );
        }

        /*
         * User boleh mengedit akun sendiri.
         */
        if ($user->is($currentUser)) {
            return;
        }

        $currentLevel = $currentUser->role?->level ?? 0;

        $targetLevel = $user->role?->level ?? 0;

        /*
         * User hanya boleh mengelola role
         * yang berada di bawah levelnya.
         */
        if ($targetLevel >= $currentLevel) {
            abort(
                403,
                'Anda hanya dapat mengelola user dengan role yang berada di bawah level Anda.'
            );
        }
    }


    /**
     * Memastikan user boleh melakukan
     * aksi sensitif terhadap target user.
     *
     * Aksi sensitif:
     * - reset password
     * - aktifkan akun
     * - nonaktifkan akun
     *
     * User tidak boleh melakukan aksi
     * sensitif terhadap akun sendiri.
     */
    private function ensureCanManageSensitiveAction(
        User $user
    ): void {
        $currentUser = auth()->user();

        if (! $currentUser) {
            abort(403);
        }

        /*
         * Tidak boleh melakukan aksi sensitif
         * terhadap akun sendiri.
         */
        if ($user->is($currentUser)) {
            abort(
                403,
                'Anda tidak dapat melakukan tindakan ini pada akun sendiri.'
            );
        }

        /*
         * Gunakan aturan pengelolaan user.
         */
        $this->ensureCanManageUser($user);
    }


    /**
     * Form tambah user.
     */
    public function create(): View
    {
        $roles = $this->availableRoles();

        $positions = Position::orderBy(
            'name'
        )->get();

        return view(
            'users.create',
            compact(
                'roles',
                'positions'
            )
        );
    }


    /**
     * Menyimpan user baru.
     */
    public function store(
        StoreUserRequest $request
    ): RedirectResponse {
        $data = $request->validated();


        /*
        |--------------------------------------------------------------------------
        | Tentukan role
        |--------------------------------------------------------------------------
        */

        $role = Role::findOrFail($data['role_id']);

        /*
        |--------------------------------------------------------------------------
        | Tentukan jenis user
        |--------------------------------------------------------------------------
        */

        $data['user_type'] =
            $role->code === 'PUBLIC_USER'
                ? 'public'
                : 'asn';

        /*
        |--------------------------------------------------------------------------
        | Generate password sementara
        |--------------------------------------------------------------------------
        */

        $temporaryPassword = Str::random(12);

        $data['password'] = $temporaryPassword;
        $data['must_change_password'] = true;
        $data['is_active'] = true;

        /*
        |--------------------------------------------------------------------------
        | User dibuat oleh administrator
        |--------------------------------------------------------------------------
        |
        | Karena akun dibuat langsung melalui Manajemen User,
        | email dianggap telah diverifikasi.
        |
        */

        $data['email_verified_at'] = now();

        /*
        |--------------------------------------------------------------------------
        | Buat user
        |--------------------------------------------------------------------------
        */

        $user = User::create($data);

        /*
         * Kembali ke halaman edit user.
         */
        return redirect()
            ->route(
                'users.edit',
                $user
            )
            ->with(
                'success',
                'Data user berhasil ditambahkan.'
            )
            ->with(
                'success_type',
                'create'
            )
            ->with(
                'success_redirect',
                route('users.index')
            );
    }


    /**
     * Form edit user.
     */
    public function edit(
        User $user
    ): View {
        $this->ensureCanManageUser($user);

        $roles = $this->availableRoles();

        $positions = Position::orderBy(
            'name'
        )->get();

        return view(
            'users.edit',
            compact(
                'user',
                'roles',
                'positions'
            )
        );
    }


    /**
     * Update user.
     */
    public function update(
        UpdateUserRequest $request,
        User $user
    ): RedirectResponse {
        $this->ensureCanManageUser($user);

        $data = $request->validated();

        /*
        |--------------------------------------------------------------------------
        | Tentukan role baru
        |--------------------------------------------------------------------------
        */

        $role = Role::findOrFail($data['role_id']);

        /*
        |--------------------------------------------------------------------------
        | Sinkronkan user type dengan role
        |--------------------------------------------------------------------------
        */

        $data['user_type'] =
            $role->code === 'PUBLIC_USER'
                ? 'public'
                : 'asn';

       /*
        |--------------------------------------------------------------------------
        | Avatar
        |--------------------------------------------------------------------------
        */

        $oldAvatar = $user->avatar;

        /*
        | Upload avatar baru.
        |
        | Foto lama tidak dihapus sebelum foto baru
        | berhasil disimpan.
        */
        if ($request->hasFile('avatar')) {
            $newAvatar = $request->file('avatar')
                ->store('avatars', 'public');

            $data['avatar'] = $newAvatar;

            if (
                $oldAvatar &&
                $oldAvatar !== $newAvatar &&
                Storage::disk('public')->exists($oldAvatar)
            ) {
                Storage::disk('public')->delete($oldAvatar);
            }
        }

        /*
        | Hapus avatar jika tidak ada foto baru.
        */
        elseif (
            ($data['remove_avatar'] ?? false)
            && $oldAvatar
        ) {
            if (Storage::disk('public')->exists($oldAvatar)) {
                Storage::disk('public')->delete($oldAvatar);
            }

            $data['avatar'] = null;
        }

        /*
        |--------------------------------------------------------------------------
        | Jangan simpan field kontrol form ke database
        |--------------------------------------------------------------------------
        */

        unset($data['remove_avatar']);

        /*
        |--------------------------------------------------------------------------
        | Update user
        |--------------------------------------------------------------------------
        */

        $user->update($data);

        return redirect()
            ->route(
                'users.edit',
                $user
            )
            ->with(
                'success',
                'Data user berhasil diperbarui.'
            )
            ->with(
                'success_type',
                'update'
            )
            ->with(
                'success_redirect',
                route('users.index')
            );
    }

    /**
     * Menghapus user secara soft delete.
     */
    public function destroy(
        User $user
    ): RedirectResponse {
        $currentUser = auth()->user();

        if (! $currentUser) {
            abort(403);
        }

        if (! $currentUser->hasPermission('users.delete')) {
            abort(403);
        }

        if ($user->is($currentUser)) {
            abort(
                403,
                'Anda tidak dapat menghapus akun sendiri.'
            );
        }

        if ($user->hasRole('SUPER_ADMIN')) {
            abort(
                403,
                'Akun Super Administrator tidak dapat dihapus.'
            );
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User berhasil dihapus.'
            )
            ->with(
                'success_type',
                'delete'
            );
    }


    /**
     * Detail user.
     */
    public function show(
        User $user
    ): View {
        $this->ensureCanViewUser($user);

        $user->load([
            'role',
            'position',
        ]);

        return view(
            'users.show',
            compact('user')
        );
    }


    /**
     * Reset password user.
     */
    public function resetPassword(
        User $user
    ): RedirectResponse {
        $this->ensureCanManageSensitiveAction($user);

        $temporaryPassword =
            'BPBJ-' .
            Str::upper(Str::random(4)) .
            '-' .
            random_int(1000, 9999);

        $user->update([
            'password' => $temporaryPassword,
            'must_change_password' => true,
        ]);

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'Password berhasil direset.'
            )
            ->with(
                'success_type',
                'reset-password'
            )
            ->with(
                'temporary_password',
                $temporaryPassword
            );
    }


    /**
     * Menonaktifkan user.
     */
    public function deactivate(
        User $user
    ): RedirectResponse {
        $this->ensureCanManageSensitiveAction($user);

        $user->update([
            'is_active' => false,
        ]);

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User berhasil dinonaktifkan.'
            )
            ->with(
                'success_type',
                'deactivate'
            );
    }


    /**
     * Mengaktifkan kembali user.
     */
    public function activate(
        User $user
    ): RedirectResponse {
        $this->ensureCanManageSensitiveAction($user);

        $user->update([
            'is_active' => true,
        ]);

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User berhasil diaktifkan.'
            )
            ->with(
                'success_type',
                'activate'
            );
    }
}