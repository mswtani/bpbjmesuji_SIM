@if ($carousels->isNotEmpty())

<section class="public-hero-carousel">

    <div
        id="publicHeroCarousel"
        class="carousel slide"
        data-bs-ride="carousel"
    >

        {{-- =========================================================
             INDICATOR
             SELALU DITAMPILKAN
             ========================================================= --}}
        <div class="carousel-indicators">

            @foreach ($carousels as $index => $carousel)

                <button
                    type="button"
                    data-bs-target="#publicHeroCarousel"
                    data-bs-slide-to="{{ $index }}"
                    @if ($index === 0)
                        class="active"
                        aria-current="true"
                    @endif
                    aria-label="Slide {{ $index + 1 }}"
                ></button>

            @endforeach

        </div>


        {{-- =========================================================
             SLIDES
             ========================================================= --}}
        <div class="carousel-inner">

            @foreach ($carousels as $index => $carousel)

                <div
                    class="carousel-item {{ $index === 0 ? 'active' : '' }}"
                >

                    {{-- Seluruh banner menjadi link --}}
                    <a
                        href="{{ route('posts.show', $carousel->post) }}"
                        class="hero-slide-link"
                    >

                        {{-- =================================================
                             BANNER
                             ================================================= --}}
                        <img
                            src="{{ asset('storage/' . $carousel->banner) }}"
                            class="d-block w-100 hero-slide-image"
                            alt="{{ $carousel->post->title }}"
                        >


                        {{-- =================================================
                             OVERLAY DESKTOP
                             Mengikuti pengaturan admin
                             ================================================= --}}
                        @if ($carousel->show_overlay)

                            <div
                                class="hero-slide-overlay hero-slide-overlay-desktop"
                            ></div>

                        @endif


                        {{-- =================================================
                             OVERLAY MOBILE
                             SELALU AKTIF
                             ================================================= --}}
                        <div
                            class="hero-slide-overlay hero-slide-overlay-mobile"
                        ></div>


                        {{-- =================================================
                             CAPTION NORMAL
                             
                             AUTO   → Judul + excerpt Post
                             CUSTOM → Custom title + description
                             NONE   → tidak ditampilkan di desktop
                             ================================================= --}}
                        @if ($carousel->caption_type !== 'none')

                            <div class="carousel-caption">

                                @if ($carousel->display_title)

                                    <h2>
                                        {{ $carousel->display_title }}
                                    </h2>

                                @endif


                                @if ($carousel->display_description)

                                    <p>
                                        {{ $carousel->display_description }}
                                    </p>

                                @endif


                                @if ($carousel->show_button)

                                    <span
                                        class="btn btn-primary hero-caption-button"
                                    >
                                        {{ $carousel->button_text }}
                                    </span>

                                @endif

                            </div>

                        @endif


                        {{-- =================================================
                             MOBILE FALLBACK
                             
                             HANYA untuk caption_type = none
                             
                             Mobile akan otomatis menggunakan:
                             - post title
                             - post excerpt
                             - button
                             ================================================= --}}
                        @if ($carousel->caption_type === 'none')

                            <div class="hero-mobile-caption">

                                @if ($carousel->post?->title)
                                    <h2>
                                        {{ $carousel->post->title }}
                                    </h2>
                                @endif

                                @if ($carousel->post?->excerpt)
                                    <p>
                                        {{ strip_tags($carousel->post->excerpt) }}
                                    </p>
                                @endif

                                @if ($carousel->show_button)
                                    <span class="btn btn-primary hero-caption-button">
                                        {{ $carousel->button_text }}
                                    </span>
                                @endif

                            </div>

                        @endif

                    </a>

                </div>

            @endforeach

        </div>


        {{-- =========================================================
             PREV
             SELALU DITAMPILKAN
             ========================================================= --}}
        <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#publicHeroCarousel"
            data-bs-slide="prev"
            aria-label="Slide sebelumnya"
        >

            <span
                class="carousel-control-prev-icon"
                aria-hidden="true"
            ></span>

            <span class="visually-hidden">
                Sebelumnya
            </span>

        </button>


        {{-- =========================================================
             NEXT
             SELALU DITAMPILKAN
             ========================================================= --}}
        <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#publicHeroCarousel"
            data-bs-slide="next"
            aria-label="Slide berikutnya"
        >

            <span
                class="carousel-control-next-icon"
                aria-hidden="true"
            ></span>

            <span class="visually-hidden">
                Berikutnya
            </span>

        </button>

    </div>

</section>

@endif