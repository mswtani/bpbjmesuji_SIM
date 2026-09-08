<header>
    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Profile Information') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600">
        {{ __("Update your account's profile information and email address.") }}
    </p>
</header>


{{-- Informasi akun --}}
<div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">

    {{-- NIP --}}
    <div>
        <x-input-label
            for="profile_nip"
            :value="__('NIP')"
        />

        <x-text-input
            id="profile_nip"
            type="text"
            class="mt-1 block w-full bg-gray-100"
            :value="$user->nip"
            disabled
        />

        <p class="mt-1 text-xs text-gray-500">
            NIP hanya dapat diubah melalui User Management.
        </p>
    </div>


    {{-- Role --}}
    <div>
        <x-input-label
            for="profile_role"
            :value="__('Role')"
        />

        <x-text-input
            id="profile_role"
            type="text"
            class="mt-1 block w-full bg-gray-100"
            :value="$user->role?->name ?? '-'"
            disabled
        />
    </div>


    {{-- Jabatan --}}
    <div>
        <x-input-label
            for="profile_position"
            :value="__('Jabatan dalam PBJ')"
        />

        <x-text-input
            id="profile_position"
            type="text"
            class="mt-1 block w-full bg-gray-100"
            :value="$user->position?->name ?? '-'"
            disabled
        />
    </div>


    {{-- Status --}}
    <div>
        <x-input-label
            for="profile_status"
            :value="__('Status Akun')"
        />

        <x-text-input
            id="profile_status"
            type="text"
            class="mt-1 block w-full bg-gray-100"
            :value="$user->is_active ? 'Aktif' : 'Tidak Aktif'"
            disabled
        />
    </div>

</div>


<form
    id="send-verification"
    method="post"
    action="{{ route('verification.send') }}"
>
    @csrf
</form>


<form
    method="post"
    action="{{ route('profile.update') }}"
    enctype="multipart/form-data"
    class="mt-6 space-y-6"
>
    @csrf
    @method('patch')


    {{-- =====================================================
        FOTO PROFIL
    ====================================================== --}}

    <div
        class="
            rounded-xl
            border border-gray-200
            bg-gray-50
            p-5
        "
    >

        <div
            class="
                flex flex-col gap-5
                sm:flex-row
                sm:items-center
            "
        >

            {{-- Preview --}}
            <div
                class="
                    h-24 w-24
                    shrink-0
                    overflow-hidden
                    rounded-full
                    border border-gray-200
                    bg-blue-100
                "
            >

                @if ($user->avatar)

                    <img
                        id="profile-avatar-preview"
                        src="{{ asset('storage/' . $user->avatar) }}"
                        alt="Foto {{ $user->name }}"
                        class="h-full w-full object-cover"
                    >

                @else

                    <div
                        id="profile-avatar-placeholder"
                        class="
                            flex
                            h-full w-full
                            items-center justify-center
                            text-2xl
                            font-semibold
                            text-blue-700
                        "
                    >
                        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                    </div>

                @endif

            </div>


            {{-- Kontrol Foto --}}
            <div class="min-w-0 flex-1">

                <x-input-label
                    for="avatar"
                    :value="__('Foto Profil')"
                />

                <input
                    id="avatar"
                    name="avatar"
                    type="file"
                    accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                    class="
                        mt-2
                        block
                        w-full
                        text-sm
                        text-gray-600
                        file:mr-4
                        file:rounded-lg
                        file:border-0
                        file:bg-blue-50
                        file:px-4
                        file:py-2
                        file:text-sm
                        file:font-semibold
                        file:text-blue-700
                        hover:file:bg-blue-100
                    "
                >

                <p class="mt-1.5 text-xs text-gray-500">
                    JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                </p>


                {{-- Hapus Foto --}}
                @if ($user->avatar)

                    <label
                        class="
                            mt-3
                            inline-flex
                            cursor-pointer
                            items-center
                            gap-2
                            text-sm
                            font-medium
                            text-red-600
                            hover:text-red-700
                        "
                    >

                        <input
                            type="checkbox"
                            name="remove_avatar"
                            value="1"
                            class="
                                rounded
                                border-gray-300
                                text-red-600
                                shadow-sm
                                focus:border-red-500
                                focus:ring-red-500
                            "
                        >

                        Hapus foto profil

                    </label>

                @endif


                <x-input-error
                    class="mt-2"
                    :messages="$errors->get('avatar')"
                />

            </div>

        </div>

    </div>


    {{-- =====================================================
        NAMA
    ====================================================== --}}

    <div>

        <x-input-label
            for="name"
            :value="__('Nama Lengkap')"
        />

        <x-text-input
            id="name"
            name="name"
            type="text"
            class="mt-1 block w-full"
            :value="old('name', $user->name)"
            required
            autofocus
            autocomplete="name"
        />

        <x-input-error
            class="mt-2"
            :messages="$errors->get('name')"
        />

    </div>


    {{-- =====================================================
        EMAIL
    ====================================================== --}}

    <div>

        <x-input-label
            for="email"
            :value="__('Email')"
        />

        <x-text-input
            id="email"
            name="email"
            type="email"
            class="mt-1 block w-full"
            :value="old('email', $user->email)"
            required
            autocomplete="username"
        />

        <x-input-error
            class="mt-2"
            :messages="$errors->get('email')"
        />


        {{-- Email belum terverifikasi --}}
        @if (
            $user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&
            ! $user->hasVerifiedEmail()
        )

            <div>

                <p class="mt-2 text-sm text-gray-800">

                    {{ __('Your email address is unverified.') }}

                    <button
                        form="send-verification"
                        class="
                            rounded-md
                            text-sm
                            text-gray-600
                            underline
                            hover:text-gray-900
                            focus:outline-none
                            focus:ring-2
                            focus:ring-indigo-500
                            focus:ring-offset-2
                        "
                    >
                        {{ __('Click here to re-send the verification email.') }}
                    </button>

                </p>


                @if (session('status') === 'verification-link-sent')

                    <p class="mt-2 text-sm font-medium text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>

                @endif

            </div>

        @endif

    </div>


    {{-- =====================================================
        TOMBOL SIMPAN
    ====================================================== --}}

    <div class="flex items-center gap-4">

        <x-primary-button>
            {{ __('Simpan Perubahan') }}
        </x-primary-button>


        @if (session('status') === 'profile-updated')

            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600"
            >
                {{ __('Perubahan berhasil disimpan.') }}
            </p>

        @endif

    </div>

</form>


{{-- =========================================================
    PREVIEW FOTO PROFIL
========================================================== --}}

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
                const preview = document.getElementById(
                    'profile-avatar-preview'
                );

                const placeholder = document.getElementById(
                    'profile-avatar-placeholder'
                );

                /*
                |--------------------------------------------------------------------------
                | Jika sudah mempunyai foto
                |--------------------------------------------------------------------------
                */
                if (preview) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');

                    if (placeholder) {
                        placeholder.classList.add('hidden');
                    }

                    return;
                }

                /*
                |--------------------------------------------------------------------------
                | Jika sebelumnya belum mempunyai foto
                |--------------------------------------------------------------------------
                */
                if (placeholder) {
                    const container = placeholder.parentElement;

                    const image = document.createElement('img');

                    image.id = 'profile-avatar-preview';
                    image.src = e.target.result;
                    image.alt = 'Preview foto profil';
                    image.className =
                        'h-full w-full object-cover';

                    /*
                    | Simpan referensi container terlebih dahulu
                    | sebelum placeholder dihapus.
                    */
                    container.replaceChildren(image);
                }
            };

            reader.readAsDataURL(file);
        });
    });
</script>