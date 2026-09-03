@extends('layouts.admin')

@section('title', 'Permission Role')

@section('content')

    @php

        /*
        |--------------------------------------------------------------------------
        | GROUP PERMISSION
        |--------------------------------------------------------------------------
        |
        | Permission dikelompokkan berdasarkan bagian sebelum tanda titik.
        |
        | users.view          -> users
        | users.create        -> users
        | roles.view          -> roles
        | posts.create        -> posts
        | helpdesk.view       -> helpdesk
        |
        */

        $permissionGroups = $permissions->groupBy(
            fn ($permission) =>
                str($permission->code)
                    ->before('.')
                    ->lower()
                    ->value()
        );


        /*
        |--------------------------------------------------------------------------
        | LABEL GROUP
        |--------------------------------------------------------------------------
        */

        $groupLabels = [
            'users' => 'User',
            'roles' => 'Role',
            'posts' => 'Konten',
            'helpdesk' => 'Helpdesk',
        ];


        /*
        |--------------------------------------------------------------------------
        | URUTAN GROUP
        |--------------------------------------------------------------------------
        |
        | Supaya urutan selalu:
        | User
        | Role
        | Konten
        | Helpdesk
        |
        */

        $groupOrder = [
            'users',
            'roles',
            'posts',
            'helpdesk',
        ];

        $permissionGroups = $permissionGroups->sortBy(
            fn ($groupPermissions, $group) =>
                array_search($group, $groupOrder, true)
                ?? 999
        );

    @endphp


    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <div class="mx-auto max-w-5xl space-y-6">

            <div class="flex items-start gap-4">

                {{-- Icon --}}

                <div
                    class="
                        flex
                        h-12 w-12
                        shrink-0
                        items-center
                        justify-center
                        rounded-xl
                        bg-amber-50
                        text-amber-600
                    "
                >

                    <svg
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 15.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06-1.5 1.5-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.5V20h-2.12v-.08a1.65 1.65 0 0 0-1-1.5 1.65 1.65 0 0 0-1.82.33l-.06.06-1.5-1.5.06-.06A1.65 1.65 0 0 0 9.4 15a1.65 1.65 0 0 0-1.5-1H7.8v-2.12h.1a1.65 1.65 0 0 0 1.5-1 1.65 1.65 0 0 0-.33-1.82L9 9l1.5-1.5.06.06a1.65 1.65 0 0 0 1.82.33 1.65 1.65 0 0 0 1-1.5V6h2.12v.08a1.65 1.65 0 0 0 1 1.5 1.65 1.65 0 0 0 1.82-.33l.06-.06L19.9 8.7l-.06.06a1.65 1.65 0 0 0-.33 1.82 1.65 1.65 0 0 0 1.5 1h.08v2.12H21a1.65 1.65 0 0 0-1.6 1.3Z"
                        />
                    </svg>

                </div>


                {{-- Title --}}

                <div class="min-w-0">

                    <h1
                        class="
                            text-2xl
                            font-semibold
                            leading-tight
                            text-gray-900
                        "
                    >
                        Permission Role
                    </h1>

                    <p class="mt-1 text-sm text-gray-600">

                        Atur hak akses untuk role:

                        <span class="font-semibold text-gray-900">
                            {{ $role->name }}
                        </span>

                    </p>

                </div>

            </div>





        {{-- =========================================================
            FORM
        ========================================================== --}}

        <form
            method="POST"
            action="{{ route('roles.permissions.update', $role) }}"
            data-confirm="Perbarui permission role ini?"
            data-confirm-action="default"
            data-confirm-button="Simpan Permission">

            @csrf

            @method('PUT')


            {{-- =====================================================
                PERMISSION GROUPS
            ====================================================== --}}

            <div class="space-y-6">


                @forelse ($permissionGroups as $group => $groupPermissions)

                    {{-- =================================================
                        SATU CARD UNTUK SATU GROUP
                    ================================================== --}}

                    <x-admin.card>


                        {{-- Group Header --}}

                        <div
                            class="
                                flex
                                items-start
                                justify-between
                                gap-4
                                border-b
                                border-gray-200
                                pb-4
                            "
                        >

                            <div class="min-w-0">

                                <h2
                                    class="
                                        text-sm
                                        font-semibold
                                        uppercase
                                        tracking-wide
                                        text-gray-900
                                    "
                                >
                                    {{ $groupLabels[$group] ?? ucfirst($group) }}
                                </h2>

                                <p
                                    class="
                                        mt-1
                                        text-xs
                                        text-gray-500
                                    "
                                >
                                    Hak akses modul
                                    {{ strtolower($groupLabels[$group] ?? $group) }}.
                                </p>

                            </div>


                            {{-- Jumlah Permission --}}

                            <span
                                class="
                                    inline-flex
                                    shrink-0
                                    items-center
                                    rounded-full
                                    bg-gray-100
                                    px-2.5 py-1
                                    text-xs
                                    font-medium
                                    text-gray-600
                                "
                            >
                                {{ $groupPermissions->count() }}
                                permission
                            </span>

                        </div>



                        {{-- =================================================
                            PERMISSION LIST
                        ================================================== --}}

                        <div class="divide-y divide-gray-100">


                            @foreach ($groupPermissions as $permission)

                                <label
                                    for="permission-{{ $permission->id }}"
                                    class="
                                        flex
                                        cursor-pointer
                                        items-start
                                        gap-3
                                        px-1
                                        py-4
                                        transition
                                        hover:bg-gray-50
                                        sm:px-2
                                    "
                                >

                                    {{-- Checkbox --}}

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
                                        class="
                                            mt-1
                                            h-4 w-4
                                            shrink-0
                                            rounded
                                            border-gray-300
                                            text-blue-600
                                            focus:ring-2
                                            focus:ring-blue-500/30
                                        "
                                    >


                                    {{-- Permission Information --}}

                                    <div class="min-w-0">

                                        <p
                                            class="
                                                text-sm
                                                font-medium
                                                text-gray-900
                                            "
                                        >
                                            {{ $permission->name }}
                                        </p>


                                        <p
                                            class="
                                                mt-0.5
                                                break-all
                                                text-xs
                                                font-medium
                                                text-gray-400
                                            "
                                        >
                                            {{ $permission->code }}
                                        </p>


                                        @if ($permission->description)

                                            <p
                                                class="
                                                    mt-1
                                                    text-sm
                                                    leading-6
                                                    text-gray-500
                                                "
                                            >
                                                {{ $permission->description }}
                                            </p>

                                        @endif

                                    </div>

                                </label>

                            @endforeach


                        </div>

                    </x-admin.card>


                @empty

                    {{-- =================================================
                        EMPTY STATE
                    ================================================== --}}

                    <div
                        class="
                            py-10
                            text-center
                        "
                    >

                        <div
                            class="
                                mx-auto
                                flex
                                h-12 w-12
                                items-center
                                justify-center
                                rounded-full
                                bg-gray-100
                                text-gray-400
                            "
                        >

                            <svg
                                class="h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 9v4"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 17h.01"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M10.3 3.6 2.8 17a2 2 0 0 0 1.75 3h14.9a2 2 0 0 0 1.75-3L13.7 3.6a2 2 0 0 0-3.4 0Z"
                                />
                            </svg>

                        </div>


                        <p
                            class="
                                mt-3
                                text-sm
                                font-medium
                                text-gray-700
                            "
                        >
                            Belum ada permission.
                        </p>

                        <p
                            class="
                                mt-1
                                text-sm
                                text-gray-500
                            "
                        >
                            Tambahkan permission terlebih dahulu.
                        </p>

                    </div>

                @endforelse


            </div>



            {{-- =========================================================
                VALIDATION ERROR
            ========================================================== --}}

            @error('permissions')

                <p
                    class="
                        mt-4
                        text-sm
                        text-red-600
                    "
                >
                    {{ $message }}
                </p>

            @enderror



            {{-- =========================================================
                ACTION
            ========================================================== --}}

            <div
                class="
                    mt-8
                    border-t
                    border-gray-200
                    pt-6
                "
            >

                <div
                    class="
                        flex
                        flex-col-reverse
                        items-center
                        justify-center
                        gap-3
                        sm:flex-row
                        sm:justify-between
                    "
                >


                    {{-- Kembali ke daftar --}}

                    <a
                        href="{{ route('roles.index') }}"
                        class="
                            inline-flex
                            w-full
                            items-center
                            justify-center
                            gap-2
                            rounded-lg
                            bg-red-500
                            px-4
                            py-2.5
                            text-sm
                            font-medium
                            text-white
                            shadow-sm
                            transition
                            hover:bg-red-600
                            focus:outline-none
                            focus:ring-2
                            focus:ring-red-500/30
                            sm:w-auto
                        "
                    >

                        <svg
                            class="h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19 12H5"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m12 19-7-7 7-7"
                            />
                        </svg>

                        <span>
                            Kembali ke daftar role
                        </span>

                    </a>



                    {{-- Tombol kanan --}}

                    <div
                        class="
                            flex
                            w-full
                            items-center
                            justify-center
                            gap-3
                            sm:w-auto
                        "
                    >

                        {{-- Batal --}}

                        <a
                            href="{{ route('roles.index') }}"
                            class="
                                inline-flex
                                items-center
                                justify-center
                                rounded-lg
                                border
                                border-gray-300
                                bg-white
                                px-4
                                py-2.5
                                text-sm
                                font-medium
                                text-gray-700
                                shadow-sm
                                transition
                                hover:bg-gray-50
                                hover:text-gray-900
                                focus:outline-none
                                focus:ring-2
                                focus:ring-gray-500/20
                            "
                        >
                            Batal
                        </a>


                        {{-- Simpan --}}

                        <button
                            type="submit"
                            class="
                                inline-flex
                                items-center
                                justify-center
                                gap-2
                                rounded-lg
                                bg-blue-600
                                px-4
                                py-2.5
                                text-sm
                                font-semibold
                                text-white
                                shadow-sm
                                transition
                                hover:bg-blue-700
                                focus:outline-none
                                focus:ring-2
                                focus:ring-blue-500/30
                            "
                        >

                            <svg
                                class="h-4 w-4"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m5 12.5 4.5 4.5L19 7.5"
                                />
                            </svg>

                            <span>
                                Simpan Permission
                            </span>

                        </button>

                    </div>

                </div>

            </div>


        </form>
        
    </div>

@endsection