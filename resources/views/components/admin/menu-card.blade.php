@props([
    'href',
    'title',
    'description',
    'icon' => 'document',
])

<a
    href="{{ $href }}"
    class="
        group block h-full
        rounded-xl
        border border-gray-200
        bg-white
        p-4
        shadow-sm
        transition-all duration-200
        hover:-translate-y-0.5
        hover:shadow-md
        focus:outline-none
        focus:ring-2
        focus:ring-blue-500/30
        sm:p-5
    "
>

    <div class="flex h-full items-start gap-3 sm:gap-4">

        {{-- ICON --}}
        <div
            @class([
                'flex h-10 w-10 shrink-0 items-center justify-center rounded-xl sm:h-11 sm:w-11',

                'bg-blue-50 text-blue-600' => $icon === 'dashboard',
                'bg-indigo-50 text-indigo-600' => $icon === 'document',
                'bg-emerald-50 text-emerald-600' => $icon === 'helpdesk',
                'bg-amber-50 text-amber-600' => $icon === 'users',
                'bg-violet-50 text-violet-600' => $icon === 'roles',
                'bg-cyan-50 text-cyan-600' => $icon === 'profile',
                'bg-rose-50 text-rose-600' => $icon === 'image',
            ])
        >

            @if ($icon === 'dashboard')

                <svg
                    class="h-5 w-5 sm:h-6 sm:w-6"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 10.5 12 3l9 7.5M5 9v11h14V9M9 20v-6h6v6"
                    />
                </svg>

            @elseif ($icon === 'document')

                <svg
                    class="h-5 w-5 sm:h-6 sm:w-6"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 3h9l3 3v15H6V3Z"
                    />

                    <path
                        stroke-linecap="round"
                        d="M14 3v4h4M9 12h6M9 16h6"
                    />
                </svg>


            @elseif ($icon === 'image')

                <svg
                    class="h-5 w-5 sm:h-6 sm:w-6"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <rect
                        x="3"
                        y="4"
                        width="18"
                        height="16"
                        rx="2"
                        ry="2"
                    />

                    <circle
                        cx="8.5"
                        cy="9"
                        r="1.5"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m3 16 5-5 4 4 2.5-2.5L21 18"
                    />
                </svg>

            @elseif ($icon === 'helpdesk')

                <svg
                    class="h-5 w-5 sm:h-6 sm:w-6"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4 12a8 8 0 0 1 16 0v5a2 2 0 0 1-2 2h-3"
                    />

                    <path
                        stroke-linecap="round"
                        d="M4 14H3a2 2 0 0 0 0 4h1v-4ZM20 14h1a2 2 0 0 1 0 4h-1v-4Z"
                    />

                    <path
                        stroke-linecap="round"
                        d="M12 19h3"
                    />
                </svg>

            @elseif ($icon === 'users')

                <svg
                    class="h-5 w-5 sm:h-6 sm:w-6"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <circle
                        cx="9"
                        cy="7"
                        r="4"
                    />

                    <path
                        stroke-linecap="round"
                        d="M2 21a7 7 0 0 1 14 0M16 3.13a4 4 0 0 1 0 7.75M22 21a6 6 0 0 0-5-5.91"
                    />
                </svg>

            @elseif ($icon === 'roles')

                <svg
                    class="h-5 w-5 sm:h-6 sm:w-6"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 3l8 4v5c0 5-3.5 8-8 9-4.5-1-8-4-8-9V7l8-4Z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m9 12 2 2 4-4"
                    />
                </svg>

            @elseif ($icon === 'profile')

                <svg
                    class="h-5 w-5 sm:h-6 sm:w-6"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <circle
                        cx="12"
                        cy="8"
                        r="4"
                    />

                    <path
                        stroke-linecap="round"
                        d="M4 21a8 8 0 0 1 16 0"
                    />
                </svg>

            @endif

        </div>


        {{-- CONTENT --}}
        <div class="min-w-0 flex-1">

            <h3
                class="
                    text-sm font-semibold text-gray-900
                    transition-colors
                    group-hover:text-blue-600
                    sm:text-base
                "
            >
                {{ $title }}
            </h3>

            <p
                class="
                    mt-1
                    text-xs leading-5 text-gray-500
                    sm:text-sm
                "
            >
                {{ $description }}
            </p>

        </div>

    </div>

</a>