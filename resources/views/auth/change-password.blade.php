<x-guest-layout>

    <div class="w-full">

        <div class="w-full max-w-md">

            {{-- =====================================================
                 HEADER
            ====================================================== --}}

            <div class="mb-7 text-center">

                <h1 class="text-2xl font-bold leading-tight text-gray-900">
                    Ubah Password
                </h1>

                <p class="mt-2 text-sm leading-6 text-gray-600">
                    Demi keamanan, Anda wajib mengganti password sementara
                    sebelum melanjutkan ke Dashboard.
                </p>

            </div>


            {{-- =====================================================
                 ERROR
            ====================================================== --}}

            @if ($errors->any())

                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3">

                    <p class="text-sm font-medium text-red-800">
                        Terdapat kesalahan:
                    </p>

                    <ul class="mt-2 list-disc pl-5 text-sm text-red-700">

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- =====================================================
                 FORM
            ====================================================== --}}

            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">

                <form
                    method="POST"
                    action="{{ route('password.change.update') }}"
                    class="space-y-5"
                >

                    @csrf

                    @method('PUT')


                    {{-- Password Saat Ini --}}
                    <div>

                        <label
                            for="current_password"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Password Saat Ini
                        </label>

                        <input
                            id="current_password"
                            name="current_password"
                            type="password"
                            autocomplete="current-password"
                            required
                            autofocus
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >

                        @error('current_password')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Password Baru --}}
                    <div>

                        <label
                            for="password"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Password Baru
                        </label>

                        <input
                            id="password"
                            name="password"
                            type="password"
                            autocomplete="new-password"
                            required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >

                        @error('password')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Konfirmasi Password --}}
                    <div>

                        <label
                            for="password_confirmation"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Konfirmasi Password Baru
                        </label>

                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            autocomplete="new-password"
                            required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >

                        @error('password_confirmation')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- =================================================
                         TOMBOL
                    ================================================== --}}

                    <div class="pt-2">

                        <button
                            type="submit"
                            class="w-full rounded-md bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            Ubah Password
                        </button>

                    </div>

                </form>

            </div>


            {{-- =====================================================
                 KEMBALI
            ====================================================== --}}

            <div class="mt-5 text-center">

                <a
                    href="{{ url('/') }}"
                    class="text-sm font-medium text-gray-600 transition hover:text-gray-900"
                >
                    ← Kembali ke Beranda
                </a>

            </div>

        </div>

    </div>

</x-guest-layout>