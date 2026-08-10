@extends('layouts.admin')

@section('title', 'Detail User')

@section('content')

    <div class="max-w-5xl">

        <div class="mb-6 flex items-center justify-between">

            <div>
                <h1 class="text-2xl font-semibold text-gray-900">
                    Detail User
                </h1>

                <p class="mt-1 text-sm text-gray-600">
                    Informasi lengkap pengguna.
                </p>
            </div>

            <a
                href="{{ route('users.edit', $user) }}"
                class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700"
            >
                Edit User
            </a>

        </div>

        <x-admin.card>

            <dl class="divide-y divide-gray-200">

                <div class="grid grid-cols-1 gap-2 py-4 sm:grid-cols-3">
                    <dt class="font-medium text-gray-500">
                        NIP
                    </dt>

                    <dd class="sm:col-span-2 text-gray-900">
                        {{ $user->nip }}
                    </dd>
                </div>

                <div class="grid grid-cols-1 gap-2 py-4 sm:grid-cols-3">
                    <dt class="font-medium text-gray-500">
                        Nama Lengkap
                    </dt>

                    <dd class="sm:col-span-2 text-gray-900">
                        {{ $user->name }}
                    </dd>
                </div>

                <div class="grid grid-cols-1 gap-2 py-4 sm:grid-cols-3">
                    <dt class="font-medium text-gray-500">
                        Email
                    </dt>

                    <dd class="sm:col-span-2 text-gray-900">
                        {{ $user->email }}
                    </dd>
                </div>

                <div class="grid grid-cols-1 gap-2 py-4 sm:grid-cols-3">
                    <dt class="font-medium text-gray-500">
                        Nomor HP
                    </dt>

                    <dd class="sm:col-span-2 text-gray-900">
                        {{ $user->phone ?: '-' }}
                    </dd>
                </div>

                <div class="grid grid-cols-1 gap-2 py-4 sm:grid-cols-3">
                    <dt class="font-medium text-gray-500">
                        Role
                    </dt>

                    <dd class="sm:col-span-2 text-gray-900">
                        {{ $user->role?->name ?? '-' }}
                    </dd>
                </div>

                <div class="grid grid-cols-1 gap-2 py-4 sm:grid-cols-3">
                    <dt class="font-medium text-gray-500">
                        Jabatan dalam PBJ
                    </dt>

                    <dd class="sm:col-span-2 text-gray-900">
                        {{ $user->position?->name ?? '-' }}
                    </dd>
                </div>

                <div class="grid grid-cols-1 gap-2 py-4 sm:grid-cols-3">
                    <dt class="font-medium text-gray-500">
                        Status
                    </dt>

                    <dd class="sm:col-span-2">

                        @if ($user->is_active)
                            <span class="rounded-full bg-green-100 px-2.5 py-1 text-xs font-medium text-green-800">
                                Aktif
                            </span>
                        @else
                            <span class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-medium text-red-800">
                                Tidak Aktif
                            </span>
                        @endif

                    </dd>
                </div>

            </dl>

        </x-admin.card>

        <div class="mt-6">

            <a
                href="{{ route('users.index') }}"
                class="text-sm text-gray-600 hover:text-gray-900"
            >
                ← Kembali ke daftar user
            </a>

        </div>

    </div>

@endsection