@extends('layouts.admin')

@section('title', 'Edit Konten')

@section('content')

    <div class="mx-auto max-w-5xl">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="mb-6">

            <div class="flex items-start gap-4">

                {{-- Icon --}}
                <div
                    class="
                        hidden h-12 w-12 shrink-0
                        items-center justify-center
                        rounded-2xl
                        bg-blue-50
                        text-blue-600
                        sm:flex
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


                {{-- Title --}}
                <div class="min-w-0">

                    <h1
                        class="
                            text-2xl font-bold tracking-tight
                            text-gray-900
                            sm:text-3xl
                        "
                    >
                        Edit Konten
                    </h1>

                    <p class="mt-1.5 text-sm text-gray-500">
                        Perbarui informasi konten yang telah tersimpan.
                    </p>

                </div>

            </div>

        </div>


        {{-- =====================================================
             FORM CARD
        ====================================================== --}}

        <x-admin.card :padding="false">

            <div class="p-5 sm:p-6 lg:p-7">

                @include('posts._form', [
                    'post' => $post,
                    'formAction' => route('posts.update', $post),
                    'formMethod' => 'PUT',
                    'submitLabel' => 'Simpan Perubahan',
                    'formId' => 'post-edit-form',
                ])

            </div>


            {{-- ACTION FOOTER --}}
            <div
                class="
                    flex flex-col gap-4
                    border-t border-gray-100
                    px-5 py-5
                    sm:flex-row
                    sm:items-center
                    sm:justify-between
                    sm:px-6
                ">

                {{-- Kembali ke detail --}}
                <a
                    href="{{ route('posts.show', $post) }}"
                    class="
                        inline-flex
                        items-center
                        justify-center
                        gap-2
                        rounded-lg
                        px-3 py-2.5
                        text-sm font-medium
                        text-white
                        bg-red-500
                        transition
                        hover:bg-gray-100
                        hover:text-gray-900
                        focus:outline-none
                        focus:ring-2
                        focus:ring-gray-500/20
                    ">
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

                    <span>Kembali ke detail konten</span>
                </a>


                {{-- Action --}}
                <div
                    class="
                        flex flex-col-reverse
                        gap-3
                        sm:flex-row
                    ">

                    {{-- Batal --}}
                    <button
                        type="button"
                        id="post-edit-cancel"
                        class="
                            inline-flex
                            items-center
                            justify-center
                            gap-2
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
                                d="M6 6l12 12M18 6 6 18"
                            />
                        </svg>

                        <span>Batal</span>
                    </button>


                    {{-- Simpan --}}
                    <button
                        type="submit"
                        form="post-edit-form"
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
                                d="M5 12.5 9.5 17 19 7.5"
                            />
                        </svg>

                        <span>Simpan Perubahan</span>
                    </button>

                </div>

            </div>

        </x-admin.card>

    </div>

@endsection