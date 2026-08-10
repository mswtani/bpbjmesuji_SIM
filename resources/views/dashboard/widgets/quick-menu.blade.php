<div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">

    {{-- Kelola User --}}
    @if (auth()->user()->hasPermission('users.view'))

        <a
            href="{{ route('users.index') }}"
            class="block rounded-lg border border-gray-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
        >

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-100">
                    <span class="text-xl">
                        👤
                    </span>
                </div>

                <div>

                    <h3 class="font-semibold text-gray-900">
                        Kelola User
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Manajemen pengguna sistem
                    </p>

                </div>

            </div>

        </a>

    @endif


    {{-- Kelola Role --}}
    @if (auth()->user()->hasPermission('roles.view'))

        <a
            href="{{ route('roles.index') }}"
            class="block rounded-lg border border-gray-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
        >

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-purple-100">
                    <span class="text-xl">
                        🔐
                    </span>
                </div>

                <div>

                    <h3 class="font-semibold text-gray-900">
                        Kelola Role
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Manajemen role dan hak akses
                    </p>

                </div>

            </div>

        </a>

    @endif

</div>