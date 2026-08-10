<x-guest-layout>

    <div class="mb-6 text-center">

        <h1 class="text-2xl font-semibold text-gray-900">
            Verifikasi Email
        </h1>

        <p class="mt-2 text-sm text-gray-600">
            Silakan verifikasi alamat email Anda sebelum melanjutkan.
        </p>

    </div>

    @if (session('status') === 'verification-link-sent')

        <div class="mb-5 rounded-md bg-green-50 p-4 text-sm text-green-700">
            Link verifikasi baru telah dikirim ke alamat email Anda.
        </div>

    @endif

    <div class="rounded-lg bg-white p-6 shadow">

        <p class="text-sm leading-6 text-gray-600">
            Kami telah mengirimkan link verifikasi ke:
        </p>

        <p class="mt-2 font-medium text-gray-900">
            {{ auth()->user()->email }}
        </p>

        <p class="mt-3 text-sm leading-6 text-gray-600">
            Silakan buka email tersebut dan klik link
            verifikasi untuk mengaktifkan akun Anda.
        </p>

        <div class="mt-6">

            <form
                method="POST"
                action="{{ route('verification.send') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="w-full rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700"
                >
                    Kirim Ulang Email Verifikasi
                </button>

            </form>

        </div>

        <div class="mt-4 text-center">

            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="text-sm font-medium text-gray-600 hover:text-gray-900"
                >
                    Logout
                </button>

            </form>

        </div>

    </div>

</x-guest-layout>