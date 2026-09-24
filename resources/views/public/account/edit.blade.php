@extends('layouts.public')

@section('title', 'Setting Akun')

@section('content')

<style>
    /*
    |--------------------------------------------------------------------------
    | PUBLIC ACCOUNT PAGE
    |--------------------------------------------------------------------------
    */

    .public-account-wrapper {
        background: #f5f7fa;
        min-height: 100%;
        padding: 40px 20px 60px;
    }

    .public-account-container {
        width: 100%;
        max-width: 960px;
        margin: 0 auto;
    }

    .public-account-header {
        margin-bottom: 28px;
    }

    .public-account-header h1 {
        margin: 0;
        color: #0b2f64;
        font-size: 32px;
        font-weight: 700;
        line-height: 1.25;
    }

    .public-account-header p {
        margin: 8px 0 0;
        color: #667085;
        font-size: 15px;
        line-height: 1.6;
    }

    .public-account-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(15, 23, 42, 0.05);
        margin-bottom: 24px;
        overflow: hidden;
    }

    .public-account-card-header {
        padding: 22px 26px;
        border-bottom: 1px solid #edf0f3;
    }

    .public-account-card-header h2 {
        margin: 0;
        color: #0b2f64;
        font-size: 21px;
        font-weight: 700;
        line-height: 1.4;
    }

    .public-account-card-header p {
        margin: 5px 0 0;
        color: #667085;
        font-size: 14px;
        line-height: 1.5;
    }

    .public-account-card-body {
        padding: 26px;
    }

    /*
    |--------------------------------------------------------------------------
    | AVATAR
    |--------------------------------------------------------------------------
    */

    .public-account-avatar-section {
        display: flex;
        align-items: center;
        gap: 22px;
        padding: 18px;
        margin-bottom: 24px;
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
    }

    .public-account-avatar {
        width: 96px;
        height: 96px;
        flex: 0 0 96px;
        overflow: hidden;
        border: 3px solid #d4af37;
        border-radius: 50%;
        background: #eaf2ff;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0b2f64;
        font-size: 30px;
        font-weight: 700;
    }

    .public-account-avatar img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .public-account-avatar-info {
        min-width: 0;
        flex: 1;
    }

    .public-account-avatar-title {
        margin: 0 0 6px;
        color: #1f2937;
        font-size: 15px;
        font-weight: 600;
    }

    .public-account-avatar-description {
        margin: 0 0 12px;
        color: #667085;
        font-size: 13px;
        line-height: 1.5;
    }

    .public-account-file {
        display: block;
        width: 100%;
        max-width: 420px;
        color: #475467;
        font-size: 14px;
    }

    .public-account-file::file-selector-button {
        margin-right: 12px;
        padding: 8px 14px;
        border: 1px solid #d0d5dd;
        border-radius: 7px;
        background: #ffffff;
        color: #344054;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
    }

    .public-account-file::file-selector-button:hover {
        background: #f9fafb;
    }

    .public-account-remove {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 12px;
        color: #b42318;
        font-size: 13px;
        cursor: pointer;
    }

    .public-account-remove input {
        width: 16px;
        height: 16px;
        margin: 0;
        accent-color: #b42318;
    }

    /*
    |--------------------------------------------------------------------------
    | FORM
    |--------------------------------------------------------------------------
    */

    .public-account-form-group {
        margin-bottom: 20px;
    }

    .public-account-form-group:last-child {
        margin-bottom: 0;
    }

    .public-account-label {
        display: block;
        margin-bottom: 7px;
        color: #344054;
        font-size: 14px;
        font-weight: 600;
    }

    .public-account-input {
        display: block;
        width: 100%;
        box-sizing: border-box;
        padding: 10px 12px;
        border: 1px solid #d0d5dd;
        border-radius: 8px;
        background: #ffffff;
        color: #1d2939;
        font-family: inherit;
        font-size: 14px;
        line-height: 1.5;
        outline: none;
        transition:
            border-color 0.2s ease,
            box-shadow 0.2s ease;
    }

    .public-account-input:focus {
        border-color: #0b2f64;
        box-shadow: 0 0 0 3px rgba(11, 47, 100, 0.10);
    }

    .public-account-error {
        margin-top: 6px;
        color: #b42318;
        font-size: 13px;
        line-height: 1.5;
    }

    /*
    |--------------------------------------------------------------------------
    | ACTIONS
    |--------------------------------------------------------------------------
    */

    .public-account-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: 26px;
        padding-top: 20px;
        border-top: 1px solid #edf0f3;
    }

    .public-account-back {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 42px;
        padding: 9px 17px;
        border: 1px solid #d0d5dd;
        border-radius: 8px;
        background: #ffffff;
        color: #344054;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition:
            background 0.2s ease,
            border-color 0.2s ease;
    }

    .public-account-back:hover {
        background: #f9fafb;
        border-color: #b8bec8;
    }

    .public-account-save {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 42px;
        padding: 9px 18px;
        border: 1px solid #0b2f64;
        border-radius: 8px;
        background: #0b2f64;
        color: #ffffff;
        font-family: inherit;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition:
            background 0.2s ease,
            border-color 0.2s ease;
    }

    .public-account-save:hover {
        background: #08264f;
        border-color: #08264f;
    }

    .public-account-status {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-top: 16px;
        padding: 9px 12px;
        border: 1px solid #abefc6;
        border-radius: 7px;
        background: #ecfdf3;
        color: #067647;
        font-size: 13px;
    }

    /*
    |--------------------------------------------------------------------------
    | PASSWORD
    |--------------------------------------------------------------------------
    */

    .public-account-password-box {
        padding: 18px;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        background: #f8fafc;
    }

    .public-account-password-box p {
        margin: 0;
        color: #667085;
        font-size: 14px;
        line-height: 1.6;
    }

    .public-account-password-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-top: 15px;
        min-height: 40px;
        padding: 8px 15px;
        border: 1px solid #d4af37;
        border-radius: 8px;
        background: #fffdf4;
        color: #8a6d16;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition:
            background 0.2s ease,
            border-color 0.2s ease;
    }

    .public-account-password-link:hover {
        background: #fff8d9;
        border-color: #c29f2f;
    }

    /* =========================================================
    SUCCESS MODAL
    ========================================================= */

    .public-account-modal {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .public-account-modal-backdrop {
        position: absolute;
        inset: 0;
        background: rgba(15, 23, 42, 0.48);
        backdrop-filter: blur(2px);
    }

    .public-account-modal-dialog {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 420px;
        padding: 30px 26px 26px;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        background: #ffffff;
        box-shadow: 0 20px 50px rgba(15, 23, 42, 0.18);
        text-align: center;
    }

    .public-account-modal-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 58px;
        height: 58px;
        margin: 0 auto 18px;
        border: 1px solid #abefc6;
        border-radius: 50%;
        background: #ecfdf3;
        color: #067647;
    }

    .public-account-modal-title {
        margin: 0;
        color: #1f2937;
        font-size: 20px;
        font-weight: 700;
        line-height: 1.4;
    }

    .public-account-modal-description {
        margin: 9px 0 0;
        color: #667085;
        font-size: 14px;
        line-height: 1.6;
    }

    .public-account-modal-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 110px;
        min-height: 42px;
        margin-top: 22px;
        padding: 9px 18px;
        border: 1px solid #0b2f64;
        border-radius: 8px;
        background: #0b2f64;
        color: #ffffff;
        font-family: inherit;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition:
            background 0.2s ease,
            border-color 0.2s ease;
    }

    .public-account-modal-button:hover {
        background: #08264f;
        border-color: #08264f;
    }

    body.public-account-modal-open {
        overflow: hidden;
    }

    /*
    |--------------------------------------------------------------------------
    | RESPONSIVE
    |--------------------------------------------------------------------------
    */

    @media (max-width: 640px) {

        .public-account-wrapper {
            padding: 28px 14px 40px;
        }

        .public-account-header h1 {
            font-size: 27px;
        }

        .public-account-card-header {
            padding: 18px;
        }

        .public-account-card-body {
            padding: 18px;
        }

        .public-account-avatar-section {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
        }

        .public-account-avatar {
            width: 88px;
            height: 88px;
            flex-basis: 88px;
        }

        .public-account-file {
            max-width: none;
        }

        .public-account-actions {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .public-account-back,
        .public-account-save {
            width: 100%;
        }

        .public-account-password-link {
            display: flex;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
        }
    }

        /* =========================================================
       AVATAR IMAGE MODAL
    ========================================================= */

    .public-account-avatar {
        cursor: pointer;
    }

    .public-account-avatar-modal {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px;
        background: rgba(0, 0, 0, 0.75);
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transition:
            opacity 0.2s ease,
            visibility 0.2s ease;
    }

    .public-account-avatar-modal.is-open {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }

    .public-account-avatar-modal-image {
        display: block;
        max-width: min(90vw, 600px);
        max-height: 85vh;
        width: auto;
        height: auto;
        object-fit: contain;
        border: 3px solid #ffffff;
        border-radius: 12px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
    }

    .public-account-avatar-modal-close {
        position: absolute;
        top: 20px;
        right: 25px;
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        border: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.15);
        color: #ffffff;
        font-size: 28px;
        line-height: 1;
        cursor: pointer;
    }

    .public-account-avatar-modal-close:hover {
        background: rgba(255, 255, 255, 0.25);
    }

    body.public-account-avatar-modal-open {
        overflow: hidden;
    }

    @media (max-width: 767.98px) {

        .public-account-avatar-modal {
            padding: 20px;
        }

        .public-account-avatar-modal-image {
            max-width: 92vw;
            max-height: 75vh;
        }

        .public-account-avatar-modal-close {
            top: 15px;
            right: 15px;
            width: 38px;
            height: 38px;
            font-size: 24px;
        }
    }

</style>


<div class="public-account-wrapper">

    <div class="public-account-container">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="public-account-header">

            <h1>
                Setting Akun
            </h1>

            <p>
                Kelola informasi akun dan foto profil Anda.
            </p>

        </div>


        {{-- =====================================================
             INFORMASI AKUN
        ====================================================== --}}

        <div class="public-account-card">

            <div class="public-account-card-header">

                <h2>
                    Informasi Akun
                </h2>

                <p>
                    Perbarui nama, email, dan foto profil Anda.
                </p>

            </div>


            <div class="public-account-card-body">

                <form
                    method="POST"
                    action="{{ route('public.account.update') }}"
                    enctype="multipart/form-data"
                >

                    @csrf
                    @method('PATCH')


                    {{-- =================================================
                         FOTO PROFIL
                    ================================================== --}}

                    <div class="public-account-avatar-section">

                        <div class="public-account-avatar">

                            @if ($user->avatar)

                                <img
                                    id="public-account-avatar-preview"
                                    src="{{ asset('storage/' . $user->avatar) }}"
                                    alt="Foto {{ $user->name }}"
                                >

                            @else

                                <span
                                    id="public-account-avatar-placeholder"
                                >
                                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                                </span>

                            @endif

                        </div>


                        <div class="public-account-avatar-info">

                            <p class="public-account-avatar-title">
                                Foto Profil
                            </p>

                            <p class="public-account-avatar-description">
                                Gunakan foto JPG, JPEG, PNG, atau WEBP.
                                Maksimal 2 MB.
                            </p>


                            <input
                                id="avatar"
                                name="avatar"
                                type="file"
                                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                class="public-account-file"
                            >


                            @if ($user->avatar)

                                <label class="public-account-remove">

                                    <input
                                        type="checkbox"
                                        name="remove_avatar"
                                        value="1"
                                    >

                                    <span>
                                        Hapus foto profil
                                    </span>

                                </label>

                            @endif


                            @error('avatar')

                                <div class="public-account-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>


                    {{-- =================================================
                         NAMA
                    ================================================== --}}

                    <div class="public-account-form-group">

                        <label
                            for="name"
                            class="public-account-label"
                        >
                            Nama
                        </label>

                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name', $user->name) }}"
                            required
                            maxlength="255"
                            autocomplete="name"
                            class="public-account-input"
                        >

                        @error('name')

                            <div class="public-account-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- =================================================
                         EMAIL
                    ================================================== --}}

                    <div class="public-account-form-group">

                        <label
                            for="email"
                            class="public-account-label"
                        >
                            Email
                        </label>

                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email', $user->email) }}"
                            required
                            maxlength="255"
                            autocomplete="email"
                            class="public-account-input"
                        >

                        @error('email')

                            <div class="public-account-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- =================================================
                         ACTIONS
                    ================================================== --}}

                    <div class="public-account-actions">

                        <a
                            href="{{ url('/') }}"
                            class="public-account-back"
                        >
                            <svg
                                width="17"
                                height="17"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 18l-6-6 6-6"
                                />
                            </svg>

                            <span>
                                Kembali
                            </span>
                        </a>


                        <button
                            type="submit"
                            class="public-account-save"
                        >
                            <svg
                                width="17"
                                height="17"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M5 12.5L9.5 17 19 7.5"
                                />
                            </svg>

                            <span>
                                Simpan Perubahan
                            </span>
                        </button>

                    </div>
                    
                </form>

                  @if (session('status') === 'account-updated')

                    <div
                        id="public-account-success-modal"
                        class="public-account-modal"
                        role="dialog"
                        aria-modal="true"
                        aria-labelledby="public-account-success-title"
                        >

                        <div
                            class="public-account-modal-backdrop"
                            data-public-account-modal-close
                        ></div>


                        <div class="public-account-modal-dialog">

                            <div class="public-account-modal-icon">
                                <svg
                                    width="30"
                                    height="30"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    aria-hidden="true"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M5 12.5L9.5 17 19 7.5"
                                    />
                                </svg>
                            </div>


                            <h2
                                id="public-account-success-title"
                                class="public-account-modal-title"
                            >
                                Perubahan Berhasil Disimpan
                            </h2>


                            <p class="public-account-modal-description">
                                Perubahan informasi akun Anda telah berhasil disimpan.
                            </p>


                            <button
                                type="button"
                                class="public-account-modal-button"
                                data-public-account-modal-close
                            >
                                Mengerti
                            </button>

                        </div>

                    </div>

                @endif

            </div>

        </div>


        {{-- =====================================================
             KEAMANAN AKUN
        ====================================================== --}}

        <div class="public-account-card">

            <div class="public-account-card-header">

                <h2>
                    Keamanan Akun
                </h2>

                <p>
                    Kelola password akun Anda.
                </p>

            </div>


            <div class="public-account-card-body">

                <div class="public-account-password-box">

                    <p>
                        Untuk mengubah password, gunakan menu
                        <strong>Ubah Password</strong>.
                    </p>


                    <a
                        href="{{ route('password.change') }}"
                        class="public-account-password-link"
                    >
                        Ubah Password
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- =============================================================
     AVATAR IMAGE MODAL
============================================================= --}}

<div
    class="public-account-avatar-modal"
    id="publicAccountAvatarModal"
    aria-hidden="true"
>
    <button
        type="button"
        class="public-account-avatar-modal-close"
        id="publicAccountAvatarModalClose"
        aria-label="Tutup foto profil"
    >
        &times;
    </button>

    <img
        src=""
        alt="Foto profil"
        class="public-account-avatar-modal-image"
        id="publicAccountAvatarModalImage"
    >
</div>


{{-- =============================================================
     AVATAR PREVIEW
============================================================== --}}

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const input = document.getElementById('avatar');

        if (!input) {
            return;
        }


        input.addEventListener('change', function (event) {

            const file = event.target.files?.[0];

            if (!file) {
                return;
            }


            const reader = new FileReader();


            reader.onload = function (e) {

                const preview =
                    document.getElementById(
                        'public-account-avatar-preview'
                    );

                const placeholder =
                    document.getElementById(
                        'public-account-avatar-placeholder'
                    );


                if (preview) {

                    preview.src = e.target.result;

                    if (placeholder) {
                        placeholder.style.display = 'none';
                    }

                    return;
                }


                if (placeholder) {

                    const container =
                        placeholder.parentElement;

                    const image =
                        document.createElement('img');

                    image.id =
                        'public-account-avatar-preview';

                    image.src =
                        e.target.result;

                    image.alt =
                        'Preview foto profil';

                    container.replaceChildren(image);

                }

            };


            reader.readAsDataURL(file);

        });

    });
</script>


{{-- =============================================================
     AVATAR IMAGE MODAL SCRIPT
============================================================= --}}

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const avatarContainer = document.querySelector(
            '.public-account-avatar'
        );

        const modal = document.getElementById(
            'publicAccountAvatarModal'
        );

        const modalImage = document.getElementById(
            'publicAccountAvatarModalImage'
        );

        const closeButton = document.getElementById(
            'publicAccountAvatarModalClose'
        );


        if (
            !avatarContainer ||
            !modal ||
            !modalImage ||
            !closeButton
        ) {
            return;
        }


        function openAvatarModal() {

            const avatar =
                document.getElementById(
                    'public-account-avatar-preview'
                );

            if (!avatar || !avatar.src) {
                return;
            }

            modalImage.src = avatar.src;
            modalImage.alt = avatar.alt || 'Foto profil';

            modal.classList.add('is-open');
            modal.setAttribute('aria-hidden', 'false');

            document.body.classList.add(
                'public-account-avatar-modal-open'
            );
        }


        function closeAvatarModal() {

            modal.classList.remove('is-open');
            modal.setAttribute('aria-hidden', 'true');

            document.body.classList.remove(
                'public-account-avatar-modal-open'
            );

            modalImage.src = '';
        }


        avatarContainer.addEventListener(
            'click',
            function (event) {

                if (
                    event.target.closest(
                        'input, label, button'
                    )
                ) {
                    return;
                }

                openAvatarModal();
            }
        );


        closeButton.addEventListener(
            'click',
            closeAvatarModal
        );


        modal.addEventListener(
            'click',
            function (event) {

                if (event.target === modal) {
                    closeAvatarModal();
                }
            }
        );


        document.addEventListener(
            'keydown',
            function (event) {

                if (
                    event.key === 'Escape' &&
                    modal.classList.contains('is-open')
                ) {
                    closeAvatarModal();
                }
            }
        );

    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        const modal = document.getElementById(
            'public-account-success-modal'
        );

        if (!modal) {
            return;
        }

        const closeButtons = modal.querySelectorAll(
            '[data-public-account-modal-close]'
        );


        document.body.classList.add(
            'public-account-modal-open'
        );


        function closeModal() {
            modal.remove();
            document.body.classList.remove(
                'public-account-modal-open'
            );
        }


        closeButtons.forEach(function (button) {
            button.addEventListener('click', closeModal);
        });


        document.addEventListener(
            'keydown',
            function (event) {
                if (event.key === 'Escape') {
                    closeModal();
                }
            },
            { once: true }
        );

    });
</script>

@endsection