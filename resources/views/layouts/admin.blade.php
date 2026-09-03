<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>
        @yield('title', 'Dashboard')
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body
    class="min-h-screen bg-gray-50 text-gray-900"

    @if (
        session('success')
        && session('success_type') !== 'reset-password'
    )
        data-success-message="{{ session('success') }}"
        data-success-type="{{ session('success_type', 'create') }}"
        data-success-redirect="{{ session('success_redirect') }}"
    @endif
>

    {{-- =====================================================
         ADMIN SIDEBAR
    ====================================================== --}}

    @include('layouts.partials.admin.sidebar')


    {{-- =====================================================
         MOBILE OVERLAY
    ====================================================== --}}

    <div
        id="admin-sidebar-overlay"
        class="fixed inset-0 z-40 hidden bg-gray-900/40 lg:hidden"
    ></div>


    {{-- =====================================================
         MAIN AREA
    ====================================================== --}}

    <div
        id="admin-main"
        class="min-h-screen transition-[margin] duration-300 lg:ml-64">

        {{-- TOPBAR --}}

        @include('layouts.partials.admin.topbar')


        {{-- CONTENT --}}

        <main class="min-h-[calc(100vh-72px)] px-4 py-6">

            @yield('content')

        </main>


        {{-- FOOTER --}}

        @include('layouts.partials.admin.footer')

        {{-- =====================================================
            GLOBAL ACTION CONFIRMATION MODAL
        ====================================================== --}}
        <div
            id="admin-confirm-modal"
            class="fixed inset-0 z-[100] hidden"
            aria-hidden="true"
        >
            {{-- Overlay --}}
            <div
                id="admin-confirm-overlay"
                class="absolute inset-0 bg-gray-900/40 backdrop-blur-[1px]"
            ></div>


            {{-- Dialog Wrapper --}}
            <div
                class="
                    relative z-10
                    flex min-h-full
                    items-center justify-center
                    p-4
                "
            >

                {{-- Dialog --}}
                <div
                    id="admin-confirm-dialog"
                    role="dialog"
                    aria-modal="true"
                    aria-describedby="admin-confirm-message"
                    class="
                        w-full max-w-md
                        overflow-hidden
                        rounded-2xl
                        border border-gray-200
                        bg-white
                        shadow-2xl
                    "
                >

                    {{-- Close --}}
                    <div class="flex justify-end px-4 pt-4">

                        <button
                            type="button"
                            id="admin-confirm-close"
                            aria-label="Tutup"
                            title="Tutup"
                            class="
                                inline-flex h-9 w-9
                                items-center justify-center
                                rounded-lg
                                text-gray-400
                                transition
                                hover:bg-gray-100
                                hover:text-gray-700
                                focus:outline-none
                                focus:ring-2
                                focus:ring-blue-500/30
                            "
                        >

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6 6l12 12M18 6 6 18"
                                />
                            </svg>

                        </button>

                    </div>


                    {{-- ICON --}}
                    <div class="flex justify-center px-5 pt-1">

                        <div
                            id="admin-confirm-icon"
                            class="
                            flex h-16 w-16
                            items-center justify-center
                            rounded-2xl                          
                            ">

                            {{-- Publish --}}
                            <svg
                                data-confirm-icon="publish"
                                class="hidden h-8 w-8"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m5 12 4 4L19 6"
                                />
                            </svg>


                            {{-- Archive --}}
                            <svg
                                data-confirm-icon="archive"
                                class="hidden h-8 w-8"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4 7h16v13H4V7Z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 7l2-4h14l2 4M9 12h6"
                                />
                            </svg>


                            {{-- Restore --}}
                            <svg
                                data-confirm-icon="restore"
                                class="hidden h-8 w-8"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4 12a8 8 0 1 0 2.34-5.66"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4 5v5h5"
                                />
                            </svg>

                           {{-- Update --}}
                            <svg
                                data-confirm-icon="update"
                                class="hidden h-8 w-8"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 20h9"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5Z"
                                />
                            </svg>


                            {{-- Delete --}}
                            <svg
                                data-confirm-icon="delete"
                                class="hidden h-8 w-8"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6 7h12M9 7V4h6v3M8 7l1 13h6l1-13M10 11v5M14 11v5"
                                />
                            </svg>

                            {{-- Deactivate --}}
                            <svg
                                data-confirm-icon="deactivate"
                                class="hidden h-8 w-8"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24">
                                <circle
                                    cx="12"
                                    cy="12"
                                    r="9"
                                />

                                <path
                                    stroke-linecap="round"
                                    d="M8 12h8"
                                />
                            </svg>

                            {{-- Reset Password --}}
                            <svg
                                data-confirm-icon="reset-password"
                                class="hidden h-8 w-8"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4 12a8 8 0 1 0 3-6.2"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4 5v5h5"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 10v4"
                                />

                                <circle
                                    cx="12"
                                    cy="16.5"
                                    r=".5"
                                    fill="currentColor"
                                    stroke="none"
                                />
                            </svg>

                            {{-- Activate --}}
                            <svg
                                data-confirm-icon="activate"
                                class="hidden h-8 w-8"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24"
                            >
                                <circle
                                    cx="12"
                                    cy="12"
                                    r="9"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m8 12 2.5 2.5L16 9"
                                />
                            </svg>

                        </div>

                    </div>


                    {{-- MESSAGE --}}
                    <div class="px-5 pb-6 pt-5 text-center">

                        <p
                            id="admin-confirm-message"
                            class="
                                text-lg
                                font-bold
                                leading-7
                                text-gray-900
                                sm:text-xl
                            "
                        ></p>

                    </div>


                    {{-- ACTION --}}
                    <div
                        class="
                            flex items-center justify-center
                            gap-3
                            border-t border-gray-100
                            bg-gray-50/70
                            px-5 py-4
                        "
                    >

                        <button
                            type="button"
                            id="admin-confirm-cancel"
                            class="
                                inline-flex
                                min-w-[100px]
                                items-center justify-center
                                rounded-lg
                                border border-gray-300
                                bg-white
                                px-4 py-2.5
                                text-sm font-medium
                                text-gray-700
                                shadow-sm
                                transition
                                hover:bg-gray-50
                                focus:outline-none
                                focus:ring-2
                                focus:ring-gray-400/30
                            "
                        >
                            Batal
                        </button>


                        <button
                            type="button"
                            id="admin-confirm-submit"
                            class="
                                inline-flex
                                min-w-[120px]
                                items-center justify-center
                                rounded-lg
                                bg-blue-600
                                px-4 py-2.5
                                text-sm font-semibold
                                text-white
                                shadow-sm
                                transition
                                hover:bg-blue-700
                                focus:outline-none
                                focus:ring-2
                                focus:ring-blue-500/30
                            "
                        >
                            Konfirmasi
                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- =====================================================
        GLOBAL SUCCESS MODAL
    ====================================================== --}}
    <div
        id="admin-success-modal"
        class="fixed inset-0 z-[110] hidden"
        aria-hidden="true"
    >
        {{-- Overlay --}}
        <div
            id="admin-success-overlay"
            class="absolute inset-0 bg-gray-900/40 backdrop-blur-[1px]"
        ></div>


        {{-- Dialog Wrapper --}}
        <div
            class="
                relative z-10
                flex min-h-full
                items-center justify-center
                p-4
            "
        >

            {{-- Dialog --}}
            <div
                role="dialog"
                aria-modal="true"
                aria-describedby="admin-success-message"
                class="
                    w-full max-w-md
                    overflow-hidden
                    rounded-2xl
                    border border-gray-200
                    bg-white
                    shadow-2xl
                "
            >

                {{-- Close --}}
                <div class="flex justify-end px-4 pt-4">

                    <button
                        type="button"
                        id="admin-success-close"
                        aria-label="Tutup"
                        title="Tutup"
                        class="
                            inline-flex h-9 w-9
                            items-center justify-center
                            rounded-lg
                            text-gray-400
                            transition
                            hover:bg-gray-100
                            hover:text-gray-700
                            focus:outline-none
                            focus:ring-2
                            focus:ring-blue-500/30
                        "
                    >

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 6l12 12M18 6 6 18"
                            />
                        </svg>

                    </button>

                </div>


                {{-- ICON --}}
                <div class="flex justify-center px-5 pt-1">

                    <div
                        id="admin-success-icon"
                        class="
                            flex h-16 w-16
                            items-center justify-center
                            rounded-2xl
                            bg-emerald-50
                            text-emerald-600
                        "
                    >

                        <svg
                            class="h-8 w-8"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m5 12 4 4L19 6"
                            />
                        </svg>

                    </div>

                </div>


                {{-- MESSAGE --}}
                <div class="px-5 pb-6 pt-5 text-center">

                    <p
                        id="admin-success-message"
                        class="
                            text-lg
                            font-bold
                            leading-7
                            text-gray-900
                            sm:text-xl
                        "
                    ></p>

                </div>


                {{-- ACTION --}}
                <div
                    class="
                        flex items-center justify-center
                        border-t border-gray-100
                        bg-gray-50/70
                        px-5 py-4
                    "
                >

                    <button
                        type="button"
                        id="admin-success-ok"
                        class="
                            inline-flex
                            min-w-[120px]
                            items-center
                            justify-center
                            rounded-lg
                            bg-emerald-600
                            px-4 py-2.5
                            text-sm font-semibold
                            text-white
                            shadow-sm
                            transition
                            hover:bg-emerald-700
                            focus:outline-none
                            focus:ring-2
                            focus:ring-emerald-500/30
                        "
                    >
                        OK
                    </button>

                </div>

            </div>

        </div>

    </div>

</body>

</html>