@extends('layouts.admin')

@section('title', 'Detail Tiket Helpdesk')

@section('content')

@if (session('success'))

    <div class="mb-6 rounded-lg bg-green-50 p-4 text-sm text-green-700">
        {{ session('success') }}
    </div>

@endif

<x-admin.page
    title="Detail Tiket Helpdesk"
    description="Detail tiket dan percakapan dengan masyarakat."
>

    <div class="space-y-6">

        {{-- Informasi Tiket --}}
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Nomor Tiket
                    </p>

                    <h2 class="mt-1 text-xl font-bold text-gray-900">
                        {{ $ticket->ticket_number }}
                    </h2>

                </div>


                <div>

                    @if ($ticket->status === 'baru')

                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">
                            Baru
                        </span>

                    @elseif ($ticket->status === 'diproses')

                        <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-medium text-yellow-700">
                            Diproses
                        </span>

                    @elseif ($ticket->status === 'menunggu_pemohon')

                        <span class="rounded-full bg-orange-100 px-3 py-1 text-xs font-medium text-orange-700">
                            Menunggu Pemohon
                        </span>

                    @elseif ($ticket->status === 'selesai')

                        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700">
                            Selesai
                        </span>

                    @elseif ($ticket->status === 'ditutup')

                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700">
                            Ditutup
                        </span>

                    @else

                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700">
                            {{ $ticket->status }}
                        </span>

                    @endif

                </div>

            </div>


            <dl class="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">

                <div>
                    <dt class="text-sm text-gray-500">
                        Pemohon
                    </dt>

                    <dd class="mt-1 font-medium text-gray-900">
                        {{ $ticket->requester_name }}
                    </dd>
                </div>


                <div>
                    <dt class="text-sm text-gray-500">
                        Email
                    </dt>

                    <dd class="mt-1 font-medium text-gray-900">
                        {{ $ticket->requester_email }}
                    </dd>
                </div>


                <div>
                    <dt class="text-sm text-gray-500">
                        Kategori
                    </dt>

                    <dd class="mt-1 font-medium text-gray-900">
                        {{ $ticket->category?->name ?? '-' }}
                    </dd>
                </div>


                <div>
                    <dt class="text-sm text-gray-500">
                        Prioritas
                    </dt>

                    <dd class="mt-1 font-medium text-gray-900">
                        {{ ucfirst($ticket->priority) }}
                    </dd>
                </div>

            </dl>

            @if (auth()->user()?->hasPermission('helpdesk.manage'))

                <div class="mt-6 rounded-lg border border-gray-200 bg-gray-50 p-4">

                    <h3 class="text-sm font-semibold text-gray-900">
                        Kelola Tiket
                    </h3>

                    <form
                        method="POST"
                        action="{{ route(
                            'helpdesk.admin.ticket.update',
                            $ticket->ticket_number
                        ) }}"
                        class="mt-4"
                    >

                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                            {{-- Status --}}
                            <div>
                                <label
                                    for="ticket-status"
                                    class="mb-1.5 block text-sm font-medium text-gray-700"
                                >
                                    Status
                                </label>

                                <select
                                    id="ticket-status"
                                    name="status"
                                    class="block w-full rounded-md border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                                >

                                    <option
                                        value="baru"
                                        @selected($ticket->status === 'baru')
                                    >
                                        Baru
                                    </option>

                                    <option
                                        value="diproses"
                                        @selected($ticket->status === 'diproses')
                                    >
                                        Diproses
                                    </option>

                                    <option
                                        value="menunggu_pemohon"
                                        @selected($ticket->status === 'menunggu_pemohon')
                                    >
                                        Menunggu Pemohon
                                    </option>

                                    <option
                                        value="selesai"
                                        @selected($ticket->status === 'selesai')
                                    >
                                        Selesai
                                    </option>

                                    <option
                                        value="ditutup"
                                        @selected($ticket->status === 'ditutup')
                                    >
                                        Ditutup
                                    </option>

                                </select>
                            </div>


                            {{-- Prioritas --}}
                            <div>
                                <label
                                    for="ticket-priority"
                                    class="mb-1.5 block text-sm font-medium text-gray-700"
                                >
                                    Prioritas
                                </label>

                                <select
                                    id="ticket-priority"
                                    name="priority"
                                    class="block w-full rounded-md border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                                >

                                    <option
                                        value="normal"
                                        @selected($ticket->priority === 'normal')
                                    >
                                        Normal
                                    </option>

                                    <option
                                        value="tinggi"
                                        @selected($ticket->priority === 'tinggi')
                                    >
                                        Tinggi
                                    </option>

                                    <option
                                        value="mendesak"
                                        @selected($ticket->priority === 'mendesak')
                                    >
                                        Mendesak
                                    </option>

                                </select>
                            </div>

                        </div>


                        <div class="mt-4 flex justify-end">

                            <button
                                type="submit"
                                class="rounded-md bg-blue-700 px-4 py-2.5 text-sm font-medium text-white hover:bg-blue-800"
                            >
                                Simpan Perubahan
                            </button>

                        </div>

                    </form>

                </div>

            @endif


            <div class="mt-5">

                <dt class="text-sm text-gray-500">
                    Subjek
                </dt>

                <dd class="mt-1 font-medium text-gray-900">
                    {{ $ticket->subject }}
                </dd>

            </div>

        </div>


        {{-- Percakapan --}}
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

            <h2 class="text-lg font-semibold text-gray-900">
                Percakapan
            </h2>


            <div class="mt-6 space-y-5">

                @forelse ($ticket->messages as $message)

                    <div
                        class="flex {{ $message->sender_type === 'requester' ? 'justify-start' : 'justify-end' }}"
                    >

                        <div
                            class="max-w-3xl rounded-xl px-5 py-4
                            {{ $message->sender_type === 'requester'
                                ? 'bg-gray-100 text-gray-900'
                                : 'bg-blue-700 text-white'
                            }}"
                        >

                            <div class="flex items-center gap-2">

                                <span class="min-w-0 flex-1 text-sm font-semibold">
                                    @if ($message->sender_type === 'requester')
                                        {{ $ticket->requester_name }}
                                    @else
                                        {{ $message->user?->name ?? 'Petugas Helpdesk' }}
                                    @endif
                                </span>

                                <span class="shrink-0 text-xs opacity-70">
                                    {{ $message->created_at->format('d/m/Y H:i') }}
                                </span>

                               @if (
                                        $message->sender_type === 'staff' &&
                                        auth()->user()->hasPermission('helpdesk.manage')
                                    )

                                    <div class="relative shrink-0">

                                        <button
                                            type="button"
                                            class="message-menu-button flex h-6 w-6 items-center justify-center rounded-md text-lg leading-none opacity-70 transition hover:bg-black/10 hover:opacity-100"
                                            aria-label="Menu pesan"
                                            aria-expanded="false"
                                        >
                                            ⋮
                                        </button>

                                        <div
                                            class="message-menu absolute right-0 top-7 z-30 hidden w-28 overflow-hidden rounded-lg bg-white py-1 text-gray-700 shadow-lg ring-1 ring-black/5"
                                        >

                                            <button
                                                type="button"
                                                class="message-edit-button block w-full px-3 py-2 text-left text-sm hover:bg-gray-100"
                                                data-message-id="{{ $message->id }}"
                                            >
                                                Edit
                                            </button>

                                            <form
                                                method="POST"
                                                action="{{ route(
                                                    'helpdesk.admin.message.delete',
                                                    [
                                                        'ticketNumber' => $ticket->ticket_number,
                                                        'message' => $message->id,
                                                    ]
                                                ) }}"
                                                class="message-delete-form">
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="button"
                                                    data-message-delete
                                                    class="block w-full px-3 py-2 text-left text-sm text-red-600 hover:bg-red-50"
                                                >
                                                    Hapus
                                                </button>
                                            </form>

                                        </div>

                                    </div>

                                @endif

                            </div>


                            <div
                                data-message-display="{{ $message->id }}"
                                class="whitespace-pre-line text-sm"
                            >
                                {{ $message->message }}
                            </div>

                           @if (
                                    $message->sender_type === 'staff' &&
                                    auth()->user()->hasPermission('helpdesk.manage')
                                )


                                <form
                                    method="POST"
                                    action="{{ route(
                                        'helpdesk.admin.message.update',
                                        [
                                            'ticketNumber' => $ticket->ticket_number,
                                            'message' => $message->id,
                                        ]
                                    ) }}"
                                    data-message-edit-form="{{ $message->id }}"
                                    class="hidden"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <textarea
                                        name="message"
                                        rows="4"
                                        maxlength="5000"
                                        required
                                        class="block w-full rounded-lg border border-white/30 bg-white/10 p-3 text-sm text-white placeholder-white/60 focus:border-white focus:ring-white"
                                    >{{ $message->message }}</textarea>

                                    <div class="mt-2 flex justify-end gap-2">

                                        <button
                                            type="button"
                                            data-message-edit-cancel="{{ $message->id }}"
                                            class="rounded-lg border border-white/30 px-3 py-1.5 text-xs font-medium text-white hover:bg-white/10"
                                        >
                                            Batal
                                        </button>

                                        <button
                                            type="submit"
                                            class="rounded-lg bg-white px-3 py-1.5 text-xs font-medium text-blue-700 hover:bg-gray-100"
                                        >
                                            Simpan
                                        </button>

                                    </div>
                                </form>
                            @endif


                            @if ($message->attachments->isNotEmpty())
                                <div class="mt-4 space-y-2">
                                    @foreach ($message->attachments as $attachment)
                                        @php
                                            $isImage = in_array(
                                                strtolower($attachment->mime_type),
                                                ['image/jpeg', 'image/png']
                                            );

                                            $isPdf = $attachment->mime_type === 'application/pdf';

                                            $size = $attachment->file_size >= 1048576
                                                ? number_format($attachment->file_size / 1048576, 1) . ' MB'
                                                : number_format($attachment->file_size / 1024, 1) . ' KB';
                                        @endphp

                                        @php
                                            $mime = strtolower($attachment->mime_type);

                                            $isImage = in_array($mime, [
                                                'image/jpeg',
                                                'image/png',
                                            ]);

                                            $isPdf = $mime === 'application/pdf';

                                            $isZip = $mime === 'application/zip';

                                            $size = $attachment->file_size >= 1048576
                                                ? number_format($attachment->file_size / 1048576, 1) . ' MB'
                                                : number_format($attachment->file_size / 1024, 1) . ' KB';

                                            $viewUrl = route(
                                                'helpdesk.admin.attachment.view',
                                                [
                                                    'ticketNumber' => $ticket->ticket_number,
                                                    'attachment' => $attachment->id,
                                                ]
                                            );

                                            $downloadUrl = route(
                                                'helpdesk.admin.attachment.download',
                                                [
                                                    'ticketNumber' => $ticket->ticket_number,
                                                    'attachment' => $attachment->id,
                                                ]
                                            );
                                        @endphp

                                        <a
                                            href="{{ $isZip ? $downloadUrl : $viewUrl }}"
                                            @if (!$isZip)
                                                data-attachment-preview
                                                data-attachment-type="{{ $isImage ? 'image' : 'pdf' }}"
                                                data-url="{{ $viewUrl }}"
                                                data-download-url="{{ $downloadUrl }}"
                                                data-name="{{ $attachment->original_name }}"
                                            @endif
                                            class="group flex max-w-md items-center gap-3 rounded-lg border border-white/20 bg-black/10 px-3 py-3 transition hover:bg-black/20"
                                        >
                                            @if ($isImage)
                                                <div class="h-12 w-12 shrink-0 overflow-hidden rounded-md bg-black/10">
                                                    <img
                                                        src="{{ route(
                                                            'helpdesk.admin.attachment.view',
                                                            [
                                                                'ticketNumber' => $ticket->ticket_number,
                                                                'attachment' => $attachment->id,
                                                            ]
                                                        ) }}"
                                                        alt="{{ $attachment->original_name }}"
                                                        class="h-full w-full object-cover"
                                                    >
                                                </div>
                                            @elseif ($isPdf)
                                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-md bg-red-100 text-red-600">
                                                    <span class="text-xs font-bold">PDF</span>
                                                </div>
                                            @else
                                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-md bg-gray-100 text-gray-600">
                                                    <span class="text-xs font-bold">ZIP</span>
                                                </div>
                                            @endif

                                            <div class="min-w-0 flex-1">
                                                <p class="truncate text-sm font-medium">
                                                    {{ $attachment->original_name }}
                                                </p>

                                                <p class="mt-0.5 text-xs opacity-70">
                                                    {{ $size }}
                                                </p>
                                            </div>

                                            <span class="shrink-0 text-xs opacity-50 transition group-hover:opacity-100">
                                                ↗
                                            </span>
                                        </a>
                                    @endforeach
                                </div>
                            @endif

                        </div>

                    </div>

                @empty

                    <p class="py-8 text-center text-gray-500">
                        Belum ada pesan.
                    </p>

                @endforelse

            </div>

        </div>


        {{-- Balasan Petugas --}}
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

            <h2 class="text-lg font-semibold text-gray-900">
                Balas Tiket
            </h2>

            <form
                method="POST"
                action="{{ route('helpdesk.admin.reply', $ticket->ticket_number) }}"
                enctype="multipart/form-data"
                class="mt-5 space-y-4"
            >

                @csrf

                <div>

                    <label
                        for="message"
                        class="mb-2 block text-sm font-medium text-gray-900"
                    >
                        Pesan
                    </label>

                    <textarea
                        id="message"
                        name="message"
                        rows="6"
                        maxlength="5000"
                        required
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-3 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Tulis balasan kepada pemohon..."
                    >{{ old('message') }}</textarea>

                    @error('message')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>
                
                <div>
                    <label
                        for="attachments"
                        class="mb-2 block text-sm font-medium text-gray-900"
                    >
                        Lampiran
                    </label>

                    <input
                        id="attachments"
                        name="attachments[]"
                        type="file"
                        multiple
                        accept=".pdf,.jpg,.jpeg,.png,.zip"
                        class="block w-full cursor-pointer rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 focus:outline-none"
                    >

                    <p class="mt-1 text-xs text-gray-500">
                        Maksimal 5 file. Setiap file maksimal 10 MB.
                        Format: PDF, JPG, JPEG, PNG, ZIP.
                    </p>

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
                </div>

                <div class="flex justify-end">

                    <button
                        type="submit"
                        class="rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800"
                    >
                        Kirim Balasan
                    </button>

                </div>

            </form>

        </div>


        {{-- Kembali --}}
        <div>

            <a
                href="{{ route('helpdesk.admin.index') }}"
                class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50"
            >
                ← Kembali ke Inbox
            </a>

        </div>

    </div>

</x-admin.page>


{{-- Konfirmasi Hapus Pesan --}}
<div
    id="delete-message-modal"
    class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/50 p-4"
    aria-hidden="true" >
    <div
        id="delete-message-modal-container"
        class="w-full max-w-sm rounded-xl bg-white p-5 shadow-2xl"
    >

        <div class="flex items-start justify-between gap-4">

            <div>
                <h3 class="text-base font-semibold text-gray-900">
                    Hapus pesan?
                </h3>

                <p class="mt-1 text-sm text-gray-500">
                    Pesan ini akan dihapus dari percakapan.
                </p>
            </div>

            <button
                type="button"
                id="delete-message-modal-close"
                class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700"
                aria-label="Tutup"
            >
                ×
            </button>

        </div>


        <div class="mt-5 flex justify-end gap-2">

            <button
                type="button"
                id="delete-message-cancel"
                class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
            >
                Batal
            </button>

            <button
                type="button"
                id="delete-message-confirm"
                class="rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700"
            >
                Hapus
            </button>

        </div>

    </div>
</div>



{{-- Attachment Preview Modal --}}
<div
    id="attachmentPreviewModal"
    class="fixed inset-0 z-50 hidden bg-black/70 p-4"
    aria-hidden="true"
>
    <div
        id="attachmentPreviewContainer"
        class="relative flex h-full w-full items-center justify-center"
    >

        {{-- Tombol kanan atas --}}
        <div class="absolute right-3 top-3 z-20 flex items-center gap-2">

            {{-- Menu --}}
            <div class="relative">
                <button
                    id="attachmentMenuButton"
                    type="button"
                    class="flex h-9 w-9 items-center justify-center rounded-full bg-black/50 text-xl text-white hover:bg-black/70"
                    aria-label="Menu attachment"
                >
                    ⋮
                </button>

                <div
                    id="attachmentMenu"
                    class="absolute right-0 top-11 hidden min-w-32 overflow-hidden rounded-lg bg-white py-1 shadow-lg"
                >
                    <a
                        id="attachmentDownloadButton"
                        href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    >
                        Download
                    </a>
                </div>
            </div>

            {{-- Close --}}
            <button
                id="attachmentCloseButton"
                type="button"
                class="flex h-9 w-9 items-center justify-center rounded-full bg-black/50 text-xl text-white hover:bg-black/70"
                aria-label="Tutup"
            >
                ×
            </button>

        </div>


        {{-- Navigasi gambar kiri --}}
        <button
            id="attachmentPreviousButton"
            type="button"
            class="absolute left-3 top-1/2 z-20 hidden -translate-y-1/2 rounded-full bg-black/50 px-4 py-3 text-2xl text-white hover:bg-black/70"
            aria-label="Gambar sebelumnya"
        >
            ‹
        </button>


        {{-- Content --}}
        <div
            id="attachmentPreviewContent"
            class="relative flex max-h-[90vh] max-w-[90vw] items-center justify-center overflow-hidden rounded-xl"
        >
        </div>


        {{-- Navigasi gambar kanan --}}
        <button
            id="attachmentNextButton"
            type="button"
            class="absolute right-3 top-1/2 z-20 hidden -translate-y-1/2 rounded-full bg-black/50 px-4 py-3 text-2xl text-white hover:bg-black/70"
            aria-label="Gambar berikutnya"
        >
            ›
        </button>


        {{-- Indicator gambar --}}
        <div
            id="attachmentImageCounter"
            class="absolute bottom-4 left-1/2 z-20 hidden -translate-x-1/2 rounded-full bg-black/60 px-3 py-1 text-xs text-white"
        ></div>

    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', () => {

        const modal = document.getElementById('attachmentPreviewModal');
        const container = document.getElementById('attachmentPreviewContainer');
        const content = document.getElementById('attachmentPreviewContent');

        const closeButton = document.getElementById('attachmentCloseButton');
        const menuButton = document.getElementById('attachmentMenuButton');
        const menu = document.getElementById('attachmentMenu');
        const downloadButton = document.getElementById('attachmentDownloadButton');

        const previousButton = document.getElementById('attachmentPreviousButton');
        const nextButton = document.getElementById('attachmentNextButton');
        const counter = document.getElementById('attachmentImageCounter');


        let imageAttachments = [];
        let currentImageIndex = 0;


        function openModal() {
            modal.classList.remove('hidden');
            modal.setAttribute('aria-hidden', 'false');

            document.body.classList.add('overflow-hidden');
        }


        function closeModal() {
            modal.classList.add('hidden');
            modal.setAttribute('aria-hidden', 'true');

            content.innerHTML = '';
            menu.classList.add('hidden');

            document.body.classList.remove('overflow-hidden');

            imageAttachments = [];
            currentImageIndex = 0;
        }


        function showImage(index) {

            if (!imageAttachments.length) {
                return;
            }

            currentImageIndex =
                (index + imageAttachments.length)
                % imageAttachments.length;

            const attachment =
                imageAttachments[currentImageIndex];

            content.innerHTML = `
                <img
                    src="${attachment.url}"
                    alt="${escapeHtml(attachment.name)}"
                    class="max-h-[85vh] max-w-[85vw] rounded-lg object-contain shadow-2xl"
                >
            `;

            downloadButton.href = attachment.downloadUrl;
            downloadButton.setAttribute(
                'download',
                attachment.name
            );

            counter.textContent =
                `${currentImageIndex + 1} / ${imageAttachments.length}`;

            counter.classList.remove('hidden');

            previousButton.classList.toggle(
                'hidden',
                imageAttachments.length <= 1
            );

            nextButton.classList.toggle(
                'hidden',
                imageAttachments.length <= 1
            );

            openModal();
        }


        function showPdf(attachment) {

            content.innerHTML = `
                <iframe
                    src="${attachment.url}"
                    class="h-[85vh] w-[85vw] rounded-lg bg-white shadow-2xl"
                    title="${escapeHtml(attachment.name)}"
                ></iframe>
            `;

            downloadButton.href =
                attachment.downloadUrl;

            downloadButton.setAttribute(
                'download',
                attachment.name
            );

            counter.classList.add('hidden');
            previousButton.classList.add('hidden');
            nextButton.classList.add('hidden');

            openModal();
        }


        function escapeHtml(value) {

            return String(value)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }


        function getImageAttachments() {

            return Array.from(
                document.querySelectorAll(
                    '[data-attachment-type="image"]'
                )
            ).map(element => ({
                url: element.dataset.url,
                downloadUrl: element.dataset.downloadUrl,
                name: element.dataset.name
            }));

        }


        document
            .querySelectorAll('[data-attachment-preview]')
            .forEach(element => {

                element.addEventListener('click', event => {

                    event.preventDefault();

                    const type =
                        element.dataset.attachmentType;

                    const attachment = {
                        url: element.dataset.url,
                        downloadUrl: element.dataset.downloadUrl,
                        name: element.dataset.name
                    };


                    /*
                    |--------------------------------------------------------------------------
                    | ZIP
                    |--------------------------------------------------------------------------
                    */

                    if (type === 'zip') {

                        window.location.href =
                            attachment.downloadUrl;

                        return;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | PDF
                    |--------------------------------------------------------------------------
                    */

                    if (type === 'pdf') {

                        showPdf(attachment);

                        return;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | IMAGE
                    |--------------------------------------------------------------------------
                    */

                    if (type === 'image') {

                        imageAttachments =
                            getImageAttachments();

                        currentImageIndex =
                            imageAttachments.findIndex(
                                image =>
                                    image.url === attachment.url
                            );

                        showImage(
                            currentImageIndex >= 0
                                ? currentImageIndex
                                : 0
                        );
                    }

                });

            });


        closeButton.addEventListener(
            'click',
            closeModal
        );


        /*
        |--------------------------------------------------------------------------
        | Klik backdrop
        |--------------------------------------------------------------------------
        */

        modal.addEventListener('click', event => {

            if (
                event.target === modal ||
                event.target === container
            ) {
                closeModal();
            }

        });


        document.addEventListener(
            'keydown',
            event => {

                if (modal.classList.contains('hidden')) {
                    return;
                }

                /*
                |--------------------------------------------------------------------------
                | ESC → tutup modal
                |--------------------------------------------------------------------------
                */

                if (event.key === 'Escape') {

                    closeModal();

                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | Arrow Left → gambar sebelumnya
                |--------------------------------------------------------------------------
                */

                if (
                    event.key === 'ArrowLeft' &&
                    imageAttachments.length > 1
                ) {

                    event.preventDefault();

                    showImage(
                        currentImageIndex - 1
                    );

                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | Arrow Right → gambar berikutnya
                |--------------------------------------------------------------------------
                */

                if (
                    event.key === 'ArrowRight' &&
                    imageAttachments.length > 1
                ) {

                    event.preventDefault();

                    showImage(
                        currentImageIndex + 1
                    );

                    return;
                }

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Menu ⋮
        |--------------------------------------------------------------------------
        */

        menuButton.addEventListener(
            'click',
            event => {

                event.stopPropagation();

                menu.classList.toggle('hidden');

            }
        );


        document.addEventListener(
            'click',
            event => {

                if (
                    !menu.contains(event.target) &&
                    event.target !== menuButton
                ) {
                    menu.classList.add('hidden');
                }

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Navigasi gambar
        |--------------------------------------------------------------------------
        */

        previousButton.addEventListener(
            'click',
            event => {

                event.stopPropagation();

                showImage(
                    currentImageIndex - 1
                );

            }
        );


        nextButton.addEventListener(
            'click',
            event => {

                event.stopPropagation();

                showImage(
                    currentImageIndex + 1
                );

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Swipe gambar
        |--------------------------------------------------------------------------
        */

        let touchStartX = null;

        content.addEventListener(
            'touchstart',
            event => {

                if (event.touches.length !== 1) {
                    return;
                }

                touchStartX =
                    event.touches[0].clientX;

            },
            { passive: true }
        );


        content.addEventListener(
            'touchend',
            event => {

                if (touchStartX === null) {
                    return;
                }

                const touchEndX =
                    event.changedTouches[0].clientX;

                const difference =
                    touchEndX - touchStartX;

                touchStartX = null;

                if (Math.abs(difference) < 50) {
                    return;
                }

                if (difference < 0) {

                    showImage(
                        currentImageIndex + 1
                    );

                } else {

                    showImage(
                        currentImageIndex - 1
                    );

                }

            },
            { passive: true }
        );

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        /*
        |--------------------------------------------------------------------------
        | Menu pesan ⋮
        |--------------------------------------------------------------------------
        */

        const messageMenuButtons =
            document.querySelectorAll('.message-menu-button');

        const messageMenus =
            document.querySelectorAll('.message-menu');


        /*
        |--------------------------------------------------------------------------
        | Klik tombol ⋮
        |--------------------------------------------------------------------------
        */

        messageMenuButtons.forEach(button => {

            button.addEventListener('click', event => {

                event.preventDefault();
                event.stopPropagation();

                const menu =
                    button.parentElement.querySelector('.message-menu');

                if (!menu) {
                    return;
                }

                /*
                | Tutup menu pesan lain
                */

                messageMenus.forEach(otherMenu => {

                    if (otherMenu !== menu) {
                        otherMenu.classList.add('hidden');
                    }

                });


                /*
                | Toggle menu yang diklik
                */

                menu.classList.toggle('hidden');

                button.setAttribute(
                    'aria-expanded',
                    menu.classList.contains('hidden')
                        ? 'false'
                        : 'true'
                );

            });

        });


        /*
        |--------------------------------------------------------------------------
        | Klik di luar menu → tutup
        |--------------------------------------------------------------------------
        */

        document.addEventListener('click', event => {

            messageMenus.forEach(menu => {

                const wrapper =
                    menu.parentElement;

                if (
                    !wrapper.contains(event.target)
                ) {

                    menu.classList.add('hidden');

                    const button =
                        wrapper.querySelector(
                            '.message-menu-button'
                        );

                    if (button) {

                        button.setAttribute(
                            'aria-expanded',
                            'false'
                        );

                    }

                }

            });

        });


        /*
        |--------------------------------------------------------------------------
        | ESC → tutup semua menu pesan
        |--------------------------------------------------------------------------
        */

        document.addEventListener('keydown', event => {

            if (event.key !== 'Escape') {
                return;
            }

            messageMenus.forEach(menu => {
                menu.classList.add('hidden');
            });

            messageMenuButtons.forEach(button => {
                button.setAttribute(
                    'aria-expanded',
                    'false'
                );
            });

        });

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        /*
        |--------------------------------------------------------------------------
        | Edit pesan
        |--------------------------------------------------------------------------
        */

        document
            .querySelectorAll('.message-edit-button')
            .forEach(button => {

                button.addEventListener('click', event => {

                    event.preventDefault();
                    event.stopPropagation();

                    const messageId =
                        button.dataset.messageId;

                    const display =
                        document.querySelector(
                            `[data-message-display="${messageId}"]`
                        );

                    const form =
                        document.querySelector(
                            `[data-message-edit-form="${messageId}"]`
                        );

                    const menu =
                        button.closest('.message-menu');

                    if (!display || !form) {
                        return;
                    }

                    /*
                    | Tutup menu
                    */

                    if (menu) {
                        menu.classList.add('hidden');
                    }


                    /*
                    | Sembunyikan pesan asli
                    */

                    display.classList.add('hidden');


                    /*
                    | Tampilkan form edit
                    */

                    form.classList.remove('hidden');


                    /*
                    | Fokus textarea
                    */

                    const textarea =
                        form.querySelector('textarea');

                    if (textarea) {

                        textarea.focus();

                        /*
                        | Posisikan cursor di akhir teks
                        */

                        textarea.setSelectionRange(
                            textarea.value.length,
                            textarea.value.length
                        );

                    }

                });

            });


        /*
        |--------------------------------------------------------------------------
        | Batal edit
        |--------------------------------------------------------------------------
        */

        document
            .querySelectorAll('[data-message-edit-cancel]')
            .forEach(button => {

                button.addEventListener('click', event => {

                    event.preventDefault();

                    const messageId =
                        button.dataset.messageEditCancel;

                    const display =
                        document.querySelector(
                            `[data-message-display="${messageId}"]`
                        );

                    const form =
                        document.querySelector(
                            `[data-message-edit-form="${messageId}"]`
                        );

                    if (!display || !form) {
                        return;
                    }

                    form.classList.add('hidden');

                    display.classList.remove('hidden');

                });

            });

    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', () => {

        /*
        |--------------------------------------------------------------------------
        | Konfirmasi Hapus Pesan
        |--------------------------------------------------------------------------
        */

        const deleteModal =
            document.getElementById('delete-message-modal');

        const deleteModalContainer =
            document.getElementById(
                'delete-message-modal-container'
            );

        const deleteModalClose =
            document.getElementById(
                'delete-message-modal-close'
            );

        const deleteCancel =
            document.getElementById(
                'delete-message-cancel'
            );

        const deleteConfirm =
            document.getElementById(
                'delete-message-confirm'
            );

        let deleteForm = null;


        /*
        |--------------------------------------------------------------------------
        | Buka modal
        |--------------------------------------------------------------------------
        */

        document
            .querySelectorAll('[data-message-delete]')
            .forEach(button => {

                button.addEventListener('click', event => {

                    event.preventDefault();
                    event.stopPropagation();

                    deleteForm =
                        button.closest(
                            '.message-delete-form'
                        );

                    if (!deleteForm) {
                        return;
                    }

                    deleteModal.classList.remove('hidden');
                    deleteModal.classList.add('flex');

                    deleteModal.setAttribute(
                        'aria-hidden',
                        'false'
                    );

                    document.body.classList.add(
                        'overflow-hidden'
                    );

                });

            });


        /*
        |--------------------------------------------------------------------------
        | Tutup modal
        |--------------------------------------------------------------------------
        */

        const closeDeleteModal = () => {

            deleteModal.classList.add('hidden');
            deleteModal.classList.remove('flex');

            deleteModal.setAttribute(
                'aria-hidden',
                'true'
            );

            document.body.classList.remove(
                'overflow-hidden'
            );

            deleteForm = null;

        };


        deleteModalClose.addEventListener(
            'click',
            closeDeleteModal
        );


        deleteCancel.addEventListener(
            'click',
            closeDeleteModal
        );


        /*
        |--------------------------------------------------------------------------
        | Klik di luar container
        |--------------------------------------------------------------------------
        */

        deleteModal.addEventListener(
            'click',
            event => {

                if (
                    event.target === deleteModal
                ) {
                    closeDeleteModal();
                }

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Konfirmasi Hapus
        |--------------------------------------------------------------------------
        */

        deleteConfirm.addEventListener(
            'click',
            () => {

                if (!deleteForm) {
                    return;
                }

                deleteConfirm.disabled = true;

                deleteConfirm.textContent =
                    'Menghapus...';

                deleteForm.submit();

            }
        );


        /*
        |--------------------------------------------------------------------------
        | ESC
        |--------------------------------------------------------------------------
        */

        document.addEventListener(
            'keydown',
            event => {

                if (
                    event.key === 'Escape' &&
                    !deleteModal.classList.contains('hidden')
                ) {
                    closeDeleteModal();
                }

            }
        );

    });
</script>

@endsection