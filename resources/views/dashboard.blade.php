@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    <div class="w-full space-y-5 sm:space-y-6">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div>
            <h1 class="text-xl font-bold tracking-tight text-gray-900 sm:text-2xl">
                Dashboard
            </h1>

            <p class="mt-1 text-xs text-gray-500 sm:text-sm">
                Sistem Informasi Manajemen BPBJ Mesuji.
            </p>
        </div>


        {{-- =====================================================
             MENU CEPAT
        ====================================================== --}}

        <x-admin.card
            title="Menu Cepat"
            description="Akses fitur yang paling sering digunakan."
        >

            <div
                class="
                    grid grid-cols-1 gap-3
                    sm:grid-cols-2 sm:gap-4
                    lg:grid-cols-3
                "
            >

                {{-- Konten --}}

                @if (auth()->user()?->hasPermission('posts.view'))

                    <x-admin.menu-card
                        href="{{ route('posts.index') }}"
                        title="Kelola Konten"
                        description="Kelola berita, pengumuman, dan regulasi."
                        icon="document"
                    />

                @endif


                {{-- Helpdesk --}}

                @if (auth()->user()?->hasPermission('helpdesk.view'))

                    <x-admin.menu-card
                        href="{{ route('helpdesk.admin.index') }}"
                        title="Helpdesk"
                        description="Kelola pertanyaan dan layanan pengguna."
                        icon="helpdesk"
                    />

                @endif


                {{-- Pengguna --}}

                @if (auth()->user()?->hasPermission('users.view'))

                    <x-admin.menu-card
                        href="{{ route('users.index') }}"
                        title="Kelola Pengguna"
                        description="Kelola data dan akun pengguna."
                        icon="users"
                    />

                @endif


                {{-- Role & Permission --}}

                @if (auth()->user()?->hasPermission('roles.view'))

                    <x-admin.menu-card
                        href="{{ route('roles.index') }}"
                        title="Role & Permission"
                        description="Kelola role dan permission sistem."
                        icon="roles"
                    />

                @endif


                {{-- Profil --}}

                <x-admin.menu-card
                    href="{{ route('profile.edit') }}"
                    title="Profil Saya"
                    description="Lihat dan ubah informasi profil Anda."
                    icon="profile"
                />

            </div>

        </x-admin.card>


        {{-- =====================================================
             RINGKASAN SISTEM
        ====================================================== --}}

        <x-admin.card
            title="Ringkasan Sistem"
            description="Informasi singkat mengenai kondisi sistem."
        >

            <div
                class="
                    grid grid-cols-1 gap-3
                    sm:grid-cols-2
                    lg:grid-cols-3
                "
            >

                <x-admin.stat-card
                    title="Konten"
                    value="—"
                    description="Statistik konten akan tersedia."
                    icon="document"
                />

                <x-admin.stat-card
                    title="Helpdesk"
                    value="—"
                    description="Statistik layanan akan tersedia."
                    icon="helpdesk"
                />

                <x-admin.stat-card
                    title="Pengguna"
                    value="—"
                    description="Statistik pengguna akan tersedia."
                    icon="users"
                />

            </div>

        </x-admin.card>


        {{-- =====================================================
             NOTIFIKASI
        ====================================================== --}}

        <x-admin.card
            title="Notifikasi"
            description="Pemberitahuan yang membutuhkan perhatian Anda."
        >

            <div class="divide-y divide-gray-100">

                <x-admin.notification-item
                    title="Approval konten"
                    description="Notifikasi draft yang membutuhkan proses publikasi akan muncul di sini."
                    type="warning"
                />

                <x-admin.notification-item
                    title="Helpdesk"
                    description="Notifikasi pertanyaan atau balasan pengguna akan muncul di sini."
                    type="info"
                />

                <x-admin.notification-item
                    title="Informasi sistem"
                    description="Notifikasi sistem akan ditampilkan di bagian ini."
                    type="success"
                />

            </div>

        </x-admin.card>

    </div>

@endsection