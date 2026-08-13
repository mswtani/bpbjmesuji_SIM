@extends('layouts.admin')

@section('title', 'Edit Konten')

@section('content')

<div class="mx-auto max-w-5xl">

    {{-- Header --}}
    <div class="mb-6">

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h1 class="text-2xl font-semibold text-gray-900">
                    Edit Konten
                </h1>

                <p class="mt-1 text-sm text-gray-600">
                    Perbarui berita, pengumuman, atau regulasi.
                </p>
            </div>

            <a
                href="{{ route('posts.show', $post) }}"
                class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
            >
                Kembali
            </a>

        </div>

    </div>


    {{-- Form --}}
    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm sm:p-8">

        <form
            method="POST"
            action="{{ route('posts.update', $post) }}"
            enctype="multipart/form-data"
        >

            @csrf

            @method('PUT')

            @include('posts._form', [
                'post' => $post,
                'formAction' => route('posts.update', $post),
                'formMethod' => 'PUT',
                'submitLabel' => 'Simpan Perubahan',
            ])


        </form>

    </div>

</div>