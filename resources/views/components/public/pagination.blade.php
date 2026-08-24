@props([
    'paginator',
])

@if ($paginator->total() > 0)

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        {{-- Informasi hasil --}}
        <p class="text-sm text-gray-600">
            Showing
            <span class="font-medium text-gray-900">
                {{ $paginator->firstItem() ?? 0 }}
            </span>
            to
            <span class="font-medium text-gray-900">
                {{ $paginator->lastItem() ?? 0 }}
            </span>
            of
            <span class="font-medium text-gray-900">
                {{ $paginator->total() }}
            </span>
            results
        </p>


        {{-- Navigation --}}
        <nav
            aria-label="Pagination"
            class="flex items-center gap-1"
        >

            {{-- Previous --}}
            @if ($paginator->onFirstPage())

                <span
                    aria-disabled="true"
                    class="inline-flex h-9 items-center rounded-md border border-gray-200 bg-gray-50 px-3 text-sm font-medium text-gray-400"
                >
                    <
                </span>

            @else

                <a
                    href="{{ $paginator->previousPageUrl() }}"
                    rel="prev"
                    class="inline-flex h-9 items-center rounded-md border border-gray-300 bg-white px-3 text-sm font-medium text-gray-700 transition hover:bg-gray-50"
                >
                    <
                </a>

            @endif


            {{-- Nomor halaman --}}
            @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)

                @if ($page == $paginator->currentPage())

                    <span
                        aria-current="page"
                        class="inline-flex h-9 min-w-9 items-center justify-center rounded-md bg-blue-700 px-3 text-sm font-medium text-white"
                    >
                        {{ $page }}
                    </span>

                @else

                    <a
                        href="{{ $url }}"
                        class="inline-flex h-9 min-w-9 items-center justify-center rounded-md border border-gray-300 bg-white text-sm font-medium text-gray-700 transition hover:bg-gray-50"
                    >
                        {{ $page }}
                    </a>

                @endif

            @endforeach


            {{-- Next --}}
            @if ($paginator->hasMorePages())

                <a
                    href="{{ $paginator->nextPageUrl() }}"
                    rel="next"
                    class="inline-flex h-9 items-center rounded-md border border-gray-300 bg-white px-3 text-sm font-medium text-gray-700 transition hover:bg-gray-50"
                >
                    >
                </a>

            @else

                <span
                    aria-disabled="true"
                    class="inline-flex h-9 items-center rounded-md border border-gray-200 bg-gray-50 px-3 text-sm font-medium text-gray-400"
                >
                    >
                </span>

            @endif

        </nav>

    </div>

@endif