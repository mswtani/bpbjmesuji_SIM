@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    <div class="max-w-7xl mx-auto space-y-6">

        {{-- Header Dashboard --}}
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Dashboard
            </h1>

            <p class="mt-1 text-sm text-gray-600">
                Selamat datang di sistem BPBJ Mesuji.
            </p>
        </div>


        {{-- Welcome Card --}}
        <div class="bg-white overflow-hidden rounded-lg border border-gray-200 shadow-sm">
            <div class="p-6">

                <h2 class="text-lg font-semibold text-gray-900">
                    Selamat datang,
                    {{ auth()->user()->name }}.
                </h2>

                <p class="mt-2 text-sm text-gray-600">
                    Anda berhasil login ke sistem.
                </p>

            </div>
        </div>


        {{-- Informasi Akun --}}
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

            {{-- Role --}}
            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">

                <p class="text-sm font-medium text-gray-500">
                    Role
                </p>

                <p class="mt-2 text-lg font-semibold text-gray-900">
                    {{ auth()->user()->role?->name ?? '-' }}
                </p>

            </div>


            {{-- Jabatan --}}
            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">

                <p class="text-sm font-medium text-gray-500">
                    Jabatan dalam PBJ
                </p>

                <p class="mt-2 text-lg font-semibold text-gray-900">
                    {{ auth()->user()->position?->name ?? '-' }}
                </p>

            </div>


            {{-- Status --}}
            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">

                <p class="text-sm font-medium text-gray-500">
                    Status Akun
                </p>

                @if (auth()->user()->is_active)
                    <span class="mt-2 inline-flex rounded-full bg-green-100 px-3 py-1 text-sm font-medium text-green-800">
                        Aktif
                    </span>
                @else
                    <span class="mt-2 inline-flex rounded-full bg-red-100 px-3 py-1 text-sm font-medium text-red-800">
                        Tidak Aktif
                    </span>
                @endif

            </div>

        </div>


        {{-- Quick Menu --}}
        <div>

            <h2 class="mb-4 text-lg font-semibold text-gray-900">
                Menu Cepat
            </h2>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

                {{-- Kelola User --}}
                @if (auth()->user()->hasPermission('users.view'))

                    <a
                        href="{{ route('users.index') }}"
                        class="block rounded-lg border border-gray-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
                    >
                        <div class="text-2xl">
                            👤
                        </div>

                        <h3 class="mt-4 font-semibold text-gray-900">
                            Kelola User
                        </h3>

                        <p class="mt-1 text-sm text-gray-600">
                            Kelola data dan akun pengguna.
                        </p>
                    </a>

                @endif


                {{-- Kelola Role --}}
                @if (auth()->user()->hasPermission('roles.view'))

                    <a
                        href="{{ route('roles.index') }}"
                        class="block rounded-lg border border-gray-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
                    >
                        <div class="text-2xl">
                            🔐
                        </div>

                        <h3 class="mt-4 font-semibold text-gray-900">
                            Kelola Role
                        </h3>

                        <p class="mt-1 text-sm text-gray-600">
                            Kelola role dan permission sistem.
                        </p>
                    </a>

                @endif


                {{-- Profil --}}
                <a
                    href="{{ route('profile.edit') }}"
                    class="block rounded-lg border border-gray-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
                >
                    <div class="text-2xl">
                        👤
                    </div>

                    <h3 class="mt-4 font-semibold text-gray-900">
                        Profil Saya
                    </h3>

                    <p class="mt-1 text-sm text-gray-600">
                        Lihat dan ubah informasi profil Anda.
                    </p>
                </a>

            </div>

        </div>

    </div>

@endsection