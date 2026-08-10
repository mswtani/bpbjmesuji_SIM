@extends('layouts.admin')

@section('title', 'Tambah User')

@section('content')

    {{-- Header --}}
    <div class="mb-6">

        <div class="flex items-center justify-between">

            <div>

                <h1 class="text-2xl font-semibold text-gray-900">
                    Tambah User
                </h1>

                <p class="mt-1 text-sm text-gray-600">
                    Tambahkan pengguna baru ke dalam sistem BPBJ Mesuji.
                </p>

            </div>


            <a
                href="{{ route('users.index') }}"
                class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
            >
                Kembali
            </a>

        </div>

    </div>


    {{-- Validation Error --}}
    @if ($errors->any())

        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-4">

            <div class="font-medium text-red-800">
                Data belum dapat disimpan.
            </div>

            <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-700">

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Form --}}
    <x-admin.card>

        <form
            method="POST"
            action="{{ route('users.store') }}"
            class="space-y-6"
        >

            @csrf


            {{-- Form Fields --}}
            @include('users._form')


            {{-- Tombol --}}
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 pt-6">

                <a
                    href="{{ route('users.index') }}"
                    class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                >
                    Batal
                </a>


                <button
                    type="submit"
                    class="rounded-md bg-indigo-600 px-5 py-2 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Simpan User
                </button>

            </div>

        </form>

    </x-admin.card>

@endsection