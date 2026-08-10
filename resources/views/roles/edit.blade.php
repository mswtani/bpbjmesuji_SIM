@extends('layouts.admin')

@section('title', 'Edit Role')

@section('content')

    {{-- Header --}}
    <div class="mb-6">

        <h1 class="text-2xl font-semibold text-gray-900">
            Edit Role
        </h1>

        <p class="mt-1 text-sm text-gray-600">
            Perbarui informasi role pengguna.
        </p>

    </div>


    {{-- Form --}}
    <x-admin.card>

        <form
            method="POST"
            action="{{ route('roles.update', $role) }}"
        >

            @csrf

            @method('PUT')

            <div class="space-y-6">

                {{-- Code --}}
                <div>

                    <label
                        for="code"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Code <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="code"
                        name="code"
                        value="{{ old('code', $role->code) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    >

                    @error('code')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Nama --}}
                <div>

                    <label
                        for="name"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Nama Role <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $role->name) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    >

                    @error('name')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Deskripsi --}}
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
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    >{{ old('description', $role->description) }}</textarea>

                    @error('description')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Level --}}
                <div>

                    <label
                        for="level"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Level <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="number"
                        id="level"
                        name="level"
                        value="{{ old('level', $role->level) }}"
                        min="1"
                        max="255"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    >

                    @error('level')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>


            {{-- Tombol --}}
            <div class="mt-6 flex items-center justify-end gap-3">

                <a
                    href="{{ route('roles.index') }}"
                    class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700"
                >
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </x-admin.card>

@endsection