@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')

    <div class="mx-auto max-w-5xl space-y-6">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="flex items-start gap-4">

            <div
                class="
                    flex h-12 w-12 shrink-0
                    items-center justify-center
                    rounded-2xl
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
                        d="M12 20h9"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5Z"
                    />
                </svg>
            </div>

            <div class="min-w-0">

                <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                    Edit User
                </h1>

                <p class="mt-1.5 text-sm text-gray-500">
                    Perbarui informasi pengguna.
                </p>

            </div>

        </div>


    <x-admin.card>

        <form
            method="POST"
            action="{{ route('users.update', $user) }}"
        >

            @csrf
            @method('PUT')

            <div class="space-y-6">

                @include('users._form')

            </div>

            {{-- =================================================
                ACTION
            ================================================== --}}

            <div
                class="
                    mt-8
                    flex flex-col gap-4
                    border-t border-gray-100
                    pt-6
                    sm:flex-row
                    sm:items-center
                    sm:justify-between
                "
            >

                {{-- Kembali ke Detail --}}
                <a
                    href="{{ route('users.show', $user) }}"
                    class="
                        inline-flex
                        items-center
                        justify-center
                        gap-2
                        rounded-lg
                        border border-gray-200
                        bg-red-500
                        px-4 py-2.5
                        text-sm font-medium
                        text-white
                        shadow-sm
                        transition
                        hover:border-gray-300
                        hover:bg-gray-100
                        hover:text-gray-900
                        focus:outline-none
                        focus:ring-2
                        focus:ring-gray-500/20
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
                        Kembali ke detail user
                    </span>

                </a>


                {{-- Action kanan --}}
                <div class="flex items-center justify-end gap-3">

                    {{-- Batal --}}
                    <button
                        type="reset"
                        class="
                            inline-flex
                            items-center
                            justify-center
                            rounded-lg
                            border border-gray-300
                            bg-white
                            px-4 py-2.5
                            text-sm font-medium
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
                    </button>


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
                            Simpan Perubahan
                        </span>

                    </button>

                </div>

            </div>

        </form>

    </x-admin.card>

    {{-- =====================================================
        SUCCESS MODAL
    ====================================================== --}}

    @if (session('success'))

        <div
            id="user-update-success-modal"
            class="fixed inset-0 z-[100] flex items-center justify-center p-4"
            aria-hidden="false"
        >

            {{-- Overlay --}}
            <div
                class="absolute inset-0 bg-gray-900/40 backdrop-blur-[1px]"
            ></div>


            {{-- Dialog --}}
            <div
                class="
                    relative z-10
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
                        id="user-update-success-close"
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
                            focus:ring-green-500/30
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


                {{-- Icon --}}
                <div class="flex justify-center px-5 pt-1">

                    <div
                        class="
                            flex h-16 w-16
                            items-center justify-center
                            rounded-2xl
                            bg-green-50
                            text-green-600
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
                                d="m5 12 4.5 4.5L19 7.5"
                            />
                        </svg>

                    </div>

                </div>


                {{-- Message --}}
                <div class="px-5 pb-6 pt-5 text-center">

                    <p
                        class="
                            text-lg
                            font-bold
                            leading-7
                            text-gray-900
                            sm:text-xl
                        "
                    >
                        Data user berhasil diperbarui
                    </p>

                    <p class="mt-2 text-sm text-gray-500">
                        Perubahan data pengguna telah berhasil disimpan.
                    </p>

                </div>


                {{-- Action --}}
                <div
                    class="
                        flex
                        items-center
                        justify-center
                        border-t border-gray-100
                        px-5 py-4
                    "
                >

                    <a
                        href="{{ route('users.index') }}"
                        class="
                            inline-flex
                            min-w-[160px]
                            items-center
                            justify-center
                            gap-2
                            rounded-lg
                            bg-green-600
                            px-4 py-2.5
                            text-sm font-semibold
                            text-white
                            shadow-sm
                            transition
                            hover:bg-green-700
                            focus:outline-none
                            focus:ring-2
                            focus:ring-green-500/30
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

                        Kembali ke User

                    </a>

                </div>

            </div>

        </div>

    @endif

@endsection