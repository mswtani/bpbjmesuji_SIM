<x-guest-layout>


    {{-- Notifikasi --}}
    @if (session('status'))

        <div
            class="
                mb-5
                rounded-lg
                border
                border-green-200
                bg-green-50
                px-4
                py-3
                text-sm
                leading-6
                text-green-700
            "
        >
            {{ session('status') }}
        </div>

    @endif


    {{-- Error Login --}}
    @if ($errors->any())

        <div
            class="
                mb-5
                rounded-lg
                border
                border-red-200
                bg-red-50
                px-4
                py-3
                text-sm
                leading-6
                text-red-700
            "
        >

            <p class="font-semibold">
                Login gagal.
            </p>

            <ul class="mt-1 list-disc ps-5">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        method="POST"
        action="{{ route('login') }}"
        data-indonesian-validation
        class="space-y-5"
    >

        @csrf


        {{-- Email --}}
        <div>

            <x-input-label
                for="email"
                :value="'Alamat Email'"
            />

            <x-text-input
                id="email"
                class="mt-1 block w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                data-label="Alamat email"
                autofocus
                autocomplete="username"
                placeholder="Masukkan alamat email"
                oninvalid="this.setCustomValidity('Masukkan alamat email yang valid.')"
                oninput="this.setCustomValidity('')"
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />

        </div>


        {{-- Password --}}
        <div>

            <x-input-label
                for="password"
                :value="'Password'"
            />

            <div class="relative mt-1">

                <x-text-input
                    id="password"
                    class="block w-full pe-12"
                    type="password"
                    name="password"
                    required
                    data-label="Password"
                    autocomplete="current-password"
                    placeholder="Masukkan password"
                />

                {{-- Toggle Password --}}
                <button
                    type="button"
                    id="toggle-password"
                    class="
                        absolute
                        inset-y-0
                        right-0
                        flex
                        items-center
                        justify-center
                        px-3
                        text-gray-400
                        transition
                        hover:text-gray-600
                        focus:outline-none
                    "
                    aria-label="Tampilkan password"
                    title="Tampilkan password"
                >

                    {{-- Icon Mata --}}
                    <svg
                        id="eye-open"
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12 18 18.75 12 18.75 2.25 12 2.25 12Z"
                        />

                        <circle
                            cx="12"
                            cy="12"
                            r="2.75"
                            stroke-width="1.8"
                        />
                    </svg>


                    {{-- Icon Mata Tertutup --}}
                    <svg
                        id="eye-closed"
                        class="hidden h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M3 3l18 18"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M10.6 6.3A10.6 10.6 0 0 1 12 6.2c6 0 9.75 5.8 9.75 5.8a18.1 18.1 0 0 1-3.4 4.1M6.6 6.6C3.8 8.4 2.25 12 2.25 12s3.75 5.8 9.75 5.8a9.8 9.8 0 0 0 3.2-.55"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M9.9 9.9a3 3 0 0 0 4.2 4.2"
                        />
                    </svg>

                </button>

            </div>

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />

        </div>


        {{-- Ingat Saya dan Lupa Password --}}
        <div
            class="
                flex
                items-center
                justify-between
                gap-4
            "
        >

            <label
                for="remember_me"
                class="
                    inline-flex
                    cursor-pointer
                    items-center
                    gap-2
                    text-sm
                    text-gray-600
                "
            >

                <input
                    id="remember_me"
                    type="checkbox"
                    name="remember"
                    class="
                        rounded
                        border-gray-300
                        text-blue-600
                        shadow-sm
                        focus:ring-blue-500
                    "
                >

                <span>
                    Ingat saya
                </span>

            </label>


            @if (Route::has('password.request'))

                <a
                    href="{{ route('password.request') }}"
                    class="
                        text-sm
                        font-medium
                        text-blue-900
                        transition
                        hover:text-blue-800
                        hover:underline
                        focus:outline-none
                    "
                >
                    Lupa password?
                </a>

            @endif

        </div>


        {{-- Tombol Masuk --}}
        <button
            type="submit"
            class="
                inline-flex
                w-full
                items-center
                justify-center
                rounded-lg
                bg-blue-900
                px-4
                py-2.5
                text-sm
                font-semibold
                text-white
                shadow-sm
                transition
                hover:bg-blue-800
                focus:outline-none
                focus:ring-2
                focus:ring-blue-500
                focus:ring-offset-2
            "
        >
            Masuk
        </button>


        {{-- Register --}}
        @if (Route::has('register'))

            <div
                class="
                    pt-1
                    text-center
                    text-sm
                    text-gray-500
                "
            >

                Belum memiliki akun?

                <a
                    href="{{ route('register') }}"
                    class="
                        font-semibold
                        text-blue-900
                        transition
                        hover:text-blue-800
                        hover:underline
                    "
                >
                    Daftar
                </a>

            </div>

        @endif

    </form>


    {{-- Script Toggle Password --}}
    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const passwordInput =
                    document.getElementById('password');

                const toggleButton =
                    document.getElementById('toggle-password');

                const eyeOpen =
                    document.getElementById('eye-open');

                const eyeClosed =
                    document.getElementById('eye-closed');


                if (
                    ! passwordInput ||
                    ! toggleButton
                ) {
                    return;
                }


                toggleButton.addEventListener(
                    'click',
                    function () {

                        const isPassword =
                            passwordInput.type === 'password';


                        passwordInput.type =
                            isPassword
                                ? 'text'
                                : 'password';


                        eyeOpen.classList.toggle(
                            'hidden',
                            isPassword
                        );


                        eyeClosed.classList.toggle(
                            'hidden',
                            ! isPassword
                        );


                        toggleButton.setAttribute(
                            'aria-label',
                            isPassword
                                ? 'Sembunyikan password'
                                : 'Tampilkan password'
                        );


                        toggleButton.setAttribute(
                            'title',
                            isPassword
                                ? 'Sembunyikan password'
                                : 'Tampilkan password'
                        );

                    }
                );

            }
        );

    </script>

</x-guest-layout>