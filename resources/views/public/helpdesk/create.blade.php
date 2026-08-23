@extends('layouts.public')

@section('content')

<div class="min-h-screen bg-gray-50">

    <div class="mx-auto max-w-4xl px-4 py-10 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <div class="mb-6 text-sm text-gray-500">

            <a
                href="{{ route('helpdesk.index') }}"
                class="font-medium text-indigo-600 hover:text-indigo-700"
            >
                Helpdesk
            </a>

            <span class="mx-2">/</span>

            <span>
                {{ $category->name }}
            </span>

        </div>


        {{-- Header --}}
        <div class="mb-8">

            <span class="inline-flex items-center rounded-full bg-indigo-100 px-3 py-1 text-sm font-medium text-indigo-700">
                {{ $category->name }}
            </span>

            <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900">
                Ajukan {{ $category->name }}
            </h1>

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
                        >{{ old('message') }}
                    </textarea>

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
                        class="block w-full rounded-lg border border-gray-300 bg-white text-sm text-gray-900 file:mr-4 file:border-0 file:bg-gray-100 file:px-4 file:py-2.5 file:text-sm file:font-medium"
                    >

                    <p class="mt-1 text-xs text-gray-500">
                        Anda dapat melampirkan dokumen atau gambar pendukung.
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

@endsection