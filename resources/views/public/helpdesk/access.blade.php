@extends('layouts.public')

@section('title', 'Akses Tiket Helpdesk')

@section('content')
<section class="py-10 sm:py-14">
    <div class="mx-auto w-[90%] max-w-3xl">

        {{-- Header --}}
        <div class="mb-7 border-l-4 border-[#d4af37] pl-3 sm:pl-4">
            <h1 class="text-2xl font-bold leading-tight text-[#0b2f64] sm:text-3xl">
                Akses Tiket Helpdesk
            </h1>

            <p class="mt-1 text-sm text-[#54708f] sm:text-base">
                Buka kembali riwayat percakapan dan tanggapan petugas
            </p>
        </div>

        {{-- Card --}}
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm sm:p-7">

            <div class="mb-6 flex items-start gap-4 rounded-lg border border-blue-100 bg-blue-50 p-4">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-600 text-white">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 7a3 3 0 11-6 0 3 3 0 016 0z"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5.5 20a6.5 6.5 0 0113 0"
                        />
                    </svg>
                </div>

                <div>
                    <p class="text-sm font-semibold text-[#0b2f64]">
                        Akses tiket melalui email
                    </p>

                    <p class="mt-1 text-sm leading-6 text-gray-600">
                        Masukkan nomor tiket dan email yang digunakan saat
                        mengajukan Helpdesk. Kami akan mengirimkan tautan
                        akses baru ke email tersebut.
                    </p>
                </div>
            </div>

            <form
                id="ticketAccessForm"
                method="POST"
                action="{{ route('helpdesk.ticket.resend-access') }}"
                class="space-y-5"
            >
                @csrf

                {{-- Nomor tiket --}}
                <div>
                    <label
                        for="ticket_number"
                        class="mb-1.5 block text-sm font-medium text-gray-700"
                    >
                        Nomor Tiket
                    </label>

                    <input
                        id="ticket_number"
                        name="ticket_number"
                        type="text"
                        value="{{ old('ticket_number') }}"
                        required
                        autocomplete="off"
                        placeholder="Contoh: HD-20260913-XXXX"
                        class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 uppercase placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500"
                    >

                    @error('ticket_number')
                        <p class="mt-1.5 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label
                        for="email"
                        class="mb-1.5 block text-sm font-medium text-gray-700"
                    >
                        Email
                    </label>

                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        placeholder="Email yang digunakan saat mengajukan tiket"
                        class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500"
                    >

                    @error('email')
                        <p class="mt-1.5 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Success --}}
                @if (session('mail_success'))
                    <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Actions --}}
                <div class="border-t border-gray-200 pt-5">
                    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-between">

                        <a
                            href="{{ route('helpdesk.index') }}"
                            class="inline-flex w-full items-center justify-center rounded-lg border border-red-200 bg-red-50 px-4 py-2.5 text-sm font-medium text-red-600 transition hover:border-red-300 hover:bg-red-100 sm:w-auto"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="mr-2 h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"
                                />
                            </svg>

                            Kembali ke Helpdesk
                        </a>

                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center rounded-lg bg-[#0b2f64] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#092650] focus:outline-none focus:ring-2 focus:ring-[#0b2f64]/30 sm:w-auto"
                        >
                            Kirim Link Akses
                        </button>

                    </div>
                </div>
            </form>

        </div>

        {{-- Informasi tambahan --}}
        <p class="mt-4 text-center text-xs leading-5 text-gray-500">
            Tautan akses akan dikirim ke email yang terdaftar pada tiket.
            Demi keamanan, jangan bagikan tautan akses kepada orang lain.
        </p>

    </div>
</section>

{{-- Confirmation modal --}}
<div
    id="ticketAccessConfirmModal"
    class="fixed inset-0 z-[100] hidden"
    aria-hidden="true"
>
    {{-- Overlay --}}
    <div
        id="ticketAccessConfirmOverlay"
        class="absolute inset-0 bg-black/50"
    ></div>

    {{-- Modal --}}
    <div class="relative flex min-h-full items-center justify-center p-4">
        <div
            class="relative w-full max-w-md rounded-xl bg-white p-6 shadow-2xl"
            role="dialog"
            aria-modal="true"
            aria-labelledby="ticketAccessConfirmTitle"
        >
            {{-- Icon --}}
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-blue-50 text-blue-600">
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
                        d="M12 9v3.5m0 3h.01M10.3 4.5h3.4L20 10.8v3.4a5.3 5.3 0 01-5.3 5.3H9.3A5.3 5.3 0 014 14.2v-3.4l6.3-6.3z"
                    />
                </svg>
            </div>

            {{-- Content --}}
            <div class="mt-4 text-center">
                <h2
                    id="ticketAccessConfirmTitle"
                    class="text-lg font-semibold text-[#0b2f64]"
                >
                    Kirim Link Akses?
                </h2>

                <p class="mt-2 text-sm leading-6 text-gray-600">
                    Kami akan mengirimkan tautan akses tiket ke alamat
                    email yang Anda masukkan.
                </p>

                <p class="mt-2 text-xs leading-5 text-gray-500">
                    Pastikan nomor tiket dan alamat email sudah benar.
                </p>
            </div>

            {{-- Actions --}}
            <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-center">
                <button
                    type="button"
                    id="ticketAccessConfirmCancel"
                    class="inline-flex w-full items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50 sm:w-auto"
                >
                    Batal
                </button>

                <button
                    type="button"
                    id="ticketAccessConfirmSubmit"
                    class="inline-flex w-full items-center justify-center rounded-lg bg-[#0b2f64] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#092650] focus:outline-none focus:ring-2 focus:ring-[#0b2f64]/30 sm:w-auto"
                >
                    Kirim Link Akses
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Success modal --}}
<div
    id="ticketAccessSuccessModal"
    class="fixed inset-0 z-[110] hidden"
    aria-hidden="true"
    >
    {{-- Overlay --}}
    <div
        id="ticketAccessSuccessOverlay"
        class="absolute inset-0 bg-black/50"
    ></div>

    {{-- Modal --}}
    <div class="relative flex min-h-full items-center justify-center p-4">

        <div
            class="relative w-full max-w-md rounded-xl bg-white p-6 shadow-2xl sm:p-7"
            role="dialog"
            aria-modal="true"
            aria-labelledby="ticketAccessSuccessTitle"
        >
            {{-- Close --}}
            <button
                type="button"
                id="ticketAccessSuccessClose"
                class="absolute right-3 top-3 flex h-8 w-8 items-center justify-center rounded-full text-gray-400 transition hover:bg-gray-100 hover:text-gray-600"
                aria-label="Tutup"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>

            {{-- Success icon --}}
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-50 text-green-600">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 12.5l4.5 4.5L19 7.5"
                    />
                </svg>
            </div>

            {{-- Content --}}
            <div class="mt-4 text-center">
                <h2
                    id="ticketAccessSuccessTitle"
                    class="text-lg font-semibold text-[#0b2f64]"
                >
                    Link Akses Terkirim
                </h2>

                <p class="mt-2 text-sm leading-6 text-gray-600">
                    Link akses tiket telah berhasil dikirim ke email Anda.
                </p>

                <p class="mt-2 text-xs leading-5 text-gray-500">
                    Silakan periksa kotak masuk email Anda dan gunakan
                    link tersebut untuk membuka kembali tiket.
                </p>
            </div>

            {{-- OK --}}
            <div class="mt-6 flex justify-center">
                <button
                    type="button"
                    id="ticketAccessSuccessOk"
                    class="inline-flex w-full items-center justify-center rounded-lg bg-[#0b2f64] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#092650] focus:outline-none focus:ring-2 focus:ring-[#0b2f64]/30 sm:w-auto sm:min-w-28"
                >
                    Oke
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('ticketAccessForm');
    const modal = document.getElementById('ticketAccessConfirmModal');
    const overlay = document.getElementById('ticketAccessConfirmOverlay');

    const cancelButton = document.getElementById(
        'ticketAccessConfirmCancel'
    );

    const submitButton = document.getElementById(
        'ticketAccessConfirmSubmit'
    );

    if (
        !form ||
        !modal ||
        !overlay ||
        !cancelButton ||
        !submitButton
    ) {
        return;
    }

    let confirmed = false;

    const openModal = () => {
        modal.classList.remove('hidden');
        modal.setAttribute('aria-hidden', 'false');

        document.body.classList.add('overflow-hidden');

        cancelButton.focus();
    };

    const closeModal = () => {
        modal.classList.add('hidden');
        modal.setAttribute('aria-hidden', 'true');

        document.body.classList.remove('overflow-hidden');
    };

    /*
     * Saat tombol utama ditekan,
     * jangan langsung submit.
     */
    form.addEventListener('submit', event => {
        if (confirmed) {
            return;
        }

        event.preventDefault();

        openModal();
    });

    /*
     * Batal.
     */
    cancelButton.addEventListener('click', closeModal);

    /*
     * Klik overlay.
     */
    overlay.addEventListener('click', closeModal);

    /*
     * Setuju → submit form.
     */
    submitButton.addEventListener('click', () => {
        confirmed = true;

        submitButton.disabled = true;

        submitButton.innerHTML = `
            <svg
                class="mr-2 h-4 w-4 animate-spin"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
            >
                <circle
                    class="opacity-25"
                    cx="12"
                    cy="12"
                    r="10"
                    stroke="currentColor"
                    stroke-width="4"
                ></circle>

                <path
                    class="opacity-75"
                    fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"
                ></path>
            </svg>

            Mengirim...
        `;

        form.submit();
    });

    /*
     * ESC untuk membatalkan modal.
     */
    document.addEventListener('keydown', event => {
        if (
            event.key === 'Escape' &&
            !modal.classList.contains('hidden')
        ) {
            closeModal();
        }
    });
});
</script>


<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('ticketAccessForm');

    const confirmModal = document.getElementById(
        'ticketAccessConfirmModal'
    );

    const confirmOverlay = document.getElementById(
        'ticketAccessConfirmOverlay'
    );

    const confirmCancel = document.getElementById(
        'ticketAccessConfirmCancel'
    );

    const confirmSubmit = document.getElementById(
        'ticketAccessConfirmSubmit'
    );

    const successModal = document.getElementById(
        'ticketAccessSuccessModal'
    );

    const successOverlay = document.getElementById(
        'ticketAccessSuccessOverlay'
    );

    const successClose = document.getElementById(
        'ticketAccessSuccessClose'
    );

    const successOk = document.getElementById(
        'ticketAccessSuccessOk'
    );

    if (
        !form ||
        !confirmModal ||
        !confirmOverlay ||
        !confirmCancel ||
        !confirmSubmit ||
        !successModal ||
        !successOverlay ||
        !successClose ||
        !successOk
    ) {
        return;
    }

    let confirmed = false;

    /*
     * ==========================
     * CONFIRMATION MODAL
     * ==========================
     */

    const openConfirmModal = () => {
        confirmModal.classList.remove('hidden');

        confirmModal.setAttribute(
            'aria-hidden',
            'false'
        );

        document.body.classList.add('overflow-hidden');

        confirmCancel.focus();
    };

    const closeConfirmModal = () => {
        confirmModal.classList.add('hidden');

        confirmModal.setAttribute(
            'aria-hidden',
            'true'
        );

        document.body.classList.remove('overflow-hidden');
    };

    /*
     * Submit pertama → tampilkan konfirmasi.
     */
    form.addEventListener('submit', event => {
        if (confirmed) {
            return;
        }

        event.preventDefault();

        openConfirmModal();
    });

    /*
     * Batal.
     */
    confirmCancel.addEventListener(
        'click',
        closeConfirmModal
    );

    /*
     * Klik overlay.
     */
    confirmOverlay.addEventListener(
        'click',
        closeConfirmModal
    );

    /*
     * Setuju → submit.
     */
    confirmSubmit.addEventListener('click', () => {
        confirmed = true;

        confirmSubmit.disabled = true;

        confirmSubmit.innerHTML = `
            <svg
                class="mr-2 h-4 w-4 animate-spin"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
            >
                <circle
                    class="opacity-25"
                    cx="12"
                    cy="12"
                    r="10"
                    stroke="currentColor"
                    stroke-width="4"
                ></circle>

                <path
                    class="opacity-75"
                    fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"
                ></path>
            </svg>

            Mengirim...
        `;

        form.submit();
    });

    /*
     * ==========================
     * SUCCESS MODAL
     * ==========================
     */

    const openSuccessModal = () => {
        successModal.classList.remove('hidden');

        successModal.setAttribute(
            'aria-hidden',
            'false'
        );

        document.body.classList.add('overflow-hidden');

        successOk.focus();
    };

    const closeSuccessModal = () => {
        successModal.classList.add('hidden');

        successModal.setAttribute(
            'aria-hidden',
            'true'
        );

        document.body.classList.remove('overflow-hidden');
    };

    successOk.addEventListener(
        'click',
        closeSuccessModal
    );

    successClose.addEventListener(
        'click',
        closeSuccessModal
    );

    successOverlay.addEventListener(
        'click',
        closeSuccessModal
    );

    /*
     * ESC
     */
    document.addEventListener('keydown', event => {

        if (
            event.key !== 'Escape'
        ) {
            return;
        }

        if (
            !confirmModal.classList.contains('hidden')
        ) {
            closeConfirmModal();
            return;
        }

        if (
            !successModal.classList.contains('hidden')
        ) {
            closeSuccessModal();
        }
    });

    /*
     * ==========================
     * BUKA SUCCESS MODAL
     * ==========================
     *
     * Laravel mengirim session('success')
     * setelah link berhasil diproses.
     */
    @if (session('mail_success'))
        openSuccessModal();
    @endif
});
</script>

@endsection