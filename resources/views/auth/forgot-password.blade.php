<x-guest-layout>

    {{-- Judul --}}
    <div class="mb-6 text-center">

        <h2 class="text-xl font-semibold text-gray-900">
            Lupa Password?
        </h2>

        <p class="mt-2 text-sm leading-6 text-gray-600">
            Masukkan alamat email akun Anda. Kami akan mengirimkan
            tautan untuk membuat password baru.
        </p>

    </div>


    {{-- Notifikasi Status --}}
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
            role="alert"
        >

            @if (session('status') === 'passwords.sent')

                Link untuk mengatur ulang password telah dikirim ke
                alamat email Anda. Silakan periksa kotak masuk email.

            @else

                {{ session('status') }}

            @endif

        </div>

    @endif


    {{-- Form --}}
    <form
        method="POST"
        action="{{ route('password.email') }}"
    >

        @csrf


        {{-- Email --}}
        <div>

            <x-input-label
                for="email"
                :value="__('Alamat Email')"
            />

            <x-text-input
                id="email"
                class="mt-1 block w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
                placeholder="Masukkan alamat email"
                oninvalid="this.setCustomValidity('Masukan alamat email yang valid.')"
                oninput="this.setCustomValidity('')"
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />

        </div>


        {{-- Button --}}
        <div class="mt-6">

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
                    focus:ring-indigo-500
                    focus:ring-offset-2
                "
            >

                Kirim Link Reset Password

            </button>

        </div>


        {{-- Kembali Login --}}
        <div class="mt-5 text-center">

            <a
                href="{{ route('login') }}"
                class="
                    text-sm
                    font-medium
                    text-blue-900
                    transition
                    hover:text-blue-900
                    hover:underline
                "
            >
                ← Kembali ke halaman masuk
            </a>

        </div>

    </form>

</x-guest-layout>