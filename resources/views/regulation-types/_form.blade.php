<div class="space-y-6">

    {{-- =====================================================
         NAMA JENIS REGULASI
    ====================================================== --}}

    <div>

        <label
            for="name"
            class="block text-sm font-medium text-gray-700"
        >
            Nama Jenis Regulasi
            <span class="text-red-500">*</span>
        </label>

        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $regulationType?->name ?? '') }}"
            maxlength="100"
            required
            autocomplete="off"
            class="
                mt-1 block w-full
                rounded-lg
                border-gray-300
                bg-white
                shadow-sm
                focus:border-blue-500
                focus:ring-blue-500/30
            "
        >

        <p class="mt-1 text-xs text-gray-500">
            Contoh: Peraturan Bupati, Peraturan Daerah, atau Keputusan Bupati.
        </p>

        @error('name')

            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>

        @enderror

    </div>


    {{-- =====================================================
         DESKRIPSI
    ====================================================== --}}

    <div>

        <label
            for="description"
            class="block text-sm font-medium text-gray-700"
        >
            Deskripsi
        </label>

        <textarea
            id="description"
            name="description"
            rows="4"
            maxlength="1000"
            class="
                mt-1 block w-full
                rounded-lg
                border-gray-300
                bg-white
                shadow-sm
                focus:border-blue-500
                focus:ring-blue-500/30
            "
        >{{ old('description', $regulationType?->description ?? '') }}</textarea>

        <p class="mt-1 text-xs text-gray-500">
            Deskripsi singkat mengenai jenis regulasi ini.
        </p>

        @error('description')

            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>

        @enderror

    </div>


    {{-- =====================================================
         STATUS DAN URUTAN
    ====================================================== --}}

    <div class="grid gap-6 md:grid-cols-2">


        {{-- Status --}}

        <div>

            <label
                for="is_active"
                class="block text-sm font-medium text-gray-700"
            >
                Status
                <span class="text-red-500">*</span>
            </label>

            <select
                id="is_active"
                name="is_active"
                required
                class="
                    mt-1 block w-full
                    rounded-lg
                    border-gray-300
                    bg-white
                    shadow-sm
                    focus:border-blue-500
                    focus:ring-blue-500/30
                "
            >

                <option
                    value="1"
                    @selected(
                        old(
                            'is_active',
                            $regulationType?->is_active ?? true
                        ) == true
                    )
                >
                    Aktif
                </option>

                <option
                    value="0"
                    @selected(
                        old(
                            'is_active',
                            $regulationType?->is_active ?? true
                        ) == false
                    )
                >
                    Tidak Aktif
                </option>

            </select>

            <p class="mt-1 text-xs text-gray-500">
                Hanya jenis regulasi aktif yang dapat digunakan saat membuat konten.
            </p>

            @error('is_active')

                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>


        {{-- Urutan --}}

        <div>

            <label
                for="sort_order"
                class="block text-sm font-medium text-gray-700"
            >
                Urutan
                <span class="text-red-500">*</span>
            </label>

            @php
                $sortOrder = old(
                    'sort_order',
                    isset($regulationType)
                        ? $regulationType->sort_order
                        : ($nextSortOrder ?? '')
                );
            @endphp

            <input
                type="number"
                id="sort_order"
                name="sort_order"
                value="{{ $sortOrder }}"
                min="1"
                placeholder="Masukkan urutan"
                class="
                    mt-1
                    block
                    w-full
                    rounded-lg
                    border-gray-300
                    bg-white
                    shadow-sm
                    focus:border-blue-500
                    focus:ring-blue-500/30
                "
                >

            <p class="mt-1 text-xs text-gray-500">
                Tentukan posisi tampilan. Jika nomor urutan sudah digunakan,
                sistem akan mengonfirmasi sebelum menggeser urutan data lainnya.
            </p>

            @error('sort_order')

                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>

    </div>

</div>

{{-- Position Confirmation Modal --}}

<div
    id="position-confirmation-modal"
    class="
        fixed inset-0 z-50 hidden
        items-center justify-center
        bg-gray-900/50
        px-4
        backdrop-blur-sm
    "
>

    <div
        class="
            w-full
            max-w-lg
            overflow-hidden
            rounded-2xl
            bg-white
            shadow-2xl
        "
        role="dialog"
        aria-modal="true"
        aria-labelledby="position-confirmation-title"
    >

        {{-- Content --}}

        <div
            class="
                px-6
                py-7
                text-center
                sm:px-8
            "
        >

            {{-- Icon --}}

            <div
                class="
                    mx-auto
                    flex h-14 w-14
                    items-center justify-center
                    rounded-2xl
                    bg-amber-50
                    text-amber-600
                "
            >

                <svg
                    class="h-7 w-7"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z"
                    />
                </svg>

            </div>


            {{-- Title --}}

            <h3
                id="position-confirmation-title"
                class="
                    mt-5
                    text-xl
                    font-semibold
                    text-gray-900
                "
            >
                Urutan sudah digunakan
            </h3>


            {{-- Description --}}

            <p
                class="
                    mx-auto
                    mt-3
                    max-w-md
                    text-sm
                    leading-6
                    text-gray-600
                "
            >

                Nomor urutan

                <span
                    id="modal-sort-order"
                    class="font-semibold text-gray-900"
                ></span>

                saat ini sudah digunakan oleh jenis regulasi:

            </p>


            {{-- Existing Regulation --}}

            <div
                class="
                    mx-auto
                    mt-4
                    max-w-md
                    rounded-xl
                    border
                    border-amber-200
                    bg-amber-50
                    px-4
                    py-3
                "
            >

                <p
                    id="modal-regulation-type-name"
                    class="
                        text-sm
                        font-semibold
                        text-amber-900
                    "
                ></p>

            </div>


            {{-- Information --}}

            <p
                class="
                    mx-auto
                    mt-5
                    max-w-md
                    text-sm
                    leading-6
                    text-gray-600
                "
            >

                Jika Anda melanjutkan, jenis regulasi tersebut dan
                data setelahnya akan otomatis bergeser satu posisi.

            </p>

        </div>


        {{-- Action --}}

        <div
            class="
                flex
                flex-col-reverse
                gap-3
                border-t
                border-gray-100
                bg-gray-50
                px-6
                py-4
                sm:flex-row
                sm:items-center
                sm:justify-center
                sm:px-8
            "
        >

            <button
                type="button"
                id="cancel-position-confirmation"
                class="
                    inline-flex
                    items-center
                    justify-center
                    rounded-lg
                    border
                    border-gray-300
                    bg-white
                    px-5
                    py-2.5
                    text-sm
                    font-medium
                    text-gray-700
                    shadow-sm
                    transition
                    hover:bg-gray-50
                    hover:text-gray-900
                    focus:outline-none
                    focus:ring-2
                    focus:ring-gray-500/20
                "
            >
                Periksa Kembali
            </button>


            <button
                type="button"
                id="confirm-position-change"
                class="
                    inline-flex
                    items-center
                    justify-center
                    gap-2
                    rounded-lg
                    bg-amber-500
                    px-5
                    py-2.5
                    text-sm
                    font-semibold
                    text-white
                    shadow-sm
                    transition
                    hover:bg-amber-600
                    focus:outline-none
                    focus:ring-2
                    focus:ring-amber-500/30
                "
            >

                <svg
                    class="h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m5 12.5 4.5 4.5L19 7.5"
                    />
                </svg>

                Ya, Lanjutkan

            </button>

        </div>

    </div>

</div>


{{-- =====================================================
     MODAL KONFIRMASI URUTAN
===================================================== --}}

<div
    id="sort-order-confirmation-modal"
    class="
        fixed inset-0 z-50
        hidden
        items-center justify-center
        bg-gray-900/50
        px-4
        backdrop-blur-sm
    "
>

    <div
        class="
            w-full max-w-md
            overflow-hidden
            rounded-2xl
            bg-white
            shadow-2xl
        "
        role="dialog"
        aria-modal="true"
        aria-labelledby="sort-order-modal-title"
    >

        {{-- Header --}}
        <div class="flex justify-center px-6 pt-7">

            <div
                class="
                    flex h-12 w-12
                    items-center justify-center
                    rounded-full
                    bg-amber-50
                    text-amber-600
                "
            >

                <svg
                    class="h-6 w-6"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 9v4m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3Z"
                    />
                </svg>

            </div>

        </div>


        {{-- Content --}}
        <div class="px-6 py-5 text-center">

            <h3
                id="sort-order-modal-title"
                class="
                    text-center
                    text-lg
                    font-semibold
                    text-gray-900
                "
            >
                Urutan tidak tersedia
            </h3>


            <p
                id="sort-order-modal-message"
                class="
                    mx-auto
                    mt-3
                    max-w-md
                    text-center
                    text-sm
                    leading-6
                    text-gray-600
                "
            >
                {{-- Diisi JavaScript --}}
            </p>

        </div>


        {{-- Actions --}}
        <div
            class="
                flex
                flex-col-reverse
                gap-3
                border-t
                border-gray-100
                bg-gray-50
                px-6
                py-4
                sm:flex-row
                sm:items-center
                sm:justify-center
                sm:px-8
            "
        >

            <button
                type="button"
                id="cancel-sort-order-confirmation"
                class="
                    inline-flex
                    w-full
                    items-center
                    justify-center
                    rounded-lg
                    border border-gray-300
                    bg-white
                    px-4 py-2.5
                    text-sm font-medium
                    text-gray-700
                    transition
                    hover:bg-gray-50
                    sm:w-auto
                "
            >
                Batal
            </button>


            <button
                type="button"
                id="confirm-sort-order-submit"
                class="
                    inline-flex
                    w-full
                    items-center
                    justify-center
                    gap-2
                    rounded-lg
                    bg-blue-600
                    px-4 py-2.5
                    text-sm font-semibold
                    text-white
                    shadow-sm
                    transition
                    hover:bg-blue-700
                    focus:outline-none
                    focus:ring-2
                    focus:ring-blue-500/30
                    sm:w-auto
                "
            >
                Setuju & Simpan
            </button>

        </div>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        /*
        |--------------------------------------------------------------------------
        | FORM
        |--------------------------------------------------------------------------
        */

        const form = document.getElementById(
            'regulation-type-form'
        );

        const sortOrderInput = document.getElementById(
            'sort_order'
        );

        if (! form || ! sortOrderInput) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | MODAL 1
        | Urutan sudah digunakan
        |--------------------------------------------------------------------------
        */

        const positionModal = document.getElementById(
            'position-confirmation-modal'
        );

        const modalSortOrder = document.getElementById(
            'modal-sort-order'
        );

        const modalRegulationTypeName = document.getElementById(
            'modal-regulation-type-name'
        );

        const cancelPositionButton = document.getElementById(
            'cancel-position-confirmation'
        );

        const confirmPositionButton = document.getElementById(
            'confirm-position-change'
        );


        /*
        |--------------------------------------------------------------------------
        | MODAL 2
        | Urutan melebihi batas tersedia
        |--------------------------------------------------------------------------
        */

        const sortOrderModal = document.getElementById(
            'sort-order-confirmation-modal'
        );

        const sortOrderModalMessage = document.getElementById(
            'sort-order-modal-message'
        );

        const cancelSortOrderButton = document.getElementById(
            'cancel-sort-order-confirmation'
        );

        const confirmSortOrderButton = document.getElementById(
            'confirm-sort-order-submit'
        );


        /*
        |--------------------------------------------------------------------------
        | STATE
        |--------------------------------------------------------------------------
        */

        let allowSubmit = false;

        let finalPosition = null;


        /*
        |--------------------------------------------------------------------------
        | HELPER
        |--------------------------------------------------------------------------
        */

        function openModal(modal) {

            modal.classList.remove('hidden');

            modal.classList.add('flex');

            document.body.classList.add(
                'overflow-hidden'
            );
        }


        function closeModal(modal) {

            modal.classList.add('hidden');

            modal.classList.remove('flex');

            document.body.classList.remove(
                'overflow-hidden'
            );
        }


        function submitForm() {

            allowSubmit = true;

            form.submit();
        }


        /*
        |--------------------------------------------------------------------------
        | FORM SUBMIT
        |--------------------------------------------------------------------------
        */

        form.addEventListener(
            'submit',
            async function (event) {

                if (allowSubmit) {
                    return;
                }

                event.preventDefault();


                const sortOrder = sortOrderInput.value;


                /*
                |--------------------------------------------------------------------------
                | Jika urutan dikosongkan
                |--------------------------------------------------------------------------
                |
                | Biarkan backend menentukan urutan otomatis.
                |
                */

                if (! sortOrder) {

                    submitForm();

                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | Endpoint pengecekan
                |--------------------------------------------------------------------------
                */

                const checkUrl =
                    form.dataset.checkPositionUrl;

                const ignoreId =
                    form.dataset.ignoreId;


                try {

                    const url = new URL(
                        checkUrl,
                        window.location.origin
                    );


                    url.searchParams.set(
                        'sort_order',
                        sortOrder
                    );


                    if (ignoreId) {

                        url.searchParams.set(
                            'ignore_id',
                            ignoreId
                        );

                    }


                    const response = await fetch(
                        url.toString(),
                        {
                            headers: {
                                'Accept': 'application/json',
                            },
                        }
                    );


                    if (! response.ok) {

                        throw new Error(
                            'Gagal memeriksa nomor urutan.'
                        );
                    }


                    const data =
                        await response.json();


                    /*
                    |--------------------------------------------------------------------------
                    | KONDISI 1
                    | Input melebihi posisi tersedia
                    |--------------------------------------------------------------------------
                    */

                    if (data.is_out_of_range) {

                        finalPosition =
                            data.final_position;


                        sortOrderModalMessage.textContent =
                            `Urutan yang tersedia saat ini adalah `
                            + `${data.max_position}. `
                            + `Anda memasukkan urutan `
                            + `${data.requested_position}. `
                            + `Data akan ditempatkan pada urutan `
                            + `${data.final_position}. `
                            + `Apakah Anda ingin melanjutkan?`;


                        openModal(
                            sortOrderModal
                        );

                        return;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | KONDISI 2
                    | Urutan sudah digunakan
                    |--------------------------------------------------------------------------
                    */

                    if (data.exists) {

                        modalSortOrder.textContent =
                            data.sort_order;


                        modalRegulationTypeName.textContent =
                            data.regulation_type.name;


                        openModal(
                            positionModal
                        );

                        return;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | KONDISI 3
                    | Urutan normal
                    |--------------------------------------------------------------------------
                    */

                    submitForm();

                } catch (error) {

                    /*
                    |--------------------------------------------------------------------------
                    | Jika pengecekan gagal
                    |--------------------------------------------------------------------------
                    |
                    | Jangan menghalangi proses simpan.
                    | Backend tetap menjadi sumber kebenaran.
                    |
                    */

                    submitForm();

                }

            }
        );


        /*
        |--------------------------------------------------------------------------
        | MODAL 1
        | Urutan sudah digunakan
        |--------------------------------------------------------------------------
        */

        cancelPositionButton.addEventListener(
            'click',
            function () {

                closeModal(
                    positionModal
                );

            }
        );


        confirmPositionButton.addEventListener(
            'click',
            function () {

                closeModal(
                    positionModal
                );

                submitForm();

            }
        );


        /*
        |--------------------------------------------------------------------------
        | MODAL 2
        | Urutan melebihi batas
        |--------------------------------------------------------------------------
        */

        cancelSortOrderButton.addEventListener(
            'click',
            function () {

                finalPosition = null;

                closeModal(
                    sortOrderModal
                );

            }
        );


        confirmSortOrderButton.addEventListener(
            'click',
            function () {

                if (finalPosition !== null) {

                    sortOrderInput.value =
                        finalPosition;

                }


                closeModal(
                    sortOrderModal
                );

                submitForm();

            }
        );


        /*
        |--------------------------------------------------------------------------
        | BACKDROP
        |--------------------------------------------------------------------------
        */

        positionModal.addEventListener(
            'click',
            function (event) {

                if (event.target === positionModal) {

                    closeModal(
                        positionModal
                    );

                }

            }
        );


        sortOrderModal.addEventListener(
            'click',
            function (event) {

                if (event.target === sortOrderModal) {

                    finalPosition = null;

                    closeModal(
                        sortOrderModal
                    );

                }

            }
        );


        /*
        |--------------------------------------------------------------------------
        | ESCAPE
        |--------------------------------------------------------------------------
        */

        document.addEventListener(
            'keydown',
            function (event) {

                if (event.key !== 'Escape') {
                    return;
                }


                if (
                    ! positionModal.classList.contains(
                        'hidden'
                    )
                ) {

                    closeModal(
                        positionModal
                    );
                }


                if (
                    ! sortOrderModal.classList.contains(
                        'hidden'
                    )
                ) {

                    finalPosition = null;

                    closeModal(
                        sortOrderModal
                    );
                }

            }
        );

    });
</script>