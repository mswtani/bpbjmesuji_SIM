@extends('layouts.public')

@section('content')

<div class="min-h-screen bg-gray-50">

    <div class="mx-auto max-w-3xl px-4 py-12 sm:px-6 lg:px-8">

        <div class="rounded-xl border border-green-200 bg-white p-8 shadow-sm">

            {{-- Success icon --}}
            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-green-100">

                <svg
                    class="h-6 w-6 text-green-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 13l4 4L19 7"
                    />
                </svg>

            </div>


            <h1 class="mt-5 text-2xl font-bold text-gray-900">
                Pengajuan berhasil dikirim
            </h1>


            <p class="mt-2 text-gray-600">
                Pengajuan
                <strong>{{ $category->name }}</strong>
                Anda telah berhasil dibuat.
            </p>


            {{-- Nomor tiket --}}
            <div class="mt-6 rounded-lg border border-indigo-200 bg-indigo-50 p-5">

                <p class="text-sm font-medium text-indigo-700">
                    Nomor Tiket
                </p>

                <p class="mt-1 text-2xl font-bold tracking-wide text-indigo-900">
                    {{ $ticket->ticket_number }}
                </p>

                <p class="mt-2 text-sm text-indigo-700">
                    Simpan nomor tiket ini untuk memudahkan komunikasi
                    dengan petugas Helpdesk.
                </p>

            </div>


            {{-- Data --}}
            <div class="mt-6 rounded-lg bg-gray-50 p-5">

                <dl class="space-y-3 text-sm">

                    <div class="flex flex-col gap-1 sm:flex-row">

                        <dt class="font-medium text-gray-500 sm:w-32">
                            Nama
                        </dt>

                        <dd class="text-gray-900">
                            {{ $ticket->requester_name }}
                        </dd>

                    </div>


                    <div class="flex flex-col gap-1 sm:flex-row">

                        <dt class="font-medium text-gray-500 sm:w-32">
                            Email
                        </dt>

                        <dd class="text-gray-900">
                            {{ $ticket->requester_email }}
                        </dd>

                    </div>


                    <div class="flex flex-col gap-1 sm:flex-row">

                        <dt class="font-medium text-gray-500 sm:w-32">
                            Subjek
                        </dt>

                        <dd class="text-gray-900">
                            {{ $ticket->subject }}
                        </dd>

                    </div>


                    <div class="flex flex-col gap-1 sm:flex-row">

                        <dt class="font-medium text-gray-500 sm:w-32">
                            Status
                        </dt>

                        <dd>

                            <span class="inline-flex rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800">
                                Menunggu Penanganan
                            </span>

                        </dd>

                    </div>

                </dl>

            </div>


            {{-- Guest access --}}
            @guest

                <div class="mt-6 rounded-lg border border-yellow-200 bg-yellow-50 p-5">

                    <h2 class="font-semibold text-yellow-900">
                        Simpan akses tiket Anda
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-yellow-800">
                        Karena Anda mengirim pengajuan tanpa login,
                        simpan akses tiket ini. Nanti Anda dapat menggunakan
                        akses tersebut untuk melihat balasan dari petugas.
                    </p>

                </div>

            @endguest


            {{-- Action --}}
            <div class="mt-6 flex flex-col gap-3 sm:flex-row">

                <a
                    href="{{ $ticketUrl }}"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800"
                >
                    Lihat Tiket Saya
                </a>

                <a
                    href="{{ route('helpdesk.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50"
                >
                    Kembali ke Helpdesk
                </a>

            </div>

        </div>

    </div>

</div>

@endsection