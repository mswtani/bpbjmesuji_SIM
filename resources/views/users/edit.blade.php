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


        {{-- =====================================================
             FORM CARD
        ====================================================== --}}

        <x-admin.card :padding="false">

            <form
                method="POST"
                action="{{ route('users.update', $user) }}"
                class="space-y-6"
            >

                @csrf
                @method('PUT')

                <div class="p-5 sm:p-6 lg:p-7">

                    @include('users._form')

                </div>


                {{-- =================================================
                     ACTION
                ================================================== --}}

                <div
                    class="
                        flex
                        flex-col
                        gap-4
                        border-t
                        border-gray-100
                        px-5
                        py-5

                        sm:flex-row
                        sm:items-center
                        sm:justify-between
                        sm:px-6
                    "
                >

                    {{-- =================================================
                         KEMBALI
                         Mobile  : order 3
                         Desktop : order 1 (kiri)
                    ================================================== --}}

                    <a
                        href="{{ route('users.show', $user) }}"
                        class="
                            order-3

                            inline-flex
                            w-full
                            items-center
                            justify-center
                            gap-2
                            rounded-lg
                            bg-red-500
                            px-5
                            py-2.5
                            text-sm
                            font-semibold
                            text-white
                            shadow-sm
                            transition

                            hover:bg-red-600

                            focus:outline-none
                            focus:ring-2
                            focus:ring-red-500/30

                            sm:order-1
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
                            Kembali ke detail user
                        </span>

                    </a>


                    {{-- =================================================
                         ACTION KANAN
                         Mobile  : Batal → Simpan
                         Desktop : tetap satu baris di kanan
                    ================================================== --}}

                    <div
                        class="
                            order-1
                            flex
                            w-full
                            flex-col
                            gap-3

                            sm:order-2
                            sm:w-auto
                            sm:flex-row
                            sm:items-center
                        "
                    >

                        {{-- Batal --}}
                        <button
                            type="reset"
                            class="
                                order-1

                                inline-flex
                                w-full
                                items-center
                                justify-center
                                rounded-lg
                                border
                                border-gray-300
                                bg-white
                                px-5
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

                                sm:order-1
                                sm:w-auto
                            "
                        >
                            Batal
                        </button>


                        {{-- Simpan --}}
                        <button
                            type="submit"
                            class="
                                order-2

                                inline-flex
                                w-full
                                items-center
                                justify-center
                                gap-2
                                rounded-lg
                                bg-blue-600
                                px-5
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

                                sm:order-2
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

    </div>

@endsection