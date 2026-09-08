@props([
    'paginator',
    'label' => 'konten',
])

@if ($paginator->total() > 0)

    <div class="public-pagination-wrapper">

        {{-- =====================================================
            INFORMATION
        ====================================================== --}}

        <p class="public-pagination-info">

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
            class="public-pagination-nav"
        >

            {{-- Previous --}}

            @if ($paginator->onFirstPage())

                <span
                    aria-disabled="true"
                    class="public-pagination-arrow public-pagination-arrow-disabled"
                >
                    <span aria-hidden="true">‹</span>
                    <span class="sr-only">
                        Halaman sebelumnya
                    </span>
                </span>

            @else

                <a
                    href="{{ $paginator->previousPageUrl() }}"
                    rel="prev"
                    aria-label="Halaman sebelumnya"
                    class="public-pagination-arrow public-pagination-arrow-link"
                >
                    <span aria-hidden="true">‹</span>
                    <span class="sr-only">
                        Halaman sebelumnya
                    </span>
                </a>

            @endif


            {{-- Page Numbers --}}

            @php
                $current = $paginator->currentPage();
                $last = $paginator->lastPage();

                $pages = collect();

                if ($last <= 7) {

                    $pages = collect(range(1, $last));

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

                    <span class="public-pagination-ellipsis">
                        …
                    </span>

                @elseif ($page == $current)

                    <span
                        aria-current="page"
                        class="public-pagination-page public-pagination-page-active"
                    >
                        {{ $page }}
                    </span>

                @else

                    <a
                        href="{{ $paginator->url($page) }}"
                        aria-label="Halaman {{ $page }}"
                        class="public-pagination-page public-pagination-page-link"
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
                    class="public-pagination-arrow public-pagination-arrow-link"
                >
                    <span aria-hidden="true">›</span>
                    <span class="sr-only">
                        Halaman berikutnya
                    </span>
                </a>

            @else

                <span
                    aria-disabled="true"
                    class="public-pagination-arrow public-pagination-arrow-disabled"
                >
                    <span aria-hidden="true">›</span>
                    <span class="sr-only">
                        Halaman berikutnya
                    </span>
                </span>

            @endif

        </nav>

    </div>

@endif