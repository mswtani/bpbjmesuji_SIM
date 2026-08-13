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
@endphp


<form
    method="POST"
    action="{{ $formAction }}"
    enctype="multipart/form-data"
    class="space-y-6"
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
            id="type"
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
        class="{{ $selectedType === 'regulation' ? '' : 'hidden' }}"
    >

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
                        Tanggal Regulasi
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
                    accept="application/pdf,.pdf"
                    class="mt-1 block w-full text-sm text-gray-700
                        file:mr-4 file:rounded-md file:border-0
                        file:bg-white file:px-4 file:py-2
                        file:text-sm file:font-medium
                        hover:file:bg-gray-100"
                >

                <p class="mt-1 text-xs text-gray-500">
                    Format PDF. Maksimal 10 MB.
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
        class="{{ in_array($selectedLegalStatus, ['mencabut', 'dicabut', 'mengubah', 'diubah'], true) ? '' : 'hidden' }}"
    >

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
                class="{{ $selectedLegalStatus === 'mencabut' ? '' : 'hidden' }}"
            >

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
                class="{{ $selectedLegalStatus === 'dicabut' ? '' : 'hidden' }}"
            >

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
                class="{{ $selectedLegalStatus === 'mengubah' ? '' : 'hidden' }}"
            >

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
                            @selected(
                                old(
                                    'amends_post_id',
                                    $post?->amendments?->first()?->related_post_id
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
                class="{{ $selectedLegalStatus === 'diubah' ? '' : 'hidden' }}"
            >

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
            maxlength="255"
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
    ========================================================== --}}

    <div>

        <label
            for="excerpt"
            class="block text-sm font-medium text-gray-700"
        >
            Ringkasan
            <span class="font-normal text-gray-500">
                (opsional)
            </span>
        </label>

        <textarea
            id="excerpt"
            name="excerpt"
            rows="4"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            placeholder="Tuliskan ringkasan singkat konten"
        >{{ old('excerpt', $post?->excerpt) }}</textarea>

        @error('excerpt')

            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>

        @enderror

    </div>


    {{-- =========================================================
        ISI KONTEN
    ========================================================== --}}

    <div>

        <label
            for="content"
            class="block text-sm font-medium text-gray-700"
        >
            Isi Konten
        </label>

        <textarea
            id="content"
            name="content"
            rows="12"
            required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            placeholder="Tuliskan isi konten di sini..."
        >{{ old('content', $post?->content) }}</textarea>

        @error('content')

            <p class="mt-1 text-sm text-red-600">
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


    {{-- =========================================================
        TOMBOL
    ========================================================== --}}

    <div class="flex items-center gap-3 border-t border-gray-200 pt-6">

        <button
            type="submit"
            class="inline-flex items-center rounded-md bg-indigo-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
            {{ $submitLabel }}
        </button>

        <a
            href="{{ route('posts.index') }}"
            class="inline-flex items-center rounded-md border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50"
        >
            Batal
        </a>

    </div>


</form>


{{-- =========================================================
    JAVASCRIPT
========================================================== --}}

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const typeSelect = document.getElementById('type');
        const regulationFields = document.getElementById('regulation-fields');
        const legalStatusSelect = document.getElementById('legal_status');

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


        function hideAllRelationFields() {

            regulationRelationSection?.classList.add('hidden');
            repealsRelationField?.classList.add('hidden');
            repealedByRelationField?.classList.add('hidden');
            amendsRelationField?.classList.add('hidden');
            amendedByRelationField?.classList.add('hidden');

        }


        function toggleRegulationFields() {

            if (!typeSelect || !regulationFields) {
                return;
            }

            if (typeSelect.value === 'regulation') {

                regulationFields.classList.remove('hidden');

            } else {

                regulationFields.classList.add('hidden');

                hideAllRelationFields();
            }
        }


        function toggleRegulationRelation() {

            if (!legalStatusSelect) {
                return;
            }

            const status = legalStatusSelect.value;

            hideAllRelationFields();


            // Berlaku / Tidak Berlaku
            if (
                status === '' ||
                status === 'berlaku' ||
                status === 'tidak_berlaku'
            ) {
                return;
            }


            // Mencabut
            if (status === 'mencabut') {

                regulationRelationSection?.classList.remove('hidden');
                repealsRelationField?.classList.remove('hidden');

                if (relationDescription) {
                    relationDescription.textContent =
                        'Pilih regulasi yang dicabut atau digantikan oleh regulasi ini.';
                }

                return;
            }


            // Dicabut
            if (status === 'dicabut') {

                regulationRelationSection?.classList.remove('hidden');
                repealedByRelationField?.classList.remove('hidden');

                if (relationDescription) {
                    relationDescription.textContent =
                        'Pilih regulasi yang mencabut regulasi ini.';
                }

                return;
            }


            // Mengubah
            if (status === 'mengubah') {

                regulationRelationSection?.classList.remove('hidden');
                amendsRelationField?.classList.remove('hidden');

                if (relationDescription) {
                    relationDescription.textContent =
                        'Pilih regulasi yang diubah oleh regulasi ini.';
                }

                return;
            }


            // Diubah
            if (status === 'diubah') {

                regulationRelationSection?.classList.remove('hidden');
                amendedByRelationField?.classList.remove('hidden');

                if (relationDescription) {
                    relationDescription.textContent =
                        'Pilih regulasi yang mengubah regulasi ini.';
                }
            }
        }


        typeSelect?.addEventListener('change', function () {

            toggleRegulationFields();

            if (typeSelect.value === 'regulation') {
                toggleRegulationRelation();
            }

        });


        legalStatusSelect?.addEventListener(
            'change',
            toggleRegulationRelation
        );


        toggleRegulationFields();
        toggleRegulationRelation();

    });

</script>