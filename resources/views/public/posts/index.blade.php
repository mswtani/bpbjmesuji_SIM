@extends('layouts.public')

@section('title', $pageTitle)

@section('content')

...

<div class="mx-auto max-w-7xl">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">
            {{ $pageTitle }}
        </h1>

        <p class="mt-2 text-gray-600">
            {{ $pageDescription }}
        </p>
    </div>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">

        @forelse ($posts as $post)

            <article class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm transition hover:shadow-md">

                @if (
                    $post->featured_image &&
                    \Illuminate\Support\Facades\Storage::disk('public')->exists($post->featured_image)
                )

                    <a
                        href="{{ $type === 'news'
                            ? route('public.news.show', $post->slug)
                            : route('public.announcements.show', $post->slug) }}"
                    >
                        <img
                            src="{{ asset('storage/' . $post->featured_image) }}"
                            alt="{{ $post->title }}"
                            class="h-52 w-full object-cover"
                        >
                    </a>

                @else

                    <div class="flex h-52 w-full items-center justify-center bg-gray-100">
                        <span class="text-sm text-gray-400">
                            Tidak ada gambar
                        </span>
                    </div>

                @endif


                <div class="p-6">

                    <p class="text-xs font-medium text-gray-500">
                        {{ $post->published_at?->format('d M Y') }}
                    </p>

                    <h2 class="mt-2 text-xl font-semibold text-gray-900">

                        <a
                            href="{{ $type === 'news'
                                ? route('public.news.show', $post->slug)
                                : route('public.announcements.show', $post->slug) }}"
                            class="hover:text-indigo-600"
                        >
                            {{ $post->title }}
                        </a>

                    </h2>

                    @if ($post->excerpt)

                        <p class="mt-3 line-clamp-3 text-sm leading-6 text-gray-600">
                            {{ $post->excerpt }}
                        </p>

                    @endif

                    <div class="mt-5">

                        <a
                            href="{{ $type === 'news'
                                ? route('public.news.show', $post->slug)
                                : route('public.announcements.show', $post->slug) }}"
                            class="text-sm font-medium text-indigo-600 hover:text-indigo-800"
                        >
                            Baca selengkapnya →
                        </a>

                    </div>

                </div>

            </article>

        @empty

            <div class="col-span-full rounded-lg border border-gray-200 bg-white px-6 py-12 text-center">

                <p class="text-sm font-medium text-gray-900">
                    Belum ada {{ strtolower($pageTitle) }}.
                </p>

            </div>

        @endforelse

    </div>


    @if ($posts->hasPages())

        <div class="mt-8">
            {{ $posts->links() }}
        </div>

    @endif

</div>

@endsection