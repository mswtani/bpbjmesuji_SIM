@props([
    'title',
    'description' => null,
])

<div class="w-full space-y-5 sm:space-y-6">

    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}

    <div
        class="
            flex flex-col gap-4
            sm:flex-row sm:items-center sm:justify-between
        "
    >

        {{-- TITLE --}}

        <div class="min-w-0">

            <h1
                class="
                    text-xl font-bold tracking-tight text-gray-900
                    sm:text-2xl
                "
            >
                {{ $title }}
            </h1>

            @if ($description)

                <p
                    class="
                        mt-1
                        text-xs leading-5 text-gray-500
                        sm:text-sm
                    "
                >
                    {{ $description }}
                </p>

            @endif

        </div>


        {{-- ACTIONS --}}

        @isset($actions)

            <div
                class="
                    flex shrink-0 flex-wrap items-center gap-2
                "
            >
                {{ $actions }}
            </div>

        @endisset

    </div>


    {{-- =========================================================
         PAGE CONTENT
    ========================================================== --}}

    <div class="space-y-5 sm:space-y-6">

        {{ $slot }}

    </div>

</div>