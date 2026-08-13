@extends('layouts.public')

@section('title', $post->title)

@section('content')

<div class="mx-auto max-w-4xl">

    <div class="mb-6">

        @if ($post->type === 'news')

            <a
                href="{{ route('public.news') }}"
                class="text-sm font-medium text-indigo-600 hover:text-indigo-800"
            >
                ← Kembali ke Berita
            </a>

        @else

            <a
                href="{{ route('public.announcements') }}"
                class="text-sm font-medium text-indigo-600 hover:text-indigo-800"
            >
                ← Kembali ke Pengumuman
            </a>

        @endif

    </div>


    <article class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">

        @if (
            $post->featured_image &&
            \Illuminate\Support\Facades\Storage::disk('public')->exists($post->featured_image)
        )

            <img
                src="{{ asset('storage/' . $post->featured_image) }}"
                alt="{{ $post->title }}"
                class="max-h-[550px] w-full object-cover"
            >

        @endif


        <div class="p-6 sm:p-10">

            @if ($post->type === 'news')

                <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-800">
                    Berita
                </span>

            @else

                <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-medium text-yellow-800">
                    Pengumuman
                </span>

            @endif


            <h1 class="mt-4 text-3xl font-bold leading-tight text-gray-900 sm:text-4xl">
                {{ $post->title }}
            </h1>


            <div class="mt-4 text-sm text-gray-500">

                <span>
                    {{ $post->published_at?->format('d M Y H:i') }}
                </span>

                @if ($post->author)

                    <span class="mx-2">•</span>

                    <span>
                        {{ $post->author->name }}
                    </span>

                @endif

            </div>


            @if ($post->excerpt)

                <div class="mt-8 rounded-lg bg-gray-50 p-5">

                    <p class="text-base leading-7 text-gray-700">
                        {{ $post->excerpt }}
                    </p>

                </div>

            @endif


            <div class="mt-8 whitespace-pre-line text-base leading-8 text-gray-800">
                {{ $post->content }}
            </div>

        </div>

    </article>

</div>

@endsection