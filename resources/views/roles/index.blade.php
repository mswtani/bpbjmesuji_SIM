@extends('layouts.admin')

@section('title', 'Manajemen Role')

@section('content')

    {{-- Header --}}
    <div class="mb-6 flex items-center justify-between">

        <div>

            <h1 class="text-2xl font-semibold text-gray-900">
                Manajemen Role
            </h1>

            <p class="mt-1 text-sm text-gray-600">
                Kelola role pengguna sistem BPBJ Mesuji.
            </p>

        </div>


        {{-- Tambah Role --}}
        @if (auth()->user()->hasPermission('roles.create'))
        <a
            href="{{ route('roles.create') }}"
            class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700"
        >
            + Tambah Role
        </a>
        @endif

    </div>


    {{-- Flash Success --}}
    @if (session('success'))

        <div
            class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800"
        >
            {{ session('success') }}
        </div>

    @endif


    {{-- Flash Error --}}
    @if (session('error'))

        <div
            class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800"
        >
            {{ session('error') }}
        </div>

    @endif


    {{-- Jumlah Role --}}
    <div class="mb-6">

        <x-admin.card>

            <div>

                <p class="text-sm font-medium text-gray-500">
                    Jumlah Role
                </p>

                <p class="mt-1 text-3xl font-semibold text-gray-900">
                    {{ $roles->count() }}
                </p>

            </div>

        </x-admin.card>

    </div>


    {{-- Daftar Role --}}
    <x-admin.card>

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">

                    <tr>

                        {{-- No --}}
                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            No
                        </th>


                        {{-- Code --}}
                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            Code
                        </th>


                        {{-- Nama --}}
                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            Nama
                        </th>


                        {{-- Deskripsi --}}
                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            Deskripsi
                        </th>


                        {{-- Level --}}
                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            Level
                        </th>


                        {{-- Jumlah User --}}
                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            Jumlah User
                        </th>


                        {{-- Aksi --}}
                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-200 bg-white">

                    @forelse ($roles as $role)

                        <tr class="hover:bg-gray-50">

                            {{-- No --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                {{ $loop->iteration }}
                            </td>


                            {{-- Code --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                                {{ $role->code }}
                            </td>


                            {{-- Nama --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                {{ $role->name }}
                            </td>


                            {{-- Deskripsi --}}
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $role->description ?? '-' }}
                            </td>


                            {{-- Level --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                                {{ $role->level }}
                            </td>


                            {{-- Jumlah User --}}
                            <td class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-600">
                                {{ $role->users_count }}
                            </td>


                            {{-- Aksi --}}
                            <td class="whitespace-nowrap px-6 py-4 text-right">

                                <div class="flex items-center justify-end gap-3">

                                    {{-- Edit --}}
                                    @if (auth()->user()->hasPermission('roles.update'))

                                        <a
                                            href="{{ route('roles.edit', $role) }}"
                                            class="text-sm font-medium text-indigo-600 hover:text-indigo-900"
                                        >
                                            Edit
                                        </a>

                                    @endif


                                    {{-- Permission --}}
                                    @if (auth()->user()->hasPermission('roles.update'))

                                        <a
                                            href="{{ route('roles.permissions', $role) }}"
                                            class="text-sm font-medium text-purple-600 hover:text-purple-900"
                                        >
                                            Permission
                                        </a>

                                    @endif


                                    {{-- Hapus --}}
                                    @if (auth()->user()->hasPermission('roles.delete'))

                                        <form
                                            method="POST"
                                            action="{{ route('roles.destroy', $role) }}"
                                            class="inline"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="text-sm font-medium text-red-600 hover:text-red-900"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus role ini?')"
                                            >
                                                Hapus
                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="px-6 py-10 text-center text-sm text-gray-500"
                            >
                                Belum ada role.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </x-admin.card>

@endsection