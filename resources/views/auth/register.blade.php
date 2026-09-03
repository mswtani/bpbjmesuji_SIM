<x-guest-layout>


    <form
        method="POST"
        action="{{ route('register') }}"
        enctype="multipart/form-data"
        data-indonesian-validation
    >
        @csrf

        {{-- Jenis Akun --}}
        <div>
            <x-input-label
                for="user_type"
                value="Jenis Akun"
            />

            <div class="mt-2 space-y-3">
                <label class="flex items-center">
                    <input
                        type="radio"
                        name="user_type"
                        value="public"
                        class="border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                        {{ old('user_type', 'public') === 'public' ? 'checked' : '' }}
                    >

                    <span class="ms-2 text-sm text-gray-700">
                        Publik/ Penyedia
                    </span>
                </label>

                <label class="flex items-center">
                    <input
                        type="radio"
                        name="user_type"
                        value="asn"
                        class="border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                        {{ old('user_type') === 'asn' ? 'checked' : '' }}
                    >

                    <span class="ms-2 text-sm text-gray-700">
                        Pelaku pengadaan non penyedia
                    </span>
                </label>
            </div>

            <x-input-error
                :messages="$errors->get('user_type')"
                class="mt-2"
            />
        </div>


        {{-- Data ASN --}}
        <div
            id="asn-fields"
            class="mt-4 space-y-4"
            style="display: none;"
        >

            {{-- NIP --}}
            <div>
                <x-input-label
                    for="nip"
                    value="NIP"
                />

                <x-text-input
                    id="nip"
                    class="block mt-1 w-full"
                    type="text"
                    name="nip"
                    :value="old('nip')"
                    autocomplete="off"
                />

                <x-input-error
                    :messages="$errors->get('nip')"
                    class="mt-2"
                />
            </div>


            {{-- Jabatan --}}
            <div>
                <x-input-label
                    for="position_id"
                    value="Jabatan"
                />

                <select
                    id="position_id"
                    name="position_id"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                >
                    <option value="">
                        -- Pilih Jabatan --
                    </option>

                    @foreach ($positions as $position)
                        <option
                            value="{{ $position->id }}"
                            {{ old('position_id') == $position->id ? 'selected' : '' }}
                        >
                            {{ $position->name }}
                        </option>
                    @endforeach
                </select>

                <x-input-error
                    :messages="$errors->get('position_id')"
                    class="mt-2"
                />
            </div>


            {{-- Dokumen Pengangkatan --}}
            <div>
                <x-input-label
                    for="appointment_document"
                    value="Dokumen Pengangkatan / SK"
                />

                <input
                    id="appointment_document"
                    type="file"
                    name="appointment_document"
                    accept=".pdf,application/pdf"
                    class="block mt-1 w-full text-sm text-gray-700
                           file:mr-4 file:py-2 file:px-4
                           file:rounded-md file:border-0
                           file:text-sm file:font-semibold
                           file:bg-indigo-50 file:text-indigo-700
                           hover:file:bg-indigo-100"
                >

                <p class="mt-1 text-sm text-gray-500">
                    Upload dokumen pengangkatan atau SK dalam format PDF.
                    Maksimal 5 MB.
                </p>

                <x-input-error
                    :messages="$errors->get('appointment_document')"
                    class="mt-2"
                />
            </div>

        </div>


        {{-- Nama --}}
        <div class="mt-4">
            <x-input-label
                for="name"
                :value="__('Nama Lengkap')"
            />

            <x-text-input
                id="name"
                class="block mt-1 w-full"
                type="text"
                name="name"
                :value="old('name')"
                required
                data-label="Nama lengkap"
                autofocus
                autocomplete="name"
            />

            <x-input-error
                :messages="$errors->get('name')"
                class="mt-2"
            />
        </div>


        {{-- Email --}}
        <div class="mt-4">
            <x-input-label
                for="email"
                :value="__('Email')"
            />

            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                data-label="Alamat email"
                autocomplete="username"
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />
        </div>

        
       {{-- Password --}}
        <div class="mt-4">
            <x-input-label
                for="password"
                :value="__('Password')"
            />

            <div class="relative mt-1">
                <x-text-input
                    id="password"
                    class="block w-full pe-10"
                    type="password"
                    name="password"
                    required
                    data-label="Konfirmasi password"
                    autocomplete="new-password"
                />

                <button
                    type="button"
                    id="toggle-password"
                    class="absolute inset-y-0 end-0 flex items-center px-3 text-gray-500 hover:text-gray-700"
                    aria-label="Tampilkan password"
                >
                    {{-- Icon Mata --}}
                    <svg
                        id="password-eye"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 0c0 1-3.582 7-9 7s-9-6-9-7 3.582-7 9-7 9 6 9 7z"
                        />
                    </svg>
                </button>
            </div>

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />
        </div>


        {{-- Konfirmasi Password --}}
        <div class="mt-4">
            <x-input-label
                for="password_confirmation"
                :value="__('Konfirmasi Password')"
            />

            <div class="relative mt-1">
                <x-text-input
                    id="password_confirmation"
                    class="block w-full pe-10"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <button
                    type="button"
                    id="toggle-password-confirmation"
                    class="absolute inset-y-0 end-0 flex items-center px-3 text-gray-500 hover:text-gray-700"
                    aria-label="Tampilkan konfirmasi password"
                >
                    {{-- Icon Mata --}}
                    <svg
                        id="password-confirmation-eye"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 0c0 1-3.582 7-9 7s-9-6-9-7 3.582-7 9-7 9 6 9 7z"
                        />
                    </svg>
                </button>
            </div>

            <x-input-error
                :messages="$errors->get('password_confirmation')"
                class="mt-2"
            />
        </div>


        {{-- Tombol --}}
        <div class="flex items-center justify-between mt-6">
            <a
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}"
            >
                Sudah memiliki akun?
            </a>

            <x-primary-button>
                Daftar
            </x-primary-button>
        </div>

    </form>


    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const publicRadio = document.querySelector(
                'input[name="user_type"][value="public"]'
            );

            const asnRadio = document.querySelector(
                'input[name="user_type"][value="asn"]'
            );

            const asnFields = document.getElementById(
                'asn-fields'
            );

            const nip = document.getElementById(
                'nip'
            );

            const position = document.getElementById(
                'position_id'
            );

            const appointmentDocument = document.getElementById(
                'appointment_document'
            );


            function toggleAsnFields() {

                if (asnRadio.checked) {

                    asnFields.style.display = 'block';

                    nip.required = true;
                    position.required = true;
                    appointmentDocument.required = true;

                } else {

                    asnFields.style.display = 'none';

                    nip.required = false;
                    position.required = false;
                    appointmentDocument.required = false;

                    nip.value = '';
                    position.value = '';
                    appointmentDocument.value = '';

                }

            }


            const passwordInput = document.getElementById('password');
            const togglePassword = document.getElementById('toggle-password');

            const passwordConfirmationInput = document.getElementById(
                'password_confirmation'
            );

            const togglePasswordConfirmation = document.getElementById(
                'toggle-password-confirmation'
            );


            togglePassword.addEventListener('click', function () {

                if (passwordInput.type === 'password') {

                    passwordInput.type = 'text';

                    this.setAttribute(
                        'aria-label',
                        'Sembunyikan password'
                    );

                } else {

                    passwordInput.type = 'password';

                    this.setAttribute(
                        'aria-label',
                        'Tampilkan password'
                    );

                }

            });


            togglePasswordConfirmation.addEventListener(
                'click',
                function () {

                    if (
                        passwordConfirmationInput.type === 'password'
                    ) {

                        passwordConfirmationInput.type = 'text';

                        this.setAttribute(
                            'aria-label',
                            'Sembunyikan konfirmasi password'
                        );

                    } else {

                        passwordConfirmationInput.type = 'password';

                        this.setAttribute(
                            'aria-label',
                            'Tampilkan konfirmasi password'
                        );

                    }

                }
            );


            publicRadio.addEventListener(
                'change',
                toggleAsnFields
            );

            asnRadio.addEventListener(
                'change',
                toggleAsnFields
            );


            toggleAsnFields();

        });
    </script>

</x-guest-layout>