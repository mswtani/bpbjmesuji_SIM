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
        <x-input-label for="profile_nip" :value="__('NIP')" />

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
        <x-input-label for="profile_role" :value="__('Role')" />

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
        <x-input-label for="profile_position" :value="__('Jabatan dalam PBJ')" />

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
        <x-input-label for="profile_status" :value="__('Status Akun')" />

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
    class="mt-6 space-y-6"
>
    @csrf
    @method('patch')


    {{-- Nama --}}
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


    {{-- Email --}}
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
                        class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
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


    {{-- Nomor HP --}}
    <div>
        <x-input-label
            for="phone"
            :value="__('Nomor HP')"
        />

        <x-text-input
            id="phone"
            name="phone"
            type="tel"
            class="mt-1 block w-full"
            :value="old('phone', $user->phone)"
            autocomplete="tel"
            maxlength="20"
        />

        <x-input-error
            class="mt-2"
            :messages="$errors->get('phone')"
        />
    </div>


    {{-- Tombol Simpan --}}
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