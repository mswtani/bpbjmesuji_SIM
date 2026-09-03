@extends('layouts.admin')

@section('title', 'Tambah Role')

@section('content')

    <div class="mx-auto max-w-5xl space-y-6">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="flex items-start gap-4">

            {{-- Icon --}}
            <div
                class="
                    flex h-12 w-12 shrink-0
                    items-center justify-center
                    rounded-2xl
                    bg-blue-50
                    text-blue-600
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
                        d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"
                    />

                    <circle
                        cx="9"
                        cy="7"
                        r="4"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M19 8v6M22 11h-6"
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
                    Tambah Role
                </h1>

                <p class="mt-1.5 text-sm text-gray-500">
                    Tambahkan role baru untuk sistem BPBJ Mesuji.
                </p>

            </div>

        </div>


        {{-- =====================================================
             FORM CARD
        ====================================================== --}}

        <x-admin.card>

            <form
                method="POST"
                action="{{ route('roles.store') }}"
            >

                @csrf


                {{-- =================================================
                     FORM FIELDS
                ================================================== --}}

                <div class="space-y-6">


                    {{-- Code --}}

                    <div>

                        <label
                            for="code"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Kode Role
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            id="code"
                            name="code"
                            value="{{ old('code') }}"
                            placeholder="Contoh: STAFF_PBJ"
                            maxlength="30"
                            required
                            autocomplete="off"
                            class="
                                mt-1 block w-full
                                rounded-lg
                                border-gray-300
                                bg-white
                                shadow-sm
                                focus:border-blue-500
                                focus:ring-blue-500/30
                            "
                        >

                        <p class="mt-1 text-xs text-gray-500">
                            Gunakan kode unik untuk identitas role.
                        </p>

                        @error('code')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Nama Role --}}

                    <div>

                        <label
                            for="name"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Nama Role
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Contoh: Staff PBJ"
                            maxlength="100"
                            required
                            class="
                                mt-1 block w-full
                                rounded-lg
                                border-gray-300
                                bg-white
                                shadow-sm
                                focus:border-blue-500
                                focus:ring-blue-500/30
                            "
                        >

                        @error('name')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Deskripsi --}}

                    <div>

                        <label
                            for="description"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Deskripsi
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            maxlength="255"
                            placeholder="Jelaskan fungsi atau tanggung jawab role ini..."
                            class="
                                mt-1 block w-full
                                rounded-lg
                                border-gray-300
                                bg-white
                                shadow-sm
                                focus:border-blue-500
                                focus:ring-blue-500/30
                            "
                        >{{ old('description') }}</textarea>

                        @error('description')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Level --}}

                    <div>

                        <label
                            for="level"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Level
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="number"
                            id="level"
                            name="level"
                            value="{{ old('level') }}"
                            min="1"
                            max="255"
                            placeholder="Contoh: 3"
                            required
                            class="
                                mt-1 block w-full
                                rounded-lg
                                border-gray-300
                                bg-white
                                shadow-sm
                                focus:border-blue-500
                                focus:ring-blue-500/30
                            "
                        >

                        <p class="mt-1 text-xs text-gray-500">
                            Nilai 1–255 untuk menentukan tingkat role.
                        </p>

                        @error('level')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

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
                    ">

                    {{-- Kembali ke daftar Role --}}

                    <a
                        href="{{ route('roles.index') }}"
                        class="
                            order-2
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
                            hover:bg-gray-50
                            hover:text-gray-900
                            focus:outline-none
                            focus:ring-2
                            focus:ring-gray-500/20
                            sm:order-1
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


                    {{-- Action kanan --}}

                    <div
                        class="
                            flex
                            w-full
                            items-center
                            justify-center
                            gap-3
                            sm:w-auto
                            sm:justify-end
                        ">

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
                                Simpan Role
                            </span>

                        </button>

                    </div>

                </div>

            </form>

        </x-admin.card>

    </div>

@endsection