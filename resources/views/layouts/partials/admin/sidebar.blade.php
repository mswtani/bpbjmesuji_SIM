@if (auth()->user()->hasRole('SUPER_ADMIN'))

    <a
        href="{{ route('users.index') }}"
        class="block rounded-lg bg-white p-5 shadow transition hover:-translate-y-1 hover:shadow-md"
    >

        <div class="text-2xl">
            👤
        </div>

        <h3 class="mt-3 font-semibold text-gray-900">
            Kelola User
        </h3>

        <p class="mt-1 text-sm text-gray-500">
            Manajemen pengguna sistem
        </p>

    </a>

@endif