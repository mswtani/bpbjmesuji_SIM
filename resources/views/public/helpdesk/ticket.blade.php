@extends('layouts.public')

@section('content')

<div class="min-h-screen bg-gray-50">

    <div class="mx-auto max-w-4xl px-4 py-10 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-7 border-l-4 border-[#d4af37] pl-3 sm:pl-4">

            
            <h1 class="text-2xl font-bold leading-tight text-[#0b2f64] sm:text-3xl">
                Tiket Helpdesk
            </h1>

            <p class="mt-1 text-sm text-[#54708f] sm:text-base">
                {{ $ticket->ticket_number }}
            </p>

        </div>


        {{-- Ticket information --}}
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

            <div class="grid gap-5 sm:grid-cols-2">

                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                        Kategori
                    </p>

                    <p class="mt-1 font-medium text-gray-900">
                        {{ $ticket->category->name }}
                    </p>
                </div>


                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                        Status
                    </p>

                    <p class="mt-1">
                        @if ($ticket->status === 'baru')

                            <span class="inline-flex rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800">
                                Baru
                            </span>

                        @elseif ($ticket->status === 'diproses')

                            <span class="inline-flex rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800">
                                Diproses
                            </span>

                        @elseif ($ticket->status === 'menunggu_pemohon')

                            <span class="inline-flex rounded-full bg-orange-100 px-2.5 py-0.5 text-xs font-medium text-orange-800">
                                Menunggu Pemohon
                            </span>

                        @elseif ($ticket->status === 'selesai')

                            <span class="inline-flex rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">
                                Selesai
                            </span>

                        @elseif ($ticket->status === 'ditutup')

                            <span class="inline-flex rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800">
                                Ditutup
                            </span>

                        @else

                            <span class="inline-flex rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800">
                                {{ $ticket->status }}
                            </span>

                        @endif
                    </p>
                </div>

                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                        Peran Pemohon
                    </p>

                    <p class="mt-1 font-medium text-gray-900">
                        @if ($ticket->position)
                            @if ($ticket->position->code === 'PENYEDIA')
                                Penyedia
                            @elseif ($ticket->position->code === 'NON_PENYEDIA')
                                Non Penyedia Lainnya
                            @else
                                {{ $ticket->position->name }}
                            @endif
                        @else
                            -
                        @endif
                    </p>
                </div>


                <div class="sm:col-span-2">
                    
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                        Subjek
                    </p>

                    <p class="mt-1 text-lg font-semibold text-gray-900">
                        {{ $ticket->subject }}
                    </p>

                </div>

            </div>

        </div>


        {{-- Conversation --}}
        <div class="mt-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

            <div class="border-b border-gray-200 px-4 py-3 sm:px-6">
                <h2 class="font-semibold text-gray-900">
                    Percakapan
                </h2>
            </div>

            <div class="space-y-5 p-4 sm:p-6">

                @forelse ($ticket->messages as $message)

                    @php
                        $isRequester = $message->sender_type === 'requester';
                    @endphp

                    {{-- Bubble --}}
                    <div class="flex {{ $isRequester ? 'justify-start' : 'justify-end' }}">

                        <div
                            class="w-fit max-w-[92%] overflow-hidden rounded-2xl px-4 py-3 sm:max-w-2xl
                                {{ $isRequester
                                    ? 'bg-gray-100 text-gray-900'
                                    : 'bg-blue-600 text-white' }}"
                        >

                            {{-- Header Pengirim --}}
                            <div class="flex items-center gap-3">

                                <span class="min-w-0 flex-1 text-xs font-semibold leading-4 sm:text-sm">
                                    {{ $isRequester ? $ticket->requester_name : 'Petugas Helpdesk' }}
                                </span>

                                <span class="mt-2 text-right text-[10px] leading-none opacity-60">
                                    {{ $message->created_at->format('d/m/Y H:i') }}
                                </span>

                            </div>


                            {{-- Isi Pesan --}}
                            @if (filled($message->message))

                                <div class="mt-3 whitespace-pre-line text-sm leading-5">
                                    {{ $message->message }}
                                </div>

                            @endif


                            {{-- Attachment --}}
                            @if ($message->attachments->isNotEmpty())

                                <div class="mt-3 space-y-2">

                                    @foreach ($message->attachments as $attachment)

                                        @php
                                            $mime = strtolower($attachment->mime_type);

                                            $isImage = in_array($mime, [
                                                'image/jpeg',
                                                'image/png',
                                            ]);

                                            $viewUrl = route(
                                                'helpdesk.ticket.attachment.view',
                                                [
                                                    'ticketNumber' => $ticket->ticket_number,
                                                    'attachment' => $attachment->id,
                                                ]
                                            );
                                        @endphp


                                        @if ($isImage)

                                            <button
                                                type="button"
                                                class="public-image-preview group flex w-full items-center gap-3 rounded-lg border p-2 text-left
                                                    {{ $isRequester
                                                        ? 'border-gray-200 bg-white hover:bg-gray-50'
                                                        : 'border-white/20 bg-white/10 hover:bg-white/15' }}"
                                                data-image-url="{{ $viewUrl }}"
                                                data-image-name="{{ $attachment->original_name }}"
                                            >

                                                <span class="h-12 w-12 shrink-0 overflow-hidden rounded-md bg-gray-200">

                                                    <img
                                                        src="{{ $viewUrl }}"
                                                        alt="{{ $attachment->original_name }}"
                                                        class="h-full w-full object-cover"
                                                        loading="lazy"
                                                    >

                                                </span>


                                                <span class="min-w-0 flex-1">

                                                    <span class="block truncate text-sm font-medium">
                                                        {{ $attachment->original_name }}
                                                    </span>

                                                    <span class="mt-0.5 block text-xs opacity-60">
                                                        {{ number_format($attachment->file_size / 1024, 1) }} KB
                                                    </span>

                                                </span>


                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4 w-4 shrink-0 opacity-50 transition group-hover:opacity-100"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M13 5h6m0 0v6m0-6L10 14"
                                                    />
                                                </svg>

                                            </button>

                                        @else

                                            {{-- File selain gambar --}}
                                            <a
                                                href="{{ $viewUrl }}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="flex items-center gap-3 rounded-lg border px-3 py-2 text-sm
                                                    {{ $isRequester
                                                        ? 'border-gray-200 bg-white hover:bg-gray-50'
                                                        : 'border-white/20 bg-white/10 hover:bg-white/15' }}"
                                            >

                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 shrink-0 opacity-80"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M7 18.5A2.5 2.5 0 019.5 16H19M7 18.5A2.5 2.5 0 014.5 16V6.5A2.5 2.5 0 017 4h7.5L19 8.5v7.5M14 4v5h5"
                                                    />
                                                </svg>


                                                <span class="min-w-0 flex-1 truncate">
                                                    {{ $attachment->original_name }}
                                                </span>

                                            </a>

                                        @endif

                                    @endforeach

                                </div>

                            @endif

                        </div>

                    </div>

                @empty

                    <p class="py-4 text-center text-sm text-gray-500">
                        Belum ada pesan.
                    </p>

                @endforelse

            </div>

        </div>

        @if (
                in_array($ticket->category->slug, ['aduan', 'konsultasi-pengadaan'], true)
                && in_array($ticket->status, ['baru', 'menunggu_pemohon'], true)
            )

            <div class="mt-6 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

                <h2 class="font-semibold text-gray-900">
                    Kirim Pesan
                </h2>

                @if ($ticket->status === 'menunggu_pemohon')
                    <div class="mt-4 rounded-lg border border-orange-200 bg-orange-50 p-4 text-sm text-orange-800">
                        <p class="font-semibold">
                            Tanggapan Anda diperlukan
                        </p>

                        <p class="mt-1">
                            Petugas Helpdesk sedang menunggu informasi atau tanggapan
                            dari Anda. Silakan kirimkan tanggapan melalui formulir berikut.
                        </p>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mt-4 rounded-lg bg-green-50 p-4 text-sm text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                <form
                    method="POST"
                    action="{{ route('helpdesk.ticket.messages.store', ['ticketNumber' => $ticket->ticket_number]) }}"
                    enctype="multipart/form-data"
                    class="mt-4"
                >
                    @csrf

                    <textarea
                        id="message"
                        name="message"
                        rows="4"
                        maxlength="5000"
                        required
                        autocomplete="off"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-3 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Tulis pesan Anda..."
                    >{!! old('message', '') !!}</textarea>

                    <div class="mt-3">
                        <label
                            for="attachments"
                            class="mb-1.5 block text-sm font-medium text-gray-700"
                        >
                            Lampiran
                        </label>

                        <input
                            id="attachments"
                            name="attachments[]"
                            type="file"
                            multiple
                            accept=".pdf,.jpg,.jpeg,.png,.zip"
                            class="block w-full cursor-pointer rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-700
                                file:mr-3 file:border-0 file:bg-gray-100 file:px-3 file:py-2
                                file:text-sm file:font-medium
                                hover:file:bg-gray-200
                                focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                        >

                        <div
                            id="attachmentPreview"
                            class="mt-3 hidden space-y-2"
                        ></div>

                        <p class="mt-1.5 text-xs text-gray-500">
                            Maksimal 5 file. Setiap file maksimal 10 MB.
                            Format: PDF, JPG, JPEG, PNG, ZIP.
                        </p>
                    </div>

                    @error('message')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                    @error('attachments')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                    @error('attachments.*')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                    <div class="mt-5 border-t border-gray-200 pt-4">
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
                                class="inline-flex w-full items-center justify-center rounded-lg bg-[#0b2f64] px-5 py-2.5 text-sm font-semibold text-white transition gap-2 hover:bg-[#092650] focus:outline-none focus:ring-2 focus:ring-[#0b2f64]/30 sm:w-auto"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M22 2L11 13"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M22 2l-7 20-4-9-9-4 20-7z"
                                    />
                                </svg>
                                Kirim Pesan
                            </button>

                        </div>
                    </div>

                </form>

            </div>

        @elseif ($ticket->status === 'diproses')

            <div class="mt-6 rounded-xl border border-blue-200 bg-blue-50 p-6 shadow-sm">

                <h2 class="font-semibold text-blue-900">
                    Tiket Sedang Diproses
                </h2>

                <p class="mt-2 text-sm leading-6 text-blue-800">
                    Petugas Helpdesk sedang menangani permohonan Anda.
                    Silakan menunggu tanggapan berikutnya.
                </p>

            </div>

        @elseif ($ticket->status === 'selesai')

            <div class="mt-6 rounded-xl border border-green-200 bg-green-50 p-6 shadow-sm">

                <h2 class="font-semibold text-green-900">
                    Tiket Telah Selesai
                </h2>

                <p class="mt-2 text-sm leading-6 text-green-800">
                    Permohonan Anda telah ditandai selesai oleh petugas Helpdesk.
                    Pesan baru tidak dapat dikirim pada tiket ini.
                </p>

            </div>

        @elseif ($ticket->status === 'ditutup')

            <div class="mt-6 rounded-xl border border-gray-200 bg-gray-50 p-6 shadow-sm">

                <h2 class="font-semibold text-gray-900">
                    Tiket Telah Ditutup
                </h2>

                <p class="mt-2 text-sm leading-6 text-gray-600">
                    Tiket ini telah ditutup dan tidak dapat menerima pesan baru.
                </p>

            </div>

        @endif

    </div>

</div>

{{-- Public image preview modal --}}
<div
    id="publicImagePreviewModal"
    class="fixed inset-0 z-[100] hidden bg-black/70 backdrop-blur-[1px]"
    aria-hidden="true"
>
    {{-- Close --}}
    <button
        type="button"
        id="publicImagePreviewClose"
        class="absolute right-3 top-3 z-30 flex h-9 w-9 items-center justify-center rounded-full bg-black/40 text-white transition hover:bg-black/60 sm:right-5 sm:top-5"
        aria-label="Tutup preview"
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

    {{-- Menu --}}
    <div class="absolute right-14 top-3 z-30 sm:right-17 sm:top-5">
        <button
            type="button"
            id="publicImagePreviewMenuButton"
            class="flex h-9 w-9 items-center justify-center rounded-full bg-black/40 text-white transition hover:bg-black/60"
            aria-label="Menu lampiran"
            aria-expanded="false"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 5.75h.01M12 12h.01M12 18.25h.01"
                />
            </svg>
        </button>

        {{-- Dropdown --}}
        <div
            id="publicImagePreviewMenu"
            class="absolute right-0 mt-2 hidden w-36 overflow-hidden rounded-lg border border-gray-200 bg-white py-1 shadow-xl"
        >
            <a
                id="publicImagePreviewDownload"
                href="#"
                download
                class="flex items-center gap-2 px-3 py-2 text-sm text-gray-700 transition hover:bg-gray-100"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 3v12m0 0l4-4m-4 4l-4-4M5 21h14"
                    />
                </svg>

                <span>Download</span>
            </a>
        </div>
    </div>

    {{-- Previous --}}
    <button
        type="button"
        id="publicImagePreviewPrev"
        class="absolute left-3 top-1/2 z-20 flex h-9 w-9 -translate-y-1/2 items-center justify-center rounded-full bg-black/40 text-white transition hover:bg-black/60 sm:left-5"
        aria-label="Gambar sebelumnya"
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
                d="M15 19l-7-7 7-7"
            />
        </svg>
    </button>

    {{-- Next --}}
    <button
        type="button"
        id="publicImagePreviewNext"
        class="absolute right-3 top-1/2 z-20 flex h-9 w-9 -translate-y-1/2 items-center justify-center rounded-full bg-black/40 text-white transition hover:bg-black/60 sm:right-5"
        aria-label="Gambar berikutnya"
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
                d="M9 5l7 7-7 7"
            />
        </svg>
    </button>

    {{-- Image area --}}
    <div
        id="publicImagePreviewBackdrop"
        class="flex h-full w-full items-center justify-center px-14 py-14 sm:px-20 sm:py-16"
    >
        <img
            id="publicImagePreviewImage"
            src=""
            alt=""
            class="max-h-[82vh] max-w-[88vw] rounded-lg object-contain shadow-2xl"
        >
    </div>

    {{-- Counter --}}
    <div
        id="publicImagePreviewCounter"
        class="absolute bottom-4 left-1/2 z-20 -translate-x-1/2 rounded-full bg-black/60 px-3 py-1 text-xs text-white"
    >
        1 / 1
    </div>
</div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('publicImagePreviewModal');
        const image = document.getElementById('publicImagePreviewImage');
        const closeButton = document.getElementById('publicImagePreviewClose');

        const prevButton = document.getElementById('publicImagePreviewPrev');
        const nextButton = document.getElementById('publicImagePreviewNext');

        const counter = document.getElementById('publicImagePreviewCounter');

        const menuButton = document.getElementById(
            'publicImagePreviewMenuButton'
        );

        const menu = document.getElementById(
            'publicImagePreviewMenu'
        );

        const downloadButton = document.getElementById(
            'publicImagePreviewDownload'
        );

        const backdrop = document.getElementById(
            'publicImagePreviewBackdrop'
        );

        if (
            !modal ||
            !image ||
            !closeButton ||
            !prevButton ||
            !nextButton ||
            !counter ||
            !menuButton ||
            !menu ||
            !downloadButton ||
            !backdrop
        ) {
            return;
        }

        let imageAttachments = [];
        let currentIndex = 0;

        const collectImages = () => {
            imageAttachments = Array.from(
                document.querySelectorAll('.public-image-preview')
            ).map(button => ({
                url: button.dataset.imageUrl,
                name: button.dataset.imageName || 'attachment',
            }));
        };

        const updateImage = () => {
            if (!imageAttachments.length) {
                return;
            }

            const current = imageAttachments[currentIndex];

            image.src = current.url;
            image.alt = current.name;

            downloadButton.href = current.url;
            downloadButton.setAttribute(
                'download',
                current.name
            );

            counter.textContent =
                `${currentIndex + 1} / ${imageAttachments.length}`;

            /*
            * Prev / Next hanya tampil jika gambar lebih dari satu.
            */
            const multipleImages =
                imageAttachments.length > 1;

            prevButton.classList.toggle(
                'hidden',
                !multipleImages
            );

            nextButton.classList.toggle(
                'hidden',
                !multipleImages
            );
        };

        const openModal = (index) => {
            collectImages();

            if (!imageAttachments.length) {
                return;
            }

            currentIndex = index;

            updateImage();

            modal.classList.remove('hidden');
            modal.setAttribute('aria-hidden', 'false');

            document.body.classList.add('overflow-hidden');

            menu.classList.add('hidden');
            menuButton.setAttribute('aria-expanded', 'false');
        };

        const closeModal = () => {
            modal.classList.add('hidden');
            modal.setAttribute('aria-hidden', 'true');

            image.src = '';

            menu.classList.add('hidden');
            menuButton.setAttribute('aria-expanded', 'false');

            document.body.classList.remove('overflow-hidden');
        };

        /*
        * Klik thumbnail gambar.
        */
        document.querySelectorAll('.public-image-preview').forEach(
            (button, index) => {
                button.addEventListener('click', () => {
                    openModal(index);
                });
            }
        );

        /*
        * Previous
        */
        prevButton.addEventListener('click', event => {
            event.stopPropagation();

            if (imageAttachments.length <= 1) {
                return;
            }

            currentIndex =
                (currentIndex - 1 + imageAttachments.length)
                % imageAttachments.length;

            updateImage();
        });

        /*
        * Next
        */
        nextButton.addEventListener('click', event => {
            event.stopPropagation();

            if (imageAttachments.length <= 1) {
                return;
            }

            currentIndex =
                (currentIndex + 1)
                % imageAttachments.length;

            updateImage();
        });

        /*
        * Close
        */
        closeButton.addEventListener('click', event => {
            event.stopPropagation();
            closeModal();
        });

        /*
        * Klik background menutup modal.
        */
        backdrop.addEventListener('click', event => {
            if (event.target === backdrop) {
                closeModal();
            }
        });

        /*
        * Menu titik tiga.
        */
        menuButton.addEventListener('click', event => {
            event.stopPropagation();

            const isHidden = menu.classList.contains('hidden');

            menu.classList.toggle('hidden');

            menuButton.setAttribute(
                'aria-expanded',
                isHidden ? 'true' : 'false'
            );
        });

        /*
        * Klik di luar menu.
        */
        document.addEventListener('click', event => {
            if (
                !menu.contains(event.target) &&
                !menuButton.contains(event.target)
            ) {
                menu.classList.add('hidden');

                menuButton.setAttribute(
                    'aria-expanded',
                    'false'
                );
            }
        });

        /*
        * Keyboard.
        */
        document.addEventListener('keydown', event => {
            if (modal.classList.contains('hidden')) {
                return;
            }

            if (event.key === 'Escape') {
                closeModal();
                return;
            }

            if (imageAttachments.length <= 1) {
                return;
            }

            if (event.key === 'ArrowLeft') {
                currentIndex =
                    (currentIndex - 1 + imageAttachments.length)
                    % imageAttachments.length;

                updateImage();
            }

            if (event.key === 'ArrowRight') {
                currentIndex =
                    (currentIndex + 1)
                    % imageAttachments.length;

                updateImage();
            }
        });
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('attachments');
    const preview = document.getElementById('attachmentPreview');

    if (!input || !preview) {
        return;
    }

    const maxFiles = 5;
    const maxSize = 10 * 1024 * 1024;

    const allowedTypes = [
        'image/jpeg',
        'image/png',
        'image/webp',
        'application/pdf',
        'application/zip',
    ];

    let selectedFiles = [];

    const formatSize = (bytes) => {
        if (bytes < 1024) {
            return `${bytes} B`;
        }

        if (bytes < 1024 * 1024) {
            return `${(bytes / 1024).toFixed(1)} KB`;
        }

        return `${(bytes / (1024 * 1024)).toFixed(1)} MB`;
    };

    const syncInputFiles = () => {
        const dataTransfer = new DataTransfer();

        selectedFiles.forEach(file => {
            dataTransfer.items.add(file);
        });

        input.files = dataTransfer.files;
    };

    const renderPreview = () => {
        preview.innerHTML = '';

        if (selectedFiles.length === 0) {
            preview.classList.add('hidden');
            return;
        }

        preview.classList.remove('hidden');

        selectedFiles.forEach((file, index) => {
            const row = document.createElement('div');

            row.className =
                'flex items-center gap-3 rounded-lg border border-gray-200 bg-gray-50 p-2.5';

            /*
             * Thumbnail gambar
             */
            if (file.type.startsWith('image/')) {
                const image = document.createElement('img');

                image.className =
                    'h-12 w-12 shrink-0 rounded-md object-cover';

                image.alt = file.name;

                image.src = URL.createObjectURL(file);

                row.appendChild(image);
            } else {
                /*
                 * Icon file
                 */
                const icon = document.createElement('div');

                icon.className =
                    'flex h-12 w-12 shrink-0 items-center justify-center rounded-md bg-gray-200 text-gray-600';

                icon.innerHTML = `
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
                            d="M7 18.5A2.5 2.5 0 019.5 16H19M7 18.5A2.5 2.5 0 014.5 16V6.5A2.5 2.5 0 017 4h7.5L19 8.5v7.5M14 4v5h5"
                        />
                    </svg>
                `;

                row.appendChild(icon);
            }

            /*
             * Informasi file
             */
            const info = document.createElement('div');

            info.className = 'min-w-0 flex-1';

            const fileName = document.createElement('p');

            fileName.className =
                'truncate text-sm font-medium text-gray-800';

            fileName.textContent = file.name;

            const fileSize = document.createElement('p');

            fileSize.className = 'text-xs text-gray-500';

            fileSize.textContent = formatSize(file.size);

            info.appendChild(fileName);
            info.appendChild(fileSize);

            row.appendChild(info);

            /*
             * Tombol X
             */
            const removeButton = document.createElement('button');

            removeButton.type = 'button';

            removeButton.className =
                'flex h-8 w-8 shrink-0 items-center justify-center rounded-full text-gray-400 transition hover:bg-red-50 hover:text-red-600';

            removeButton.setAttribute(
                'aria-label',
                `Hapus ${file.name}`
            );

            removeButton.innerHTML = `
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            `;

            removeButton.addEventListener('click', () => {
                selectedFiles.splice(index, 1);

                syncInputFiles();
                renderPreview();
            });

            row.appendChild(removeButton);

            preview.appendChild(row);
        });
    };

    input.addEventListener('change', () => {
        const files = Array.from(input.files);

        if (!files.length) {
            return;
        }

        /*
         * Validasi jumlah file
         */
        if (files.length > maxFiles) {
            alert(`Maksimal ${maxFiles} file.`);

            input.value = '';
            selectedFiles = [];
            renderPreview();

            return;
        }

        /*
         * Validasi setiap file
         */
        const invalidFile = files.find(file => {
            return !allowedTypes.includes(file.type)
                || file.size > maxSize;
        });

        if (invalidFile) {
            alert(
                `File "${invalidFile.name}" tidak dapat digunakan.\n\n` +
                `Format yang diperbolehkan: JPG, JPEG, PNG, WEBP, PDF, ZIP.\n` +
                `Maksimal ukuran: 10 MB per file.`
            );

            input.value = '';
            selectedFiles = [];
            renderPreview();

            return;
        }

        selectedFiles = files;

        renderPreview();
    });
});
</script>