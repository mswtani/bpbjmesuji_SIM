@php
    $isPublic = old(
        'user_type',
        $user->user_type ?? 'asn'
    ) === 'public';
@endphp


{{-- NIP --}}
@if (! $isPublic)
    <div>
        <x-admin.form.label for="nip">
            NIP <span class="text-red-500">*</span>
        </x-admin.form.label>

        <x-admin.form.input
            id="nip"
            name="nip"
            type="text"
            :value="old('nip', $user->nip ?? '')"
            required
        />

        <x-admin.form.error field="nip" />
    </div>
@endif


{{-- Nama Lengkap --}}
<div>
    <x-admin.form.label for="name">
        Nama Lengkap <span class="text-red-500">*</span>
    </x-admin.form.label>

    <x-admin.form.input
        id="name"
        name="name"
        type="text"
        :value="old('name', $user->name ?? '')"
        required
    />

    <x-admin.form.error field="name" />
</div>


{{-- Email --}}
<div>
    <x-admin.form.label for="email">
        Email <span class="text-red-500">*</span>
    </x-admin.form.label>

    <x-admin.form.input
        id="email"
        name="email"
        type="email"
        :value="old('email', $user->email ?? '')"
        required
    />

    <x-admin.form.error field="email" />
</div>

{{-- Foto Profil --}}
<div>
    <x-admin.form.label for="avatar">
        Foto Profil
    </x-admin.form.label>

    <div class="mt-2 flex flex-col gap-4 sm:flex-row sm:items-center">

        {{-- Preview --}}
        <div
            class="
                h-24
                w-24
                shrink-0
                overflow-hidden
                rounded-full
                border
                border-gray-200
                bg-gray-100
            "
        >
            @if ($user->avatar)
                <img
                    id="avatar-preview"
                    src="{{ asset('storage/' . $user->avatar) }}"
                    alt="Foto {{ $user->name }}"
                    class="h-full w-full object-cover"
                >
            @else
                <div
                    id="avatar-placeholder"
                    class="
                        flex
                        h-full
                        w-full
                        items-center
                        justify-center
                        bg-blue-100
                        text-2xl
                        font-semibold
                        text-blue-700
                    "
                >
                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                </div>
            @endif
        </div>

        {{-- Input --}}
        <div class="min-w-0 flex-1">

            <input
                id="avatar"
                name="avatar"
                type="file"
                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                class="
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

        </div>

    </div>

    <x-admin.form.error field="avatar" />
</div>


@if (! $isPublic)

    {{-- Role --}}
    <div>
        <x-admin.form.label for="role_id">
            Role <span class="text-red-500">*</span>
        </x-admin.form.label>

        <select
            id="role_id"
            name="role_id"
            required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        >
            <option value="">
                -- Pilih Role --
            </option>

            @foreach ($roles as $role)

                <option
                    value="{{ $role->id }}"
                    @selected(
                        old('role_id', $user->role_id ?? '') == $role->id
                    )
                >
                    {{ $role->name }}
                </option>

            @endforeach

        </select>

        <x-admin.form.error field="role_id" />
    </div>


    {{-- Jabatan --}}
    <div>
        <x-admin.form.label for="position_id">
            Jabatan dalam PBJ <span class="text-red-500">*</span>
        </x-admin.form.label>

        <select
            id="position_id"
            name="position_id"
            required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        >
            <option value="">
                -- Pilih Jabatan --
            </option>

            @foreach ($positions as $position)

                <option
                    value="{{ $position->id }}"
                    @selected(
                        old(
                            'position_id',
                            $user->position_id ?? ''
                        ) == $position->id
                    )
                >
                    {{ $position->name }}
                </option>

            @endforeach

        </select>

        <x-admin.form.error field="position_id" />
    </div>

@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('avatar');
        const preview = document.getElementById('avatar-preview');
        const placeholder = document.getElementById('avatar-placeholder');

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
                if (preview) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                } else {
                    const image = document.createElement('img');

                    image.id = 'avatar-preview';
                    image.src = e.target.result;
                    image.alt = 'Preview foto profil';
                    image.className = 'h-full w-full object-cover';

                    const container = placeholder?.parentElement;

                    if (container) {
                        placeholder.remove();
                        container.appendChild(image);
                    }
                }

                if (placeholder) {
                    placeholder.classList.add('hidden');
                }
            };

            reader.readAsDataURL(file);
        });
    });
</script>