@props([
    'paginator',
    'label' => 'data',
])

@if ($paginator->total() > 0)

    <div
        class="
            flex flex-col gap-3
            border-t border-gray-200
            px-4 py-4
            sm:flex-row sm:items-center sm:justify-between
            sm:px-5
        "
    >

        {{-- =====================================================
             INFORMATION
        ====================================================== --}}

        <p class="text-xs text-gray-600 sm:text-sm">

            Menampilkan

            <span class="font-medium text-gray-900">
                {{ $paginator->firstItem() ?? 0 }}
            </span>

            –

            <span class="font-medium text-gray-900">
                {{ $paginator->lastItem() ?? 0 }}
            </span>

            dari

            <span class="font-medium text-gray-900">
                {{ $paginator->total() }}
            </span>

            {{ $label }}

        </p>


        {{-- =====================================================
             NAVIGATION
        ====================================================== --}}

        <nav
            aria-label="Pagination"
            class="flex items-center gap-1"
        >

            {{-- Previous --}}

            @if ($paginator->onFirstPage())

                <span
                    aria-disabled="true"
                    class="
                        inline-flex h-9 w-9
                        items-center justify-center
                        rounded-lg
                        border border-gray-200
                        bg-gray-50
                        text-sm font-medium
                        text-gray-400
                    "
                >
                    <span aria-hidden="true">‹</span>
                    <span class="sr-only">Halaman sebelumnya</span>
                </span>

            @else

                <a
                    href="{{ $paginator->previousPageUrl() }}"
                    rel="prev"
                    aria-label="Halaman sebelumnya"
                    class="
                        inline-flex h-9 w-9
                        items-center justify-center
                        rounded-lg
                        border border-gray-300
                        bg-white
                        text-sm font-medium
                        text-gray-700
                        transition
                        hover:bg-gray-50
                        hover:text-blue-600
                        focus:outline-none
                        focus:ring-2
                        focus:ring-blue-500/30
                    "
                >
                    <span aria-hidden="true">‹</span>
                    <span class="sr-only">Halaman sebelumnya</span>
                </a>

            @endif


            {{-- =================================================
                 PAGE NUMBERS
            ================================================== --}}

            @php
                $current = $paginator->currentPage();
                $last = $paginator->lastPage();

                $pages = collect();

                if ($last <= 7) {

                    $pages = range(1, $last);

                } else {

                    $pages->push(1);

                    if ($current > 4) {
                        $pages->push('...');
                    }

                    $start = max(2, $current - 1);
                    $end = min($last - 1, $current + 1);

                    for ($page = $start; $page <= $end; $page++) {
                        $pages->push($page);
                    }

                    if ($current < $last - 3) {
                        $pages->push('...');
                    }

                    $pages->push($last);
                }
            @endphp


            @foreach ($pages as $page)

                @if ($page === '...')

                    <span
                        class="
                            inline-flex h-9 min-w-8
                            items-center justify-center
                            px-1
                            text-sm text-gray-400
                        "
                    >
                        …
                    </span>

                @elseif ($page == $current)

                    <span
                        aria-current="page"
                        class="
                            inline-flex h-9 min-w-9
                            items-center justify-center
                            rounded-lg
                            bg-blue-700
                            px-3
                            text-sm font-medium
                            text-white
                        "
                    >
                        {{ $page }}
                    </span>

                @else

                    <a
                        href="{{ $paginator->url($page) }}"
                        aria-label="Halaman {{ $page }}"
                        class="
                            inline-flex h-9 min-w-9
                            items-center justify-center
                            rounded-lg
                            border border-gray-300
                            bg-white
                            px-3
                            text-sm font-medium
                            text-gray-700
                            transition
                            hover:bg-gray-50
                            hover:text-blue-600
                            focus:outline-none
                            focus:ring-2
                            focus:ring-blue-500/30
                        "
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
                    aria-label="Halaman berikutnya"
                    class="
                        inline-flex h-9 w-9
                        items-center justify-center
                        rounded-lg
                        border border-gray-300
                        bg-white
                        text-sm font-medium
                        text-gray-700
                        transition
                        hover:bg-gray-50
                        hover:text-blue-600
                        focus:outline-none
                        focus:ring-2
                        focus:ring-blue-500/30
                    "
                >
                    <span aria-hidden="true">›</span>
                    <span class="sr-only">Halaman berikutnya</span>
                </a>

            @else

                <span
                    aria-disabled="true"
                    class="
                        inline-flex h-9 w-9
                        items-center justify-center
                        rounded-lg
                        border border-gray-200
                        bg-gray-50
                        text-sm font-medium
                        text-gray-400
                    "
                >
                    <span aria-hidden="true">›</span>
                    <span class="sr-only">Halaman berikutnya</span>
                </span>

            @endif

        </nav>

    </div>

@endif