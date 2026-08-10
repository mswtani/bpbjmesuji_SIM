@extends('layouts.admin')

@section('title', 'Manajemen User')

@section('content')

    {{-- Header --}}
    <div class="mb-6 flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-semibold text-gray-900">
                Manajemen User
            </h1>

            <p class="mt-1 text-sm text-gray-600">
                Kelola pengguna sistem BPBJ Mesuji.
            </p>
        </div>


        {{-- Tambah User --}}
        @if (auth()->user()->hasPermission('users.create'))

            <a
                href="{{ route('users.create') }}"
                class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700"
            >
                + Tambah User
            </a>

        @endif

    </div>


    {{-- Flash Success --}}
    @if (session('success'))

        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
            {{ session('success') }}
        </div>

    @endif


    {{-- Flash Error --}}
    @if (session('error'))

        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
            {{ session('error') }}
        </div>

    @endif


    {{-- Jumlah User --}}
    <div class="mb-6">

        <x-admin.card>

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-500">
                        Jumlah User
                    </p>

                    <p class="mt-1 text-3xl font-semibold text-gray-900">
                        {{ $users->count() }}
                    </p>

                </div>

            </div>

        </x-admin.card>

    </div>


    {{-- Daftar User --}}
    <x-admin.card>

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-200">

                {{-- Header Tabel --}}
                <thead class="bg-gray-50">

                    <tr>

                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            No
                        </th>

                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            NIP
                        </th>

                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            Nama
                        </th>

                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            Email
                        </th>

                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            Role
                        </th>

                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            Jabatan
                        </th>

                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            Status
                        </th>

                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            Aksi
                        </th>

                    </tr>

                </thead>


                {{-- Isi Tabel --}}
                <tbody class="divide-y divide-gray-200 bg-white">

                    @forelse ($users as $user)

                        <tr class="hover:bg-gray-50">

                            {{-- No --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                {{ $loop->iteration }}
                            </td>


                            {{-- NIP --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                                {{ $user->nip }}
                            </td>


                            {{-- Nama --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                {{ $user->name }}
                            </td>


                            {{-- Email --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                                {{ $user->email }}
                            </td>


                            {{-- Role --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                                {{ $user->role?->name ?? '-' }}
                            </td>


                            {{-- Jabatan --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                                {{ $user->position?->name ?? '-' }}
                            </td>


                            {{-- Status --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                @if ($user->is_active)

                                    <span class="rounded-full bg-green-100 px-2.5 py-1 text-xs font-medium text-green-800">
                                        Aktif
                                    </span>

                                @else

                                    <span class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-medium text-red-800">
                                        Tidak Aktif
                                    </span>

                                @endif

                            </td>


                            {{-- Aksi --}}
                            <td class="whitespace-nowrap px-6 py-4 text-right">

                                <div class="flex items-center justify-end gap-3">


                                    {{-- Lihat --}}
                                    @if (auth()->user()->hasPermission('users.view'))

                                        <a
                                            href="{{ route('users.show', $user) }}"
                                            class="text-sm font-medium text-indigo-600 hover:text-indigo-900"
                                        >
                                            Lihat
                                        </a>

                                    @endif


                                    {{-- Edit --}}
                                    @if (auth()->user()->hasPermission('users.update'))

                                        <a
                                            href="{{ route('users.edit', $user) }}"
                                            class="text-sm font-medium text-gray-600 hover:text-gray-900"
                                        >
                                            Edit
                                        </a>

                                    @endif


                                    {{-- Aktifkan / Nonaktifkan --}}
                                    @if ($user->id !== auth()->id())

                                        @if ($user->is_active)

                                            @if (auth()->user()->hasPermission('users.deactivate'))

                                                <form
                                                    method="POST"
                                                    action="{{ route('users.deactivate', $user) }}"
                                                    class="inline"
                                                >

                                                    @csrf

                                                    @method('PATCH')

                                                    <button
                                                        type="submit"
                                                        class="text-sm font-medium text-red-600 hover:text-red-900"
                                                        onclick="return confirm('Apakah Anda yakin ingin menonaktifkan user ini?')"
                                                    >
                                                        Nonaktifkan
                                                    </button>

                                                </form>

                                            @endif

                                        @else

                                            @if (auth()->user()->hasPermission('users.activate'))

                                                <form
                                                    method="POST"
                                                    action="{{ route('users.activate', $user) }}"
                                                    class="inline"
                                                >

                                                    @csrf

                                                    @method('PATCH')

                                                    <button
                                                        type="submit"
                                                        class="text-sm font-medium text-green-600 hover:text-green-900"
                                                        onclick="return confirm('Apakah Anda yakin ingin mengaktifkan user ini?')"
                                                    >
                                                        Aktifkan
                                                    </button>

                                                </form>

                                            @endif

                                        @endif

                                    @endif


                                    {{-- Reset Password --}}
                                    @if (
                                        $user->id !== auth()->id()
                                        && auth()->user()->hasPermission('users.reset-password')
                                    )

                                        <form
                                            method="POST"
                                            action="{{ route('users.reset-password', $user) }}"
                                            class="inline"
                                        >

                                            @csrf

                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="text-sm font-medium text-orange-600 hover:text-orange-900"
                                                onclick="return confirm('Apakah Anda yakin ingin mereset password user ini?')"
                                            >
                                                Reset Password
                                            </button>

                                        </form>

                                    @endif


                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="8"
                                class="px-6 py-10 text-center text-sm text-gray-500"
                            >
                                Belum ada user.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </x-admin.card>

@endsection