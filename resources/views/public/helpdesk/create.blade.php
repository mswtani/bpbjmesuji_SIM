<style>
    /* =========================================================
    PUBLIC HELPDESK CREATE HEADER
    ========================================================= */

    .public-helpdesk-create-header {
        padding: 44px 0 26px;
    }

    .public-helpdesk-create-title {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;

        margin: 0;

        color: #0b2f64;
        font-size: 28px;
        font-weight: 500;
        line-height: 1.3;
    }

    .public-helpdesk-create-title-main {
        padding-left: 10px;
        border-left: 5px solid #d4af37;
        box-sizing: border-box;
    }

    .public-helpdesk-create-badge {
        display: inline-flex;
        align-items: center;

        padding: 6px 14px;

        border-radius: 999px;

        background-color: #174ea6;
        color: #ffffff;

        font-size: 14px;
        font-weight: 600;
        line-height: 1.4;
    }

    @media (max-width: 480px) {

        .public-helpdesk-create-title {
            font-size: 23px;
        }

        .public-helpdesk-create-title-main {
            padding-left: 8px;
        }

    }
</style>

@extends('layouts.public')

@section('content')

<div class="min-h-screen bg-gray-50">

    <div class="mx-auto max-w-4xl px-4 py-10 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <div class="public-helpdesk-create-header">

            <h1 class="public-helpdesk-create-title">

                <span class="public-helpdesk-create-title-main">
                    Helpdesk
                </span>

                <span class="public-helpdesk-create-badge">
                    {{ $category->name }}
                </span>

            </h1>

        </div>


        {{-- Header --}}
        <div class="mb-8">

            @if ($category->description)

                <p class="mt-3 max-w-2xl text-base leading-7 text-gray-600">
                    {{ $category->description }}
                </p>

            @endif

        </div>


        {{-- Form --}}
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8">
            @if ($errors->any())
                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">

                    <div class="flex items-start">

                        <svg
                            class="mr-3 mt-0.5 h-5 w-5 shrink-0 text-red-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>

                        <div>
                            <h2 class="text-sm font-semibold text-red-800">
                                Pengajuan belum dapat dikirim
                            </h2>

                            <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-700">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>

                    </div>

                </div>
            @endif

            <form
                method="POST"
                action="{{ route('helpdesk.store', $category->slug) }}"
                enctype="multipart/form-data"
                class="space-y-6"
            >

                @csrf


                {{-- Nama --}}
                <div>

                    <label
                        for="requester_name"
                        class="mb-2 block text-sm font-medium text-gray-900"
                    >
                        Nama
                    </label>

                    <input
                        type="text"
                        id="requester_name"
                        name="requester_name"
                        value="{{ old('requester_name', auth()->user()?->name) }}"
                        class="block w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm text-gray-900 focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Masukkan nama Anda"
                    >
                    @error('requester_name')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Email --}}
                <div>

                    <label
                        for="requester_email"
                        class="mb-2 block text-sm font-medium text-gray-900"
                    >
                        Email
                    </label>

                    <input
                        type="email"
                        id="requester_email"
                        name="requester_email"
                        value="{{ old('requester_email', auth()->user()?->email) }}"
                        class="block w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm text-gray-900 focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="nama@email.com"
                    >

                    <p class="mt-1 text-xs text-gray-500">
                        Email digunakan untuk menerima pemberitahuan balasan.
                    </p>

                    @error('requester_email')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Nomor HP --}}
                <div>

                    <label
                        for="requester_phone"
                        class="mb-2 block text-sm font-medium text-gray-900"
                    >
                        Nomor HP
                        <span class="font-normal text-gray-500">
                            (opsional)
                        </span>
                    </label>

                    <input
                        type="text"
                        id="requester_phone"
                        name="requester_phone"
                        value="{{ old('requester_phone', auth()->user()?->phone) }}"
                        class="block w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm text-gray-900 focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="08xxxxxxxxxx"
                    >

                    @error('requester_phone')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                @if ($category->slug === 'konsultasi-pengadaan')
                    {{-- Peran Pemohon --}}
                    <div>
                        <label
                            for="position_id"
                            class="mb-2 block text-sm font-medium text-gray-900"
                        >
                            Peran Pemohon
                        </label>

                        <select
                            id="position_id"
                            name="position_id"
                            class="block w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm text-gray-900 focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            <option value="">
                                Pilih peran pemohon
                            </option>

                            @foreach ($positions as $position)
                                <option
                                    value="{{ $position->id }}"
                                    {{ old('position_id') == $position->id ? 'selected' : '' }}
                                >
                                    @if ($position->code === 'PENYEDIA')
                                        Penyedia
                                    @elseif ($position->code === 'NON_PENYEDIA')
                                        Non Penyedia Lainnya
                                    @else
                                        {{ $position->name }}
                                    @endif
                                </option>
                            @endforeach
                        </select>

                        @error('position_id')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                @endif


                {{-- Subjek --}}
                <div>

                    <label
                        for="subject"
                        class="mb-2 block text-sm font-medium text-gray-900"
                    >
                        Subjek
                    </label>

                    <input
                        type="text"
                        id="subject"
                        name="subject"
                        value="{{ old('subject') }}"
                        class="block w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm text-gray-900 focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Ringkasan permasalahan atau kebutuhan Anda"
                    >

                    @error('subject')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Pesan --}}
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
                        rows="7"
                        class="block w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm text-gray-900 focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Jelaskan permasalahan, pertanyaan, atau kebutuhan Anda..."
                        >{{ old('message') }}</textarea>

                    @error('message')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Lampiran --}}
                <div>

                    <label
                        for="attachments"
                        class="mb-2 block text-sm font-medium text-gray-900"
                        >
                        Lampiran
                        <span class="font-normal text-gray-500">
                            (opsional)
                        </span>
                    </label>


                    <input
                        type="file"
                        id="attachments"
                        name="attachments[]"
                        multiple
                        accept=".pdf,.jpg,.jpeg,.png,.zip"
                        class="block w-full cursor-pointer rounded-lg border border-gray-300 bg-white text-sm text-gray-900
                            file:mr-4
                            file:border-0
                            file:bg-gray-100
                            file:px-4
                            file:py-2.5
                            file:text-sm
                            file:font-medium
                            hover:file:bg-gray-200
                            focus:border-indigo-500
                            focus:ring-indigo-500"
                    >


                    {{-- Preview Lampiran --}}
                    <div
                        id="attachmentPreview"
                        class="mt-3 hidden space-y-2"
                    ></div>


                    <p class="mt-1.5 text-xs text-gray-500">
                        Maksimal 5 file. Setiap file maksimal 10 MB.
                        Format: PDF, JPG, JPEG, PNG, ZIP.
                    </p>


                    @error('attachments')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror


                    @error('attachments.*')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Action --}}
                <div class="flex flex-col gap-3 border-t border-gray-200 pt-6 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('helpdesk.index') }}"
                        class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50"
                    >
                        Kembali
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-indigo-700"
                    >
                        Kirim Pengajuan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const input = document.getElementById('attachments');
        const preview = document.getElementById('attachmentPreview');

        if (!input || !preview) {
            return;
        }


        const MAX_FILES = 5;
        const MAX_SIZE = 10 * 1024 * 1024;


        const ALLOWED_TYPES = [
            'image/jpeg',
            'image/png',
            'application/pdf',
            'application/zip',
        ];


        let selectedFiles = [];


        /*
        |--------------------------------------------------------------------------
        | Format ukuran file
        |--------------------------------------------------------------------------
        */

        function formatFileSize(bytes) {

            if (bytes < 1024) {
                return bytes + ' B';
            }

            if (bytes < 1024 * 1024) {
                return (bytes / 1024).toFixed(1) + ' KB';
            }

            return (bytes / (1024 * 1024)).toFixed(1) + ' MB';

        }


        /*
        |--------------------------------------------------------------------------
        | Sinkronkan selectedFiles dengan input.files
        |--------------------------------------------------------------------------
        */

        function syncInputFiles() {

            const dataTransfer = new DataTransfer();


            selectedFiles.forEach(function (file) {

                dataTransfer.items.add(file);

            });


            input.files = dataTransfer.files;

        }


        /*
        |--------------------------------------------------------------------------
        | Render preview
        |--------------------------------------------------------------------------
        */

        function renderPreview() {

            preview.innerHTML = '';


            if (selectedFiles.length === 0) {

                preview.classList.add('hidden');

                return;
            }


            preview.classList.remove('hidden');


            selectedFiles.forEach(function (file, index) {

                const row =
                    document.createElement('div');


                row.className =
                    'flex items-center gap-3 rounded-lg border border-gray-200 bg-gray-50 p-2.5';


                /*
                |--------------------------------------------------------------------------
                | Visual / thumbnail
                |--------------------------------------------------------------------------
                */

                const visual =
                    document.createElement('div');


                visual.className =
                    'flex h-14 w-14 shrink-0 items-center justify-center overflow-hidden rounded-md bg-gray-100';


                if (
                    file.type === 'image/jpeg' ||
                    file.type === 'image/png'
                ) {

                    const image =
                        document.createElement('img');


                    image.className =
                        'h-full w-full object-cover';


                    image.alt =
                        file.name;


                    const objectUrl =
                        URL.createObjectURL(file);


                    image.src =
                        objectUrl;


                    image.onload =
                        function () {

                            URL.revokeObjectURL(
                                objectUrl
                            );

                        };


                    visual.appendChild(image);

                } else {

                    /*
                    |--------------------------------------------------------------------------
                    | Icon untuk PDF / ZIP
                    |--------------------------------------------------------------------------
                    */

                    let label = 'FILE';


                    if (file.type === 'application/pdf') {
                        label = 'PDF';
                    }

                    if (file.type === 'application/zip') {
                        label = 'ZIP';
                    }


                    const fileLabel =
                        document.createElement('span');


                    fileLabel.className =
                        'text-xs font-bold text-gray-500';


                    fileLabel.textContent =
                        label;


                    visual.appendChild(fileLabel);

                }


                row.appendChild(visual);


                /*
                |--------------------------------------------------------------------------
                | Nama + ukuran
                |--------------------------------------------------------------------------
                */

                const info =
                    document.createElement('div');


                info.className =
                    'min-w-0 flex-1';


                const name =
                    document.createElement('p');


                name.className =
                    'truncate text-sm font-medium text-gray-800';


                name.textContent =
                    file.name;


                const size =
                    document.createElement('p');


                size.className =
                    'mt-0.5 text-xs text-gray-500';


                size.textContent =
                    formatFileSize(file.size);


                info.appendChild(name);

                info.appendChild(size);

                row.appendChild(info);


                /*
                |--------------------------------------------------------------------------
                | Tombol X
                |--------------------------------------------------------------------------
                */

                const removeButton =
                    document.createElement('button');


                removeButton.type =
                    'button';


                removeButton.className =
                    'flex h-8 w-8 shrink-0 items-center justify-center rounded-full text-gray-400 transition hover:bg-red-50 hover:text-red-600';


                removeButton.setAttribute(
                    'aria-label',
                    'Batalkan lampiran ' + file.name
                );


                removeButton.title =
                    'Batalkan lampiran';


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


                removeButton.addEventListener(
                    'click',
                    function () {

                        selectedFiles.splice(
                            index,
                            1
                        );


                        syncInputFiles();

                        renderPreview();

                    }
                );


                row.appendChild(removeButton);


                preview.appendChild(row);

            });

        }


        /*
        |--------------------------------------------------------------------------
        | Pilih file
        |--------------------------------------------------------------------------
        */

        input.addEventListener(
            'change',
            function () {

                const files =
                    Array.from(input.files);


                if (files.length === 0) {
                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | Maksimal 5 file
                |--------------------------------------------------------------------------
                */

                if (files.length > MAX_FILES) {

                    alert(
                        'Maksimal 5 file dapat dilampirkan.'
                    );


                    input.value = '';

                    selectedFiles = [];

                    renderPreview();

                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | Validasi tipe dan ukuran
                |--------------------------------------------------------------------------
                */

                const invalidFile =
                    files.find(function (file) {

                        return (
                            !ALLOWED_TYPES.includes(
                                file.type
                            )
                            ||
                            file.size > MAX_SIZE
                        );

                    });


                if (invalidFile) {

                    alert(
                        'File "' +
                        invalidFile.name +
                        '" tidak dapat digunakan.\n\n' +
                        'Format yang diperbolehkan: PDF, JPG, JPEG, PNG, ZIP.\n' +
                        'Maksimal ukuran: 10 MB per file.'
                    );


                    input.value = '';

                    selectedFiles = [];

                    renderPreview();

                    return;
                }


                selectedFiles =
                    files;


                renderPreview();

            }
        );


    });
</script>
@endsection