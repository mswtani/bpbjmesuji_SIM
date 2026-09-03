@php
    $post = $post ?? null;

    $formAction = $formAction ?? '#';
    $formMethod = $formMethod ?? 'POST';
    $submitLabel = $submitLabel ?? 'Simpan';

    $selectedType = old('type', $post?->type ?? 'news');

    $selectedLegalStatus = old(
        'legal_status',
        $post?->legal_status
    );

    $selectedRegulationTypeId = old(
        'regulation_type_id',
        $post?->regulation_type_id
    );
@endphp

<style>
    #content-editor a {
        display: inline-block;
        color: rgb(37 99 235);
        text-decoration: none;
        transform: scale(1);
        transform-origin: center;
        transition:
            color 200ms ease,
            text-decoration-color 200ms ease,
            transform 200ms ease;
    }

    #content-editor a:hover {
        color: rgb(29 78 216);
        text-decoration: underline;
        transform: scale(1.1);
    }
</style>




    <form
        id="{{ $formId ?? 'post-form' }}"
        method="POST"
        action="{{ $formAction }}"
        enctype="multipart/form-data"
        class="space-y-6"
        @if (($formId ?? '') === 'post-edit-form')
            data-confirm="Perbarui konten ini?"
            data-confirm-action="update"
            data-confirm-button="Simpan Perubahan"
        @endif
    >

    @csrf

    @if ($formMethod !== 'POST')
        @method($formMethod)
    @endif


    {{-- =========================================================
        JENIS KONTEN
    ========================================================== --}}

    <div>

        <label
            for="type"
            class="block text-sm font-medium text-gray-700"
        >
            Jenis Konten
        </label>

        <select
            id="type"Simpan 
            name="type"
            required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        >

            <option
                value="news"
                @selected($selectedType === 'news')
            >
                Berita
            </option>

            <option
                value="announcement"
                @selected($selectedType === 'announcement')
            >
                Pengumuman
            </option>

            <option
                value="regulation"
                @selected($selectedType === 'regulation')
            >
                Regulasi
            </option>

        </select>

        @error('type')

            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>

        @enderror

    </div>


    {{-- =========================================================
        DATA REGULASI
    ========================================================== --}}

    <div
        id="regulation-fields"
        class="{{ $selectedType === 'regulation' ? '' : 'hidden' }}" >

        <div class="rounded-lg border border-purple-200 bg-purple-50 p-5">

            <div class="mb-5">

                <h3 class="text-base font-semibold text-purple-900">
                    Data Regulasi
                </h3>

                <p class="mt-1 text-sm text-purple-700">
                    Lengkapi informasi regulasi dan dokumen PDF.
                </p>

            </div>


            {{-- =================================================
                JENIS REGULASI
            ================================================== --}}

            <div>

                <label
                    for="regulation_type_id"
                    class="block text-sm font-medium text-gray-700"
                >
                    Jenis Regulasi
                </label>

                <select
                    id="regulation_type_id"
                    name="regulation_type_id"
                    class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                >

                    <option value="">
                        -- Pilih Jenis Regulasi --
                    </option>

                    @foreach (
                        \App\Models\RegulationType::where('is_active', true)
                            ->orderBy('sort_order')
                            ->get()
                        as $regulationType
                    )

                        <option
                            value="{{ $regulationType->id }}"
                            @selected(
                                old(
                                    'regulation_type_id',
                                    $post?->regulation_type_id
                                ) == $regulationType->id
                            )
                        >
                            {{ $regulationType->name }}
                        </option>

                    @endforeach

                </select>

                @error('regulation_type_id')

                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- =================================================
                NOMOR REGULASI
            ================================================== --}}

            <div class="mt-5">

                <label
                    for="regulation_number"
                    class="block text-sm font-medium text-gray-700"
                >
                    Nomor Regulasi
                </label>

                <input
                    id="regulation_number"
                    name="regulation_number"
                    type="text"
                    value="{{ old('regulation_number', $post?->regulation_number) }}"
                    maxlength="100"
                    class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="Contoh: 12 Tahun 2026"
                >

                @error('regulation_number')

                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- =================================================
                TAHUN DAN TANGGAL
            ================================================== --}}

            <div class="mt-5 grid gap-5 sm:grid-cols-2">

                <div>

                    <label
                        for="regulation_year"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Tahun
                    </label>

                    <input
                        id="regulation_year"
                        name="regulation_year"
                        type="number"
                        value="{{ old('regulation_year', $post?->regulation_year) }}"
                        min="1900"
                        max="2100"
                        class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="{{ date('Y') }}"
                    >

                    @error('regulation_year')

                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                <div>

                    <label
                        for="regulation_date"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Tanggal Diundangkan Regulasi
                    </label>

                    <input
                        id="regulation_date"
                        name="regulation_date"
                        type="date"
                        value="{{ old('regulation_date', $post?->regulation_date?->format('Y-m-d')) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    >

                    @error('regulation_date')

                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

            </div>


            {{-- =================================================
                STATUS HUKUM
            ================================================== --}}

            <div class="mt-5">

                <label
                    for="legal_status"
                    class="block text-sm font-medium text-gray-700"
                >
                    Status Hukum
                </label>

                <select
                    id="legal_status"
                    name="legal_status"
                    class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                >

                    <option value="">
                        -- Pilih Status Hukum --
                    </option>

                    {{-- Berlaku --}}
                    <option
                        value="berlaku"
                        @selected($selectedLegalStatus === 'berlaku')
                    >
                        Berlaku
                    </option>

                    {{-- Tidak Berlaku --}}
                    <option
                        value="tidak_berlaku"
                        @selected($selectedLegalStatus === 'tidak_berlaku')
                    >
                        Tidak Berlaku
                    </option>

                    {{-- Mencabut --}}
                    <option
                        value="mencabut"
                        @selected($selectedLegalStatus === 'mencabut')
                    >
                        Mencabut
                    </option>

                    {{-- Dicabut --}}
                    <option
                        value="dicabut"
                        @selected($selectedLegalStatus === 'dicabut')
                    >
                        Dicabut
                    </option>

                    {{-- Mengubah --}}
                    <option
                        value="mengubah"
                        @selected($selectedLegalStatus === 'mengubah')
                    >
                        Mengubah
                    </option>

                    {{-- Diubah --}}
                    <option
                        value="diubah"
                        @selected($selectedLegalStatus === 'diubah')
                    >
                        Diubah
                    </option>

                </select>

                <p class="mt-1 text-xs text-gray-500">
                    Status hukum regulasi, bukan status publikasi konten.
                </p>

                @error('legal_status')

                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- =================================================
                DOKUMEN PDF
            ================================================== --}}

            <div class="mt-5">

                <label
                    for="document"
                    class="block text-sm font-medium text-gray-700"
                >
                    Dokumen Regulasi
                </label>

                <input
                    id="document"
                    name="document"
                    type="file"
                    accept="application/pdf,.pdf,application/zip,.zip,application/x-rar-compressed,.rar"
                    class="mt-1 block w-full text-sm text-gray-700
                        file:mr-4 file:rounded-md file:border-0
                        file:bg-white file:px-4 file:py-2
                        file:text-sm file:font-medium
                        hover:file:bg-gray-100"
                >

                <p class="mt-1 text-xs text-gray-500">
                    Format PDF, ZIP, atau RAR. Maksimal 20 MB.
                    PDF dapat dipreview langsung; ZIP/RAR hanya dapat didownload.
                </p>

                @error('document')

                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror


                @if ($post?->document_path)

                    <div class="mt-3 rounded-md border border-gray-200 bg-white p-3">

                        <p class="text-xs font-medium text-gray-500">
                            Dokumen saat ini
                        </p>

                        <p class="mt-1 truncate text-sm text-gray-800">
                            {{ $post->document_original_name ?? basename($post->document_path) }}
                        </p>

                    </div>

                @endif

            </div>


            {{-- =================================================
                HUBUNGAN REGULASI
                Muncul hanya untuk status:
                - Mencabut
                - Dicabut
                - Mengubah
                - Diubah
            ================================================== --}}

            <div
                id="regulation-relation-section"
                class="{{ in_array($selectedLegalStatus, ['mencabut', 'dicabut', 'mengubah', 'diubah'], true) ? '' : 'hidden' }}" >

                <div class="mt-6 border-t border-purple-200 pt-6">

                    <div class="mb-4">

                        <h3 class="text-base font-semibold text-purple-900">
                            Hubungan Regulasi
                        </h3>

                        <p
                            id="regulation-relation-description"
                            class="mt-1 text-sm text-purple-700"
                        >
                            Pilih regulasi yang berhubungan dengan status hukum ini.
                        </p>

                    </div>


                    {{-- MENCABUT --}}
                    <div
                        id="repeals-relation-field"
                        class="{{ $selectedLegalStatus === 'mencabut' ? '' : 'hidden' }}" >

                        <label
                            for="repeals_post_id"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Regulasi yang Dicabut
                        </label>

                        <select
                            id="repeals_post_id"
                            name="repeals_post_id"
                            class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >

                            <option value="">
                                -- Pilih Regulasi yang Dicabut --
                            </option>

                            @foreach (
                                \App\Models\Post::query()
                                    ->where('type', 'regulation')
                                    ->where('id', '!=', $post?->id)
                                    ->where('status', '!=', 'archived')
                                    ->orderByDesc('regulation_year')
                                    ->orderBy('title')
                                    ->get()
                                as $relatedPost
                            )

                                <option
                                    value="{{ $relatedPost->id }}"
                                    data-regulation-type-id="{{ $relatedPost->regulation_type_id }}"
                                    @selected(
                                        old(
                                            'repeals_post_id',
                                            $post?->repeals?->first()?->related_post_id
                                        ) == $relatedPost->id
                                    )
                                >
                                    {{ $relatedPost->regulation_number
                                        ? $relatedPost->regulation_number . ' — '
                                        : ''
                                    }}
                                    {{ $relatedPost->title }}
                                </option>

                            @endforeach

                        </select>

                        <p class="mt-1 text-xs text-gray-500">
                            Pilih regulasi yang dicabut atau digantikan oleh regulasi ini.
                        </p>

                        @error('repeals_post_id')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- DICABUT --}}
                    <div
                        id="repealed-by-relation-field"
                        class="{{ $selectedLegalStatus === 'dicabut' ? '' : 'hidden' }}" >

                        <label
                            for="repealed_by_post_id"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Dicabut Oleh
                        </label>

                        <select
                            id="repealed_by_post_id"
                            name="repealed_by_post_id"
                            class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >

                            <option value="">
                                -- Pilih Regulasi yang Mencabut --
                            </option>

                            @foreach (
                                \App\Models\Post::query()
                                    ->where('type', 'regulation')
                                    ->where('id', '!=', $post?->id)
                                    ->where('status', '!=', 'archived')
                                    ->orderByDesc('regulation_year')
                                    ->orderBy('title')
                                    ->get()
                                as $relatedPost
                            )

                                <option
                                    value="{{ $relatedPost->id }}"
                                    data-regulation-type-id="{{ $relatedPost->regulation_type_id }}"
                                    @selected(
                                        old(
                                            'repealed_by_post_id',
                                            $post?->repealedBy?->first()?->post_id
                                        ) == $relatedPost->id
                                    )
                                >
                                    {{ $relatedPost->regulation_number
                                        ? $relatedPost->regulation_number . ' — '
                                        : ''
                                    }}
                                    {{ $relatedPost->title }}
                                </option>

                            @endforeach

                        </select>

                        <p class="mt-1 text-xs text-gray-500">
                            Pilih regulasi yang mencabut regulasi ini.
                        </p>

                        @error('repealed_by_post_id')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- MENGUBAH --}}
                    <div
                        id="amends-relation-field"
                        class="{{ $selectedLegalStatus === 'mengubah' ? '' : 'hidden' }}" >

                        <label
                            for="amends_post_id"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Regulasi yang Diubah
                        </label>

                        <select
                            id="amends_post_id"
                            name="amends_post_id"
                            class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >

                            <option value="">
                                -- Pilih Regulasi yang Diubah --
                            </option>

                            @foreach (
                                \App\Models\Post::query()
                                    ->where('type', 'regulation')
                                    ->where('id', '!=', $post?->id)
                                    ->where('status', '!=', 'archived')
                                    ->orderByDesc('regulation_year')
                                    ->orderBy('title')
                                    ->get()
                                as $relatedPost
                            )

                                <option
                                    value="{{ $relatedPost->id }}"
                                data-regulation-type-id="{{ $relatedPost->regulation_type_id }}"
                                @selected(
                                    old(
                                        'amends_post_id',
                                        $post?->amends?->first()?->related_post_id
                                    ) == $relatedPost->id
                                )
                            >
                                    {{ $relatedPost->regulation_number
                                        ? $relatedPost->regulation_number . ' — '
                                        : ''
                                    }}
                                    {{ $relatedPost->title }}
                                </option>

                            @endforeach

                        </select>

                        <p class="mt-1 text-xs text-gray-500">
                            Pilih regulasi yang diubah oleh regulasi ini.
                        </p>

                        @error('amends_post_id')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- DIUBAH --}}
                    <div
                        id="amended-by-relation-field"
                        class="{{ $selectedLegalStatus === 'diubah' ? '' : 'hidden' }}" >

                        <label
                            for="amended_by_post_id"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Diubah Oleh
                        </label>

                        <select
                            id="amended_by_post_id"
                            name="amended_by_post_id"
                            class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >

                            <option value="">
                                -- Pilih Regulasi yang Mengubah --
                            </option>

                            @foreach (
                                \App\Models\Post::query()
                                    ->where('type', 'regulation')
                                    ->where('id', '!=', $post?->id)
                                    ->where('status', '!=', 'archived')
                                    ->orderByDesc('regulation_year')
                                    ->orderBy('title')
                                    ->get()
                                as $relatedPost
                            )

                                <option
                                    value="{{ $relatedPost->id }}"
                                    data-regulation-type-id="{{ $relatedPost->regulation_type_id }}"
                                    @selected(
                                        old(
                                            'amended_by_post_id',
                                            $post?->amendedBy?->first()?->post_id
                                        ) == $relatedPost->id
                                    )
                                >
                                    {{ $relatedPost->regulation_number
                                        ? $relatedPost->regulation_number . ' — '
                                        : ''
                                    }}
                                    {{ $relatedPost->title }}
                                </option>

                            @endforeach

                        </select>

                        <p class="mt-1 text-xs text-gray-500">
                            Pilih regulasi yang mengubah regulasi ini.
                        </p>

                        @error('amended_by_post_id')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </div>
        </div>

    </div>
    

    {{-- =========================================================
        JUDUL
    ========================================================== --}}

    <div>

        <label
            for="title"
            class="block text-sm font-medium text-gray-700"
        >
            Judul
        </label>

        <input
            id="title"
            name="title"
            type="text"
            value="{{ old('title', $post?->title) }}"
            required
            maxlength="5000"
            autofocus
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            placeholder="Masukkan judul konten"
        >

        @error('title')

            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>

        @enderror

    </div>


    {{-- =========================================================
        SLUG
    ========================================================== --}}

    <div>

        <label
            for="slug"
            class="block text-sm font-medium text-gray-700"
        >
            Slug
            <span class="font-normal text-gray-500">
                (opsional)
            </span>
        </label>

        <input
            id="slug"
            name="slug"
            type="text"
            value="{{ old('slug', $post?->slug) }}"
            maxlength="255"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            placeholder="contoh-judul-konten"
        >

        <p class="mt-1 text-xs text-gray-500">
            Kosongkan jika ingin sistem membuat slug otomatis dari judul.
        </p>

        @error('slug')

            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>

        @enderror

    </div>


    {{-- =========================================================
        RINGKASAN
    ========================================================= --}}

    <div>

        <label
            for="excerpt-editor"
            class="block text-sm font-medium text-gray-700"
        >
            Ringkasan

            <span class="font-normal text-gray-500">
                (opsional)
            </span>
        </label>


        {{-- Editor Ringkasan --}}
        <div class="mt-1 overflow-hidden rounded-md border border-gray-300 bg-white">

            {{-- Toolbar --}}
            <div class="flex flex-wrap items-center gap-1 border-b border-gray-200 bg-gray-50 p-2">

                {{-- Bold --}}
                <button
                    type="button"
                    data-excerpt-command="bold"
                    class="rounded px-3 py-1.5 text-sm font-bold text-gray-700 hover:bg-gray-200"
                    title="Tebal"
                >
                    B
                </button>

                {{-- Italic --}}
                <button
                    type="button"
                    data-excerpt-command="italic"
                    class="rounded px-3 py-1.5 text-sm italic text-gray-700 hover:bg-gray-200"
                    title="Miring"
                >
                    I
                </button>

                {{-- Underline --}}
                <button
                    type="button"
                    data-excerpt-command="underline"
                    class="rounded px-3 py-1.5 text-sm font-medium text-gray-700 underline hover:bg-gray-200"
                    title="Garis bawah"
                >
                    U
                </button>

            </div>


            {{-- Editor --}}
            <div
                id="excerpt-editor"
                contenteditable="true"
                role="textbox"
                aria-multiline="true"
                class="min-h-[140px] w-full px-4 py-3 text-sm leading-7 text-gray-900 outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
            ></div>

        </div>


        {{-- Nilai sebenarnya yang dikirim ke server --}}
        <textarea
            id="excerpt"
            name="excerpt"
            class="hidden"
        >{{ old('excerpt', $post?->excerpt) }}</textarea>


        <p class="mt-1 text-xs text-gray-500">
            Gunakan B untuk tebal, I untuk miring, dan U untuk garis bawah.
        </p>


        @error('excerpt')

            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>

        @enderror

    </div>


    {{-- =========================================================
        ISI KONTEN
    ========================================================= --}}

    <div>

        <label
            for="content-editor"
            class="block text-sm font-medium text-gray-700"
        >
            Isi Konten
            <span class="text-red-500">*</span>
        </label>


        @if ($selectedType !== 'regulation')

            {{-- Editor untuk Berita dan Pengumuman --}}

            <div
                class="
                    mt-1
                    overflow-hidden
                    rounded-md
                    border
                    border-gray-300
                    bg-white
                "
            >

                {{-- Toolbar --}}

                <div
                    class="
                        flex
                        flex-wrap
                        items-center
                        gap-1
                        border-b
                        border-gray-200
                        bg-gray-50
                        p-2
                    "
                    role="toolbar"
                    aria-label="Pemformatan isi konten"
                >

                    {{-- Bold --}}

                    <button
                        type="button"
                        data-editor-command="bold"
                        class="
                            editor-command
                            rounded
                            px-3
                            py-1.5
                            text-sm
                            font-bold
                            text-gray-700
                            hover:bg-gray-200
                        "
                        title="Tebal"
                        aria-label="Tebal"
                    >
                        B
                    </button>


                    {{-- Italic --}}

                    <button
                        type="button"
                        data-editor-command="italic"
                        class="
                            editor-command
                            rounded
                            px-3
                            py-1.5
                            text-sm
                            italic
                            text-gray-700
                            hover:bg-gray-200
                        "
                        title="Miring"
                        aria-label="Miring"
                    >
                        I
                    </button>


                    {{-- Underline --}}

                    <button
                        type="button"
                        data-editor-command="underline"
                        class="
                            editor-command
                            rounded
                            px-3
                            py-1.5
                            text-sm
                            underline
                            text-gray-700
                            hover:bg-gray-200
                        "
                        title="Garis bawah"
                        aria-label="Garis bawah"
                    >
                        U
                    </button>


                    <span class="mx-1 h-6 w-px bg-gray-300"></span>


                    {{-- Link --}}

                    <button
                        type="button"
                        id="insert-link-button"
                        class="
                            rounded
                            px-3
                            py-1.5
                            text-sm
                            font-medium
                            text-gray-700
                            hover:bg-gray-200
                        "
                        title="Sisipkan Link"
                        aria-label="Sisipkan Link"
                    >
                        🔗 Link
                    </button>

                </div>


                {{-- Editor --}}

                <div
                    id="content-editor"
                    contenteditable="true"
                    role="textbox"
                    aria-multiline="true"
                    class="
                        min-h-[300px]
                        w-full
                        px-4
                        py-3
                        text-sm
                        leading-7
                        text-gray-900
                        outline-none
                        focus:ring-2
                        focus:ring-inset
                        focus:ring-indigo-500
                    "
                >{!! old('content', $post?->content) !!}</div>

            </div>


            {{-- Nilai sebenarnya yang dikirim ke server --}}

            <textarea
                id="content"
                name="content"
                class="hidden"
            >{{ old('content', $post?->content) }}</textarea>


            <p class="mt-1 text-xs text-gray-500">

                Anda dapat menulis teks, membuat teks
                <strong>tebal</strong>,
                <em>miring</em>,
                <u>garis bawah</u>,
                dan membuat bagian tertentu menjadi link.

            </p>


        @else

            {{-- Regulasi menggunakan textarea biasa --}}

            <textarea
                id="content"
                name="content"
                rows="12"
                class="
                    mt-1
                    block
                    w-full
                    rounded-md
                    border-gray-300
                    shadow-sm
                    focus:border-indigo-500
                    focus:ring-indigo-500
                "
                placeholder="Tuliskan isi konten di sini..."
            >{{ old('content', $post?->content) }}</textarea>

        @endif


        {{-- Error validasi JavaScript --}}

        <p
            id="content-client-error"
            class="
                mt-2
                hidden
                text-sm
                text-red-600
            "
        >
            Isi konten wajib diisi.
        </p>


        {{-- Error validasi Laravel --}}

        @error('content')

            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>

        @enderror

    </div>


    {{-- =========================================================
        GAMBAR UTAMA
    ========================================================== --}}

    <div>

        <label
            for="featured_image"
            class="block text-sm font-medium text-gray-700"
        >
            Gambar Utama
            <span class="font-normal text-gray-500">
                (opsional)
            </span>
        </label>

        <input
            id="featured_image"
            name="featured_image"
            type="file"
            accept="image/jpeg,image/png,image/webp,.jpg,.jpeg,.png,.webp"
            class="mt-1 block w-full text-sm text-gray-700
                file:mr-4 file:rounded-md file:border-0
                file:bg-white file:px-4 file:py-2
                file:text-sm file:font-medium
                hover:file:bg-gray-100"
        >

        <p class="mt-1 text-xs text-gray-500">
            Format JPG, JPEG, PNG, atau WebP. Maksimal 2 MB.
        </p>

        @error('featured_image')

            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>

        @enderror


        @if (
            $post?->featured_image &&
            \Illuminate\Support\Facades\Storage::disk('public')->exists(
                $post->featured_image
            )
        )

            <div class="mt-4">

                <p class="mb-2 text-xs font-medium text-gray-500">
                    Gambar saat ini
                </p>

                <img
                    src="{{ asset('storage/' . $post->featured_image) }}"
                    alt="{{ $post->title }}"
                    class="max-h-64 rounded-lg border border-gray-200 object-contain"
                >

            </div>

        @endif

    </div>


 </form>


{{-- =========================================================
    JAVASCRIPT
========================================================== --}}

<script>
    document.addEventListener('DOMContentLoaded', function () {

        /*
        |--------------------------------------------------------------------------
        | ELEMENT REGULASI
        |--------------------------------------------------------------------------
        */

        const typeSelect =
            document.getElementById('type');

        const regulationFields =
            document.getElementById('regulation-fields');

        const legalStatusSelect =
            document.getElementById('legal_status');

        const regulationRelationSection =
            document.getElementById('regulation-relation-section');

        const repealsRelationField =
            document.getElementById('repeals-relation-field');

        const repealedByRelationField =
            document.getElementById('repealed-by-relation-field');

        const amendsRelationField =
            document.getElementById('amends-relation-field');

        const amendedByRelationField =
            document.getElementById('amended-by-relation-field');

        const relationDescription =
            document.getElementById('regulation-relation-description');


        /*
        |--------------------------------------------------------------------------
        | EDITOR ISI KONTEN
        |--------------------------------------------------------------------------
        */

        const contentEditor =
            document.getElementById('content-editor');

        const contentTextarea =
            document.getElementById('content');

        const contentClientError =
            document.getElementById('content-client-error');

        const insertLinkButton =
            document.getElementById('insert-link-button');

        const excerptEditor =
            document.getElementById('excerpt-editor');

        const excerptTextarea =
            document.getElementById('excerpt');


        function syncExcerptEditor() {

            if (!excerptEditor || !excerptTextarea) {
                return;
            }

            excerptTextarea.value =
                excerptEditor.innerHTML;
        }


        function initializeExcerptEditor() {

            if (!excerptEditor || !excerptTextarea) {
                return;
            }

            excerptEditor.innerHTML =
                excerptTextarea.value || '';

            excerptEditor.addEventListener(
                'input',
                syncExcerptEditor
            );

            excerptEditor.addEventListener(
                'blur',
                syncExcerptEditor
            );

            const excerptForm =
                excerptEditor.closest('form');

            excerptForm?.addEventListener(
                'submit',
                function () {
                    syncExcerptEditor();
                }
            );
        }


        document
            .querySelectorAll('[data-excerpt-command]')
            .forEach(function (button) {

                button.addEventListener(
                    'mousedown',
                    function (event) {

                        /*
                        * Jangan kehilangan selection
                        * ketika toolbar diklik.
                        */
                        event.preventDefault();

                        if (!excerptEditor) {
                            return;
                        }

                        excerptEditor.focus();

                        const command =
                            button.dataset.excerptCommand;

                        document.execCommand(
                            command,
                            false,
                            null
                        );

                        syncExcerptEditor();
                    }
                );

            });


        initializeExcerptEditor();


        /*
        |--------------------------------------------------------------------------
        | Sinkronisasi editor -> textarea
        |--------------------------------------------------------------------------
        */

        function syncContentEditor() {

            if (!contentEditor || !contentTextarea) {
                return;
            }

            contentTextarea.value =
                contentEditor.innerHTML;
        }


        /*
        |--------------------------------------------------------------------------
        | Inisialisasi editor
        |--------------------------------------------------------------------------
        */

        function initializeContentEditor() {

            if (!contentEditor || !contentTextarea) {
                return;
            }

            /*
            * Isi editor dari database / old input.
            */
            contentEditor.innerHTML =
                contentTextarea.value || '';


            /*
            * Jika user mengetik.
            */
            contentEditor.addEventListener(
                'input',
                syncContentEditor
            );


            /*
            * Pastikan nilai tersinkron ketika meninggalkan editor.
            */
            contentEditor.addEventListener(
                'blur',
                syncContentEditor
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Toolbar B / I / U
        |--------------------------------------------------------------------------
        */

        const editorCommands =
            document.querySelectorAll(
                '[data-editor-command]'
            );


        editorCommands.forEach(function (button) {

            /*
            * Mousedown digunakan, bukan click,
            * supaya selection teks tidak hilang
            * ketika toolbar ditekan.
            */
            button.addEventListener(
                'mousedown',
                function (event) {

                    event.preventDefault();

                    if (!contentEditor) {
                        return;
                    }

                    contentEditor.focus();

                    const command =
                        button.dataset.editorCommand;

                    document.execCommand(
                        command,
                        false,
                        null
                    );

                    syncContentEditor();
                }
            );

        });


        /*
        |--------------------------------------------------------------------------
        | INSERT LINK
        |--------------------------------------------------------------------------
        */

        insertLinkButton?.addEventListener(
            'mousedown',
            function (event) {

                event.preventDefault();

                if (!contentEditor) {
                    return;
                }

                contentEditor.focus();

                const selection =
                    window.getSelection();


                if (
                    !selection ||
                    selection.rangeCount === 0 ||
                    selection.isCollapsed
                ) {

                    alert(
                        'Pilih teks yang ingin dijadikan hyperlink terlebih dahulu.'
                    );

                    return;
                }


                const selectedText =
                    selection.toString().trim();


                if (!selectedText) {

                    alert(
                        'Pilih teks yang ingin dijadikan hyperlink terlebih dahulu.'
                    );

                    return;
                }


                const url =
                    window.prompt(
                        'Masukkan URL hyperlink:',
                        'https://'
                    );


                if (url === null) {
                    return;
                }


                const trimmedUrl =
                    url.trim();


                if (
                    !/^https?:\/\//i.test(trimmedUrl)
                ) {

                    alert(
                        'URL harus diawali http:// atau https://'
                    );

                    return;
                }


                document.execCommand(
                    'createLink',
                    false,
                    trimmedUrl
                );


                /*
                * Beri target baru dan keamanan
                * pada hyperlink yang dibuat.
                */
                const links =
                    contentEditor.querySelectorAll(
                        'a'
                    );


                links.forEach(function (link) {

                    if (
                        link.getAttribute('href') ===
                        trimmedUrl
                    ) {

                        link.setAttribute(
                            'target',
                            '_blank'
                        );

                        link.setAttribute(
                            'rel',
                            'noopener noreferrer'
                        );
                    }

                });


                syncContentEditor();

            }
        );


        /*
        |--------------------------------------------------------------------------
        | VALIDASI DAN SYNC ISI KONTEN
        |--------------------------------------------------------------------------
        */

        const postForm =
            document.getElementById(
                '{{ $formId }}'
            );


        postForm?.addEventListener(
            'submit',
            function (event) {

                /*
                |--------------------------------------------------------------------------
                | Berita / Pengumuman
                |--------------------------------------------------------------------------
                |
                | Menggunakan Rich Text Editor
                */

                if (
                    contentEditor &&
                    contentTextarea
                ) {

                    syncContentEditor();


                    const plainText =
                        contentEditor.innerText.trim();


                    if (! plainText) {

                        event.preventDefault();


                        contentClientError?.classList.remove(
                            'hidden'
                        );


                        contentEditor.classList.add(
                            'ring-2',
                            'ring-inset',
                            'ring-red-500'
                        );


                        contentEditor.focus();


                        return;
                    }


                    contentClientError?.classList.add(
                        'hidden'
                    );


                    contentEditor.classList.remove(
                        'ring-2',
                        'ring-inset',
                        'ring-red-500'
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | Regulasi
                |--------------------------------------------------------------------------
                |
                | Menggunakan textarea biasa
                */

                if (
                    !contentEditor &&
                    contentTextarea
                ) {

                    const contentValue =
                        contentTextarea.value.trim();


                    if (!contentValue) {

                        event.preventDefault();


                        contentClientError?.classList.remove(
                            'hidden'
                        );


                        contentTextarea.classList.add(
                            'border-red-500',
                            'focus:border-red-500',
                            'focus:ring-red-500/30'
                        );


                        contentTextarea.focus();


                        return;
                    }


                    contentClientError?.classList.add(
                        'hidden'
                    );


                    contentTextarea.classList.remove(
                        'border-red-500',
                        'focus:border-red-500',
                        'focus:ring-red-500/30'
                    );

                }

            }
        );

        /*
        |--------------------------------------------------------------------------
        | BATAL / RESET FORM
        |--------------------------------------------------------------------------
        */

        const resetPostFormButton =
            document.getElementById(
                'reset-post-form'
            );


        const cancelEditModal =
            document.getElementById(
                'cancel-edit-modal'
            );


        const cancelEditModalPanel =
            document.getElementById(
                'cancel-edit-modal-panel'
            );


        const closeCancelEditModalButton =
            document.getElementById(
                'close-cancel-edit-modal'
            );


        const confirmResetPostFormButton =
            document.getElementById(
                'confirm-reset-post-form'
            );


        /*
        |--------------------------------------------------------------------------
        | Buka Modal
        |--------------------------------------------------------------------------
        */

        function openCancelEditModal() {

            if (!cancelEditModal) {
                return;
            }


            cancelEditModal.classList.remove(
                'hidden'
            );


            cancelEditModal.classList.add(
                'flex'
            );


            /*
            | Animasi modal
            */

            requestAnimationFrame(
                function () {

                    cancelEditModalPanel?.classList.remove(
                        'scale-95',
                        'opacity-0'
                    );


                    cancelEditModalPanel?.classList.add(
                        'scale-100',
                        'opacity-100'
                    );

                }
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Tutup Modal
        |--------------------------------------------------------------------------
        */

        function closeCancelEditModal() {

            if (!cancelEditModal) {
                return;
            }


            cancelEditModalPanel?.classList.remove(
                'scale-100',
                'opacity-100'
            );


            cancelEditModalPanel?.classList.add(
                'scale-95',
                'opacity-0'
            );


            setTimeout(
                function () {

                    cancelEditModal.classList.remove(
                        'flex'
                    );


                    cancelEditModal.classList.add(
                        'hidden'
                    );

                },
                200
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Klik Tombol Batal
        |--------------------------------------------------------------------------
        */

        resetPostFormButton?.addEventListener(
            'click',
            function () {

                openCancelEditModal();

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Tetap Edit
        |--------------------------------------------------------------------------
        */

        closeCancelEditModalButton?.addEventListener(
            'click',
            function () {

                closeCancelEditModal();

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Konfirmasi Reset
        |--------------------------------------------------------------------------
        */

        confirmResetPostFormButton?.addEventListener(
            'click',
            function () {

                if (!postForm) {
                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | Reset seluruh input form
                |--------------------------------------------------------------------------
                */

                postForm.reset();


                /*
                |--------------------------------------------------------------------------
                | Sinkronkan Rich Text Editor
                |--------------------------------------------------------------------------
                */

                if (
                    contentEditor &&
                    contentTextarea
                ) {

                    contentEditor.innerHTML =
                        contentTextarea.value || '';
                }


                /*
                |--------------------------------------------------------------------------
                | Sinkronkan Excerpt Editor
                |--------------------------------------------------------------------------
                */

                if (
                    excerptEditor &&
                    excerptTextarea
                ) {

                    excerptEditor.innerHTML =
                        excerptTextarea.value || '';
                }


                /*
                |--------------------------------------------------------------------------
                | Hilangkan error validasi
                |--------------------------------------------------------------------------
                */

                contentClientError?.classList.add(
                    'hidden'
                );


                contentEditor?.classList.remove(
                    'ring-2',
                    'ring-inset',
                    'ring-red-500'
                );


                contentTextarea?.classList.remove(
                    'border-red-500',
                    'focus:border-red-500',
                    'focus:ring-red-500/30'
                );


                /*
                |--------------------------------------------------------------------------
                | Refresh field regulasi
                |--------------------------------------------------------------------------
                */

                toggleRegulationFields();

                toggleRegulationRelation();

                filterRelatedRegulations();


                /*
                |--------------------------------------------------------------------------
                | Tutup modal
                |--------------------------------------------------------------------------
                */

                closeCancelEditModal();

            }
        );

        /*
        |--------------------------------------------------------------------------
        | Tutup Modal Saat Klik Backdrop
        |--------------------------------------------------------------------------
        */

        cancelEditModal?.addEventListener(
            'click',
            function (event) {

                if (
                    event.target === cancelEditModal
                ) {

                    closeCancelEditModal();

                }

            }
        );

        /*
        |--------------------------------------------------------------------------
        | Tutup Modal Dengan Tombol Escape
        |--------------------------------------------------------------------------
        */

        document.addEventListener(
            'keydown',
            function (event) {

                if (
                    event.key === 'Escape' &&
                    !cancelEditModal?.classList.contains('hidden')
                ) {

                    closeCancelEditModal();

                }

            }
        );

        /*
        |--------------------------------------------------------------------------
        | HILANGKAN ERROR SAAT USER MULAI MENGISI
        |--------------------------------------------------------------------------
        */


        contentTextarea?.addEventListener(
            'input',
            function () {

                if (
                    contentTextarea.value.trim()
                ) {

                    contentClientError?.classList.add(
                        'hidden'
                    );


                    contentTextarea.classList.remove(
                        'border-red-500',
                        'focus:border-red-500',
                        'focus:ring-red-500/30'
                    );

                }

            }
        );


        contentEditor?.addEventListener(
            'input',
            function () {

                if (
                    contentEditor.innerText.trim()
                ) {

                    contentClientError?.classList.add(
                        'hidden'
                    );


                    contentEditor.classList.remove(
                        'ring-2',
                        'ring-inset',
                        'ring-red-500'
                    );

                }

            }
        );



        /*
        |--------------------------------------------------------------------------
        | REGULASI
        |--------------------------------------------------------------------------
        */

        function hideAllRelationFields() {

            regulationRelationSection?.classList.add(
                'hidden'
            );

            repealsRelationField?.classList.add(
                'hidden'
            );

            repealedByRelationField?.classList.add(
                'hidden'
            );

            amendsRelationField?.classList.add(
                'hidden'
            );

            amendedByRelationField?.classList.add(
                'hidden'
            );
        }


        function toggleRegulationFields() {

            if (
                !typeSelect ||
                !regulationFields
            ) {
                return;
            }


            if (
                typeSelect.value ===
                'regulation'
            ) {

                regulationFields.classList.remove(
                    'hidden'
                );

            } else {

                regulationFields.classList.add(
                    'hidden'
                );

                hideAllRelationFields();
            }
        }


        function toggleRegulationRelation() {

            if (!legalStatusSelect) {
                return;
            }


            const status =
                legalStatusSelect.value;


            hideAllRelationFields();


            /*
            |--------------------------------------------------------------------------
            | Berlaku / Tidak Berlaku
            |--------------------------------------------------------------------------
            */

            if (
                status === '' ||
                status === 'berlaku' ||
                status === 'tidak_berlaku'
            ) {
                return;
            }


            /*
            |--------------------------------------------------------------------------
            | Mencabut
            |--------------------------------------------------------------------------
            */

            if (status === 'mencabut') {

                regulationRelationSection?.classList.remove(
                    'hidden'
                );

                repealsRelationField?.classList.remove(
                    'hidden'
                );


                if (relationDescription) {

                    relationDescription.textContent =
                        'Pilih regulasi yang dicabut atau digantikan oleh regulasi ini.';
                }


                return;
            }


            /*
            |--------------------------------------------------------------------------
            | Dicabut
            |--------------------------------------------------------------------------
            */

            if (status === 'dicabut') {

                regulationRelationSection?.classList.remove(
                    'hidden'
                );

                repealedByRelationField?.classList.remove(
                    'hidden'
                );


                if (relationDescription) {

                    relationDescription.textContent =
                        'Pilih regulasi yang mencabut regulasi ini.';
                }


                return;
            }


            /*
            |--------------------------------------------------------------------------
            | Mengubah
            |--------------------------------------------------------------------------
            */

            if (status === 'mengubah') {

                regulationRelationSection?.classList.remove(
                    'hidden'
                );

                amendsRelationField?.classList.remove(
                    'hidden'
                );


                if (relationDescription) {

                    relationDescription.textContent =
                        'Pilih regulasi yang diubah oleh regulasi ini.';
                }


                return;
            }


            /*
            |--------------------------------------------------------------------------
            | Diubah
            |--------------------------------------------------------------------------
            */

            if (status === 'diubah') {

                regulationRelationSection?.classList.remove(
                    'hidden'
                );

                amendedByRelationField?.classList.remove(
                    'hidden'
                );


                if (relationDescription) {

                    relationDescription.textContent =
                        'Pilih regulasi yang mengubah regulasi ini.';
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Filter hubungan regulasi berdasarkan jenis regulasi
        |--------------------------------------------------------------------------
        */

        function filterRelatedRegulations() {

            const regulationTypeId =
                document
                    .getElementById(
                        'regulation_type_id'
                    )
                    ?.value;


            const relationSelectIds = [

                'repeals_post_id',

                'repealed_by_post_id',

                'amends_post_id',

                'amended_by_post_id',

            ];


            relationSelectIds.forEach(
                function (selectId) {

                    const select =
                        document.getElementById(
                            selectId
                        );


                    if (!select) {
                        return;
                    }


                    Array
                        .from(select.options)
                        .forEach(
                            function (option) {

                                /*
                                * Placeholder selalu tampil.
                                */
                                if (!option.value) {

                                    option.hidden =
                                        false;

                                    return;
                                }


                                const relatedTypeId =
                                    option.dataset
                                        .regulationTypeId;


                                option.hidden =
                                    regulationTypeId &&
                                    relatedTypeId !==
                                        regulationTypeId;
                            }
                        );


                

                }
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Event regulasi
        |--------------------------------------------------------------------------
        */

        typeSelect?.addEventListener(
            'change',
            function () {

                toggleRegulationFields();


                if (
                    typeSelect.value ===
                    'regulation'
                ) {

                    toggleRegulationRelation();
                }

            }
        );


        legalStatusSelect?.addEventListener(
            'change',
            toggleRegulationRelation
        );


        document
            .getElementById(
                'regulation_type_id'
            )
            ?.addEventListener(
                'change',
                filterRelatedRegulations
            );


        /*
        |--------------------------------------------------------------------------
        | Inisialisasi awal
        |--------------------------------------------------------------------------
        */

        toggleRegulationFields();

        toggleRegulationRelation();

        filterRelatedRegulations();

    });
</script>