{{-- NIP --}}
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


{{-- Nomor HP --}}
<div>
    <x-admin.form.label for="phone">
        Nomor HP
    </x-admin.form.label>

    <x-admin.form.input
        id="phone"
        name="phone"
        type="tel"
        :value="old('phone', $user->phone ?? '')"
    />

    <x-admin.form.error field="phone" />
</div>


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
                    old('position_id', $user->position_id ?? '') == $position->id
                )
            >
                {{ $position->name }}
            </option>

        @endforeach

    </select>

    <x-admin.form.error field="position_id" />
</div>