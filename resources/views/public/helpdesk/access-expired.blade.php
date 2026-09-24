@extends('layouts.public')

@section('content')

<div class="min-h-screen bg-gray-50">

    <div class="mx-auto flex max-w-2xl items-center px-4 py-10 sm:px-6 lg:px-8">

        <div class="w-full rounded-xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8">

            {{-- Header --}}
            <div class="text-center">

                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-blue-50 text-blue-700">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15.75 5.25a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.118a7.5 7.5 0 0 1 15 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.5-1.632Z"
                        />
                    </svg>
                </div>

                <h1 class="mt-4 text-xl font-bold text-gray-900 sm:text-2xl">
                    Akses Tiket Telah Berakhir
                </h1>

                <p class="mx-auto mt-2 max-w-lg text-sm leading-6 text-gray-600">
                    Sesi akses tiket Anda telah berakhir.
                    Masukkan nomor tiket dan alamat email yang digunakan
                    saat membuat tiket untuk mendapatkan tautan akses baru.
                </p>

            </div>

            {{-- Success message --}}
            @if (session('success'))
                <div class="mt-6 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="mt-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">

                    <p class="font-medium">
                        Periksa kembali data yang Anda masukkan.
                    </p>

                    <ul class="mt-2 list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>
            @endif

            {{-- Recovery form --}}
            <form
                method="POST"
                action="{{ route('helpdesk.ticket.resend-access') }}"
                class="mt-6 space-y-5"
            >

                @csrf

                {{-- Ticket number --}}
                <div>

                    <label
                        for="ticket_number"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Nomor Tiket
                    </label>

                    <input
                        type="text"
                        id="ticket_number"
                        name="ticket_number"
                        value="{{ old('ticket_number') }}"
                        maxlength="30"
                        required
                        autocomplete="off"
                        class="mt-1.5 block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm uppercase text-gray-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        placeholder="Contoh: HD-2026-0001"
                    >

                </div>

                {{-- Email --}}
                <div>

                    <label
                        for="email"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Alamat Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        maxlength="255"
                        required
                        autocomplete="email"
                        class="mt-1.5 block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        placeholder="Masukkan email yang digunakan saat membuat tiket"
                    >

                </div>

                {{-- Submit --}}
                <div class="pt-1">

                    <button
                        type="submit"
                        class="w-full rounded-lg bg-blue-700 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    >
                        Kirim Tautan Akses
                    </button>

                </div>

            </form>

            {{-- Back --}}
            <div class="mt-6 border-t border-gray-100 pt-6 text-center">

                <a
                    href="{{ route('helpdesk.index') }}"
                    class="text-sm font-medium text-blue-700 hover:underline"
                >
                    ← Kembali ke Helpdesk
                </a>

            </div>

        </div>

    </div>

</div>

@endsection