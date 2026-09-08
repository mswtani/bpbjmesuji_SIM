@php
    $isEdit = isset($carousel);

    $captionType = old(
        'caption_type',
        $carousel->caption_type ?? 'auto'
    );

    $showButton = old(
        'show_button',
        $carousel->show_button ?? true
    );

    $sortOrder = old(
        'sort_order',
        $carousel->sort_order ?? ($nextSortOrder ?? 1)
    );
@endphp


<div class="space-y-6">

    {{-- Konten --}}
    <div>
        <label
            for="post_id"
            class="mb-2 block text-sm font-medium text-gray-700"
        >
            Konten
            <span class="text-red-500">*</span>
        </label>

        <select
            id="post_id"
            name="post_id"
            required
            class="block w-full rounded-lg border-gray-300 bg-white
                   text-sm shadow-sm focus:border-blue-500
                   focus:ring-blue-500"
        >

            <option value="">
                -- Pilih Konten --
            </option>

            @foreach ($posts as $post)

                @php
                    $typeLabel = match ($post->type) {
                        'news' => 'Berita',
                        'announcement' => 'Pengumuman',
                        'regulation' => 'Regulasi',
                        default => ucfirst($post->type),
                    };
                @endphp

                <option
                    value="{{ $post->id }}"
                    @selected(old('post_id', $carousel->post_id ?? '') == $post->id)
                >
                    [{{ $typeLabel }}] {{ $post->title }}
                </option>

            @endforeach

        </select>

        @error('post_id')
            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror

        <p class="mt-1 text-xs text-gray-500">
            Pilih berita, pengumuman, atau regulasi yang sudah dipublikasikan.
        </p>
    </div>


    {{-- Banner --}}
    <div>

        <label
            for="banner"
            class="mb-2 block text-sm font-medium text-gray-700"
        >
            Banner Carousel
            @unless ($isEdit)
                <span class="text-red-500">*</span>
            @endunless
        </label>


        @if ($isEdit && $carousel->banner)

            <div class="mb-4 overflow-hidden rounded-xl border border-gray-200">

                <img
                    src="{{ asset('storage/' . $carousel->banner) }}"
                    alt="Banner saat ini"
                    class="aspect-[16/6] w-full object-cover"
                >

                <div class="border-t border-gray-100 bg-gray-50 px-3 py-2 text-xs text-gray-500">
                    Banner saat ini
                </div>

            </div>

        @endif


        <input
            type="file"
            id="banner"
            name="banner"
            accept="image/jpeg,image/png,image/webp"
            @unless ($isEdit) required @endunless
            class="block w-full cursor-pointer rounded-lg border border-gray-300
                   bg-white text-sm text-gray-700
                   file:mr-4 file:border-0 file:bg-gray-100
                   file:px-4 file:py-2.5 file:text-sm
                   file:font-medium file:text-gray-700
                   hover:file:bg-gray-200"
        >


        @error('banner')
            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror


        <p class="mt-1 text-xs text-gray-500">
            Rekomendasi 1600 × 600 px. Minimum 1200 × 450 px.
            Format JPG, JPEG, PNG, atau WebP. Maksimal 5 MB.
        </p>


        {{-- Preview banner baru --}}
        <div
            id="banner-preview-wrapper"
            class="mt-4 hidden overflow-hidden rounded-xl border border-gray-200"
        >
            <img
                id="banner-preview"
                src=""
                alt="Preview banner"
                class="aspect-[16/6] w-full object-cover"
            >

            <div class="border-t border-gray-100 bg-gray-50 px-3 py-2 text-xs text-gray-500">
                Preview banner baru
            </div>
        </div>

    </div>


    {{-- Caption --}}
<div class="rounded-xl border border-gray-200 p-4 sm:p-5">

    <div class="mb-4">
        <h3 class="text-sm font-semibold text-gray-800">
            Caption
        </h3>

        <p class="mt-1 text-xs text-gray-500">
            Tentukan informasi yang ditampilkan di atas banner.
        </p>
    </div>

    <div class="grid gap-3 sm:grid-cols-3">

        {{-- Otomatis --}}
        <label
            class="caption-option relative block cursor-pointer rounded-lg border border-gray-200 p-4 transition hover:border-blue-300 hover:bg-gray-50"
        >
            <input
                type="radio"
                name="caption_type"
                value="auto"
                class="caption-type-radio absolute left-4 top-4 h-4 w-4 accent-blue-600"
                @checked($captionType === 'auto')
            >

            <div class="pl-7">
                <div class="text-sm font-medium text-gray-800">
                    Otomatis
                </div>

                <div class="mt-1 text-xs leading-5 text-gray-500">
                    Menggunakan judul dan ringkasan konten.
                </div>
            </div>
        </label>


        {{-- Custom --}}
        <label
            class="caption-option relative block cursor-pointer rounded-lg border border-gray-200 p-4 transition hover:border-blue-300 hover:bg-gray-50"
        >
            <input
                type="radio"
                name="caption_type"
                value="custom"
                class="caption-type-radio absolute left-4 top-4 h-4 w-4 accent-blue-600"
                @checked($captionType === 'custom')
            >

            <div class="pl-7">
                <div class="text-sm font-medium text-gray-800">
                    Custom
                </div>

                <div class="mt-1 text-xs leading-5 text-gray-500">
                    Tentukan judul dan deskripsi sendiri.
                </div>
            </div>
        </label>


        {{-- Tanpa Caption --}}
        <label
            class="caption-option relative block cursor-pointer rounded-lg border border-gray-200 p-4 transition hover:border-blue-300 hover:bg-gray-50"
        >
            <input
                type="radio"
                name="caption_type"
                value="none"
                class="caption-type-radio absolute left-4 top-4 h-4 w-4 accent-blue-600"
                @checked($captionType === 'none')
            >

            <div class="pl-7">
                <div class="text-sm font-medium text-gray-800">
                    Tanpa Caption
                </div>

                <div class="mt-1 text-xs leading-5 text-gray-500">
                    Hanya menampilkan banner.
                </div>
            </div>
        </label>

    </div>

         {{-- Overlay --}}
        <div class="mt-5 border-t border-gray-100 pt-5">

            <label class="flex cursor-pointer items-start gap-3">

                <input
                    type="checkbox"
                    name="show_overlay"
                    value="1"
                    @checked(
                        old(
                            'show_overlay',
                            $carousel->show_overlay ?? false
                        )
                    )
                    class="mt-0.5 h-4 w-4 rounded border-gray-300
                        text-blue-600 focus:ring-blue-500"
                >

                <span>
                    <span class="block text-sm font-medium text-gray-800">
                        Gunakan Overlay Hitam
                    </span>

                    <span class="mt-1 block text-xs leading-5 text-gray-500">
                        Menambahkan lapisan hitam transparan agar caption
                        lebih mudah dibaca.
                    </span>
                </span>

            </label>

        </div>

        {{-- Custom Caption --}}
        <div
            id="custom-caption-fields"
            class="mt-5 hidden space-y-4 border-t border-gray-100 pt-5"
            >

            <div>

                <label
                    for="custom_title"
                    class="mb-2 block text-sm font-medium text-gray-700"
                >
                    Judul Custom
                </label>

                <input
                    type="text"
                    id="custom_title"
                    name="custom_title"
                    value="{{ old('custom_title', $carousel->custom_title ?? '') }}"
                    maxlength="255"
                    class="block w-full rounded-lg border-gray-300
                           text-sm shadow-sm focus:border-blue-500
                           focus:ring-blue-500"
                    placeholder="Masukkan judul yang akan ditampilkan"
                >

                @error('custom_title')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            <div>

                <label
                    for="custom_description"
                    class="mb-2 block text-sm font-medium text-gray-700"
                >
                    Deskripsi Custom
                </label>

                <textarea
                    id="custom_description"
                    name="custom_description"
                    rows="3"
                    class="block w-full rounded-lg border-gray-300
                           text-sm shadow-sm focus:border-blue-500
                           focus:ring-blue-500"
                    placeholder="Masukkan deskripsi singkat"
                >{{ old('custom_description', $carousel->custom_description ?? '') }}</textarea>

                @error('custom_description')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

        </div>

    </div>


    {{-- Tombol --}}
    <div class="rounded-xl border border-gray-200 p-4 sm:p-5">

        <div class="flex items-start justify-between gap-4">

            <div>

                <h3 class="text-sm font-semibold text-gray-800">
                    Tombol
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Tombol akan mengarah ke halaman konten yang dipilih.
                </p>

            </div>


            <label class="relative inline-flex cursor-pointer items-center">

                <input
                    type="checkbox"
                    id="show_button"
                    name="show_button"
                    value="1"
                    class="peer sr-only"
                    @checked($showButton)
                >

                <div
                    class="h-6 w-11 rounded-full bg-gray-200
                           after:absolute after:left-[2px] after:top-[2px]
                           after:h-5 after:w-5 after:rounded-full
                           after:border after:border-gray-300 after:bg-white
                           after:transition-all
                           peer-checked:bg-blue-600
                           peer-checked:after:translate-x-full
                           peer-checked:after:border-white"
                ></div>

            </label>

        </div>


        <div
            id="button-text-field"
            class="mt-4"
        >

            <label
                for="button_text"
                class="mb-2 block text-sm font-medium text-gray-700"
            >
                Teks Tombol
            </label>

            <input
                type="text"
                id="button_text"
                name="button_text"
                value="{{ old('button_text', $carousel->button_text ?? 'Baca Selengkapnya') }}"
                maxlength="100"
                class="block w-full rounded-lg border-gray-300
                       text-sm shadow-sm focus:border-blue-500
                       focus:ring-blue-500 sm:max-w-md"
                placeholder="Baca Selengkapnya"
            >

            @error('button_text')
                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror

        </div>

    </div>


    {{-- Pengaturan --}}
    <div class="grid gap-5 sm:grid-cols-2">

        <div>

            <label
                for="sort_order"
                class="mb-2 block text-sm font-medium text-gray-700"
            >
                Urutan
                <span class="text-red-500">*</span>
            </label>

            <input
                type="number"
                id="sort_order"
                name="sort_order"
                value="{{ $sortOrder }}"
                min="1"
                required
                class="block w-full rounded-lg border-gray-300
                       text-sm shadow-sm focus:border-blue-500
                       focus:ring-blue-500"
            >

            @error('sort_order')
                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror

            <p class="mt-1 text-xs text-gray-500">
                Semakin kecil angka, semakin awal ditampilkan.
            </p>

        </div>


        <div>

            <label
                for="is_active"
                class="mb-2 block text-sm font-medium text-gray-700"
            >
                Status
            </label>

            <label class="flex cursor-pointer items-center gap-3 rounded-lg border
                          border-gray-200 p-3">

                <input
                    type="checkbox"
                    id="is_active"
                    name="is_active"
                    value="1"
                    class="h-4 w-4 rounded border-gray-300 text-blue-600
                           focus:ring-blue-500"
                    @checked(old('is_active', $carousel->is_active ?? true))
                >

                <span>

                    <span class="block text-sm font-medium text-gray-700">
                        Aktifkan Carousel
                    </span>

                    <span class="block text-xs text-gray-500">
                        Carousel akan ditampilkan di halaman utama.
                    </span>

                </span>

            </label>

        </div>

    </div>


    {{-- Jadwal --}}
    <div class="rounded-xl border border-gray-200 p-4 sm:p-5">

        <div class="mb-4">

            <h3 class="text-sm font-semibold text-gray-800">
                Jadwal Tampil
                <span class="font-normal text-gray-400">(Opsional)</span>
            </h3>

            <p class="mt-1 text-xs text-gray-500">
                Kosongkan jika Carousel ingin aktif tanpa batas waktu.
            </p>

        </div>


        <div class="grid gap-5 sm:grid-cols-2">

            {{-- Mulai --}}
            <div>

                <label
                    for="starts_at"
                    class="mb-2 block text-sm font-medium text-gray-700"
                >
                    Mulai Tampil
                </label>

                <input
                    type="datetime-local"
                    id="starts_at"
                    name="starts_at"
                    value="{{ old('starts_at', isset($carousel) && $carousel->starts_at ? $carousel->starts_at->format('Y-m-d\TH:i') : '') }}"
                    class="block w-full rounded-lg border-gray-300
                        text-sm shadow-sm focus:border-blue-500
                        focus:ring-blue-500"
                >

                @error('starts_at')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Berakhir --}}
            <div>

                <label
                    for="ends_at"
                    class="mb-2 block text-sm font-medium text-gray-700"
                >
                    Berakhir Tampil
                </label>

                <input
                    type="datetime-local"
                    id="ends_at"
                    name="ends_at"
                    value="{{ old('ends_at', isset($carousel) && $carousel->ends_at ? $carousel->ends_at->format('Y-m-d\TH:i') : '') }}"
                    class="block w-full rounded-lg border-gray-300
                        text-sm shadow-sm focus:border-blue-500
                        focus:ring-blue-500"
                >

                @error('ends_at')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

        </div>


        {{-- Reset Jadwal --}}
        <div class="mt-4 flex justify-end">

            <button
                type="button"
                id="reset-carousel-schedule"
                class="inline-flex items-center gap-2 rounded-lg
                    border border-gray-300 bg-white px-3.5 py-2
                    text-sm font-medium text-gray-600
                    transition hover:border-red-200
                    hover:bg-red-50 hover:text-red-600"
            >

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
                        d="M3 12a9 9 0 0115.54-6.36L21 8m0 0V3m0 5h-5"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M21 12a9 9 0 01-15.54 6.36L3 16m0 0v5m0-5h5"
                    />
                </svg>

                Reset Jadwal

            </button>

        </div>

    </div>

</div>


@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const captionRadios = document.querySelectorAll('.caption-type-radio');
    const customCaptionFields = document.getElementById('custom-caption-fields');

    const showButton = document.getElementById('show_button');
    const buttonTextField = document.getElementById('button-text-field');
    const buttonText = document.getElementById('button_text');

    const bannerInput = document.getElementById('banner');
    const bannerPreviewWrapper = document.getElementById('banner-preview-wrapper');
    const bannerPreview = document.getElementById('banner-preview');


    /*
     * Caption
     */
    function updateCaptionFields() {
        const selected = document.querySelector(
            '.caption-type-radio:checked'
        );

        if (!selected) {
            return;
        }

        const isCustom = selected.value === 'custom';

        if (customCaptionFields) {
            customCaptionFields.classList.toggle(
                'hidden',
                !isCustom
            );
        }

        document.querySelectorAll('.caption-option').forEach(option => {
            const radio = option.querySelector(
                '.caption-type-radio'
            );

            if (!radio) {
                return;
            }

            option.classList.toggle(
                'border-blue-500',
                radio.checked
            );

            option.classList.toggle(
                'bg-blue-50',
                radio.checked
            );

            option.classList.toggle(
                'border-gray-200',
                !radio.checked
            );
        });
    }


    /*
     * Tombol
     */
    function updateButtonFields() {

        const enabled = showButton.checked;

        buttonTextField.classList.toggle(
            'hidden',
            !enabled
        );

        buttonText.disabled = !enabled;

    }


    /*
     * Preview banner
     */
    function updateBannerPreview() {

        const file = bannerInput.files[0];

        if (!file) {
            bannerPreviewWrapper.classList.add('hidden');
            bannerPreview.removeAttribute('src');
            return;
        }

        if (!file.type.startsWith('image/')) {
            bannerPreviewWrapper.classList.add('hidden');
            bannerPreview.removeAttribute('src');
            return;
        }

        const reader = new FileReader();

        reader.onload = function (event) {

            bannerPreview.src = event.target.result;

            bannerPreviewWrapper.classList.remove(
                'hidden'
            );

        };

        reader.readAsDataURL(file);

    }


    const startsAt = document.getElementById('starts_at');
    const endsAt = document.getElementById('ends_at');
    const resetScheduleButton = document.getElementById(
        'reset-carousel-schedule'
    );

    if (
        startsAt &&
        endsAt &&
        resetScheduleButton
    ) {
        resetScheduleButton.addEventListener(
            'click',
            function () {
                startsAt.value = '';
                endsAt.value = '';
            }
        );
    }


    captionRadios.forEach(radio => {

        radio.addEventListener(
            'change',
            updateCaptionFields
        );

    });


    showButton.addEventListener(
        'change',
        updateButtonFields
    );


    bannerInput.addEventListener(
        'change',
        updateBannerPreview
    );


    updateCaptionFields();
    updateButtonFields();

});
</script>

@endpush