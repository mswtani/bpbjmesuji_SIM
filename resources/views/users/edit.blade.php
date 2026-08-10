@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')

    <div class="mb-6">

        <h1 class="text-2xl font-semibold text-gray-900">
            Edit User
        </h1>

        <p class="mt-1 text-sm text-gray-600">
            Perbarui informasi pengguna.
        </p>

    </div>


    <x-admin.card>

        <form
            method="POST"
            action="{{ route('users.update', $user) }}"
        >

            @csrf

            @method('PUT')

            <div class="space-y-6">

                @include('users._form')

            </div>


            <div class="mt-6 flex items-center justify-end gap-3">

                <a
                    href="{{ route('users.index') }}"
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