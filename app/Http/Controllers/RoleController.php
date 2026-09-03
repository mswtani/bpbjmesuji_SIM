<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\UpdateRolePermissionsRequest;
use App\Models\Permission;

class RoleController extends Controller
{
    /**
     * Menampilkan daftar role.
     */
    public function index(): View
    {
        $search = request()->query('search');

        $perPage = (int) request()->query('per_page', 10);

        if (! in_array($perPage, [10, 25, 50, 100], true)) {
            $perPage = 10;
        }

        $roles = Role::query()
            ->withCount('users')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy('level')
            ->orderBy('name')
            ->paginate($perPage)
            ->withQueryString();

        return view('roles.index', compact(
            'roles',
            'search',
            'perPage'
        ));
    }


    /**
     * Menampilkan form tambah role.
     */
    public function create(): View
    {
        return view('roles.create');
    }


    /**
     * Menyimpan role baru.
     */
    public function store(
        StoreRoleRequest $request
    ): RedirectResponse {
        Role::create(
            $request->validated()
        );

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role berhasil ditambahkan.')
            ->with('success_type', 'create');
    }


    /**
     * Menampilkan form edit role.
     */
    public function edit(Role $role): View
    {
        return view('roles.edit', compact('role'));
    }


    /**
     * Memperbarui role.
     */
    public function update(
        UpdateRoleRequest $request,
        Role $role
    ): RedirectResponse {
        $role->update(
            $request->validated()
        );

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role berhasil diperbarui.')
            ->with('success_type', 'update');
    }


        /**
     * Menampilkan pengaturan permission sebuah role.
     */
    public function permissions(Role $role): View
    {
        $permissions = Permission::orderBy('code')->get();

        $role->load('permissions');

        $selectedPermissions = $role->permissions
            ->pluck('id')
            ->toArray();

        return view('roles.permissions', compact(
            'role',
            'permissions',
            'selectedPermissions'
        ));
    }


    /**
     * Menyimpan permission sebuah role.
     */
    public function updatePermissions(
        UpdateRolePermissionsRequest $request,
        Role $role
    ): RedirectResponse {
        $permissionIds = $request->validated('permissions', []);

        $role->permissions()->sync($permissionIds);

        return redirect()
            ->route('roles.index')
            ->with('success', 'Permission role berhasil diperbarui.')
            ->with('succes_type', 'delete');
    }


    /**
     * Menghapus role.
     */
    public function destroy(Role $role): RedirectResponse
    {
        if ($role->users()->exists()) {
            return redirect()
                ->route('roles.index')
                ->with(
                    'error',
                    'Role tidak dapat dihapus karena masih digunakan oleh user.'
                );
        }

        $role->delete();

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role berhasil dihapus.');
    }
}