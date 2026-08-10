@extends('layouts.admin')

@section('title', 'Permission Role')

@section('content')

    {{-- Header --}}
    <div class="mb-6">

        <div class="flex items-center justify-between">

            <div>

                <h1 class="text-2xl font-semibold text-gray-900">
                    Permission Role
                </h1>

                <p class="mt-1 text-sm text-gray-600">
                    Atur hak akses untuk role:
                    <span class="font-semibold text-gray-900">
                        {{ $role->name }}
                    </span>
                </p>

            </div>

            <a
                href="{{ route('roles.index') }}"
                class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
            >
                Kembali
            </a>

        </div>

    </div>


    {{-- Form --}}
    <x-admin.card>

        <form
            method="POST"
            action="{{ route('roles.permissions.update', $role) }}"
        >

            @csrf

            @method('PUT')


            <div class="space-y-4">

                @forelse ($permissions as $permission)

                    <label
                        for="permission-{{ $permission->id }}"
                        class="flex cursor-pointer items-start gap-3 rounded-lg border border-gray-200 p-4 transition hover:bg-gray-50"
                    >

                        <input
                            id="permission-{{ $permission->id }}"
                            type="checkbox"
                            name="permissions[]"
                            value="{{ $permission->id }}"
                            @checked(
                                in_array(
                                    $permission->id,
                                    $selectedPermissions
                                )
                            )
                            class="mt-1 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                        >

                        <div>

                            <p class="font-medium text-gray-900">
                                {{ $permission->name }}
                            </p>

                            <p class="mt-1 text-sm text-gray-500">
                                {{ $permission->code }}
                            </p>

                            @if ($permission->description)

                                <p class="mt-1 text-sm text-gray-500">
                                    {{ $permission->description }}
                                </p>

                            @endif

                        </div>

                    </label>

                @empty

                    <div class="rounded-lg border border-gray-200 bg-gray-50 px-4 py-8 text-center">

                        <p class="text-sm text-gray-500">
                            Belum ada permission.
                        </p>

                    </div>

                @endforelse

            </div>


            @error('permissions')

                <p class="mt-4 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror


            {{-- Tombol --}}
            <div class="mt-6 flex items-center justify-end gap-3">

                <a
                    href="{{ route('roles.index') }}"
                    class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700"
                >
                    Simpan Permission
                </button>

            </div>

        </form>

    </x-admin.card>

@endsection