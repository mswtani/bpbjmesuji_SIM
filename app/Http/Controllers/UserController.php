<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Position;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Menampilkan daftar user.
     */
    public function index(): View
    {
        $currentUser = auth()->user();

        $query = User::with(['role', 'position'])
            ->orderBy('name');

        /*
         * SUPER_ADMIN dapat melihat semua user.
         *
         * User selain SUPER_ADMIN hanya dapat melihat
         * user dengan level role <= level dirinya.
         */
        if (! $currentUser->hasRole('SUPER_ADMIN')) {
            $currentLevel = $currentUser->role?->level ?? 0;

            $query->whereHas('role', function ($roleQuery) use ($currentLevel) {
                $roleQuery->where('level', '<=', $currentLevel);
            });
        }

        $users = $query->get();

        return view('users.index', compact('users'));
    }


    /**
     * Mendapatkan Role yang boleh diberikan
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
         * User lain hanya boleh memberikan
         * role dengan level lebih rendah.
         */
        $currentLevel = $currentUser->role?->level ?? 0;

        return $query
            ->where('level', '<', $currentLevel)
            ->get();
    }


    /**
     * Memastikan user boleh melihat target user.
     *
     * Level sama masih boleh dilihat.
     */
    private function ensureCanViewUser(User $user): void
    {
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

        $currentLevel = $currentUser->role?->level ?? 0;
        $targetLevel = $user->role?->level ?? 0;

        if ($targetLevel > $currentLevel) {
            abort(
                403,
                'Anda tidak memiliki izin untuk melihat user dengan level lebih tinggi.'
            );
        }
    }


    /**
     * Memastikan user boleh mengelola target user.
     *
     * Target harus mempunyai level lebih rendah.
     */
    private function ensureCanManageUser(User $user): void
    {
        $currentUser = auth()->user();

        if (! $currentUser) {
            abort(403);
        }

        /*
         * Tidak boleh mengelola akun sendiri
         * melalui Manajemen User.
         */
        if ($user->is($currentUser)) {
            abort(
                403,
                'Anda tidak dapat mengelola akun sendiri melalui Manajemen User.'
            );
        }

        /*
         * SUPER_ADMIN dapat mengelola semua user lain.
         */
        if ($currentUser->hasRole('SUPER_ADMIN')) {
            return;
        }

        $currentLevel = $currentUser->role?->level ?? 0;
        $targetLevel = $user->role?->level ?? 0;

        /*
         * Target harus berada di bawah level user
         * yang sedang login.
         */
        if ($targetLevel >= $currentLevel) {
            abort(
                403,
                'Anda tidak memiliki izin untuk mengelola user dengan level yang sama atau lebih tinggi.'
            );
        }
    }


    /**
     * Form tambah user.
     */
    public function create(): View
    {
        $roles = $this->availableRoles();

        $positions = Position::orderBy('name')->get();

        return view('users.create', compact(
            'roles',
            'positions'
        ));
    }


    /**
     * Menyimpan user baru.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $data = $request->validated();

        /*
         * Generate password sementara.
         */
        $temporaryPassword = Str::random(12);

        $data['password'] = $temporaryPassword;
        $data['must_change_password'] = true;
        $data['is_active'] = true;

        /*
         * Buat user.
         */
        $user = User::create($data);

        /*
         * Kembali ke daftar user.
         */
        return redirect()
            ->route('users.index')
            ->with(
                'success',
                "User {$user->name} berhasil ditambahkan. " .
                "Password sementara: {$temporaryPassword}"
            );
    }


    /**
     * Form edit user.
     */
    public function edit(User $user): View
    {
        $this->ensureCanManageUser($user);

        $roles = $this->availableRoles();

        $positions = Position::orderBy('name')->get();

        return view('users.edit', compact(
            'user',
            'roles',
            'positions'
        ));
    }


    /**
     * Update user.
     */
    public function update(
        UpdateUserRequest $request,
        User $user
    ): RedirectResponse {
        $this->ensureCanManageUser($user);

        $user->update(
            $request->validated()
        );

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User berhasil diperbarui.'
            );
    }


    /**
     * Detail user.
     */
    public function show(User $user): View
    {
        $this->ensureCanViewUser($user);

        $user->load([
            'role',
            'position',
        ]);

        return view('users.show', compact('user'));
    }


    /**
     * Reset password user.
     */
    public function resetPassword(User $user): RedirectResponse
    {
        $this->ensureCanManageUser($user);

        $temporaryPassword = Str::random(12);

        $user->update([
            'password' => $temporaryPassword,
            'must_change_password' => true,
        ]);

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                "Password user {$user->name} berhasil direset. " .
                "Password sementara: {$temporaryPassword}"
            );
    }


    /**
     * Menonaktifkan user.
     */
    public function deactivate(User $user): RedirectResponse
    {
        $this->ensureCanManageUser($user);

        $user->update([
            'is_active' => false,
        ]);

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User berhasil dinonaktifkan.'
            );
    }


    /**
     * Mengaktifkan kembali user.
     */
    public function activate(User $user): RedirectResponse
    {
        $this->ensureCanManageUser($user);

        $user->update([
            'is_active' => true,
        ]);

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User berhasil diaktifkan kembali.'
            );
    }
}