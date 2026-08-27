@props([
    'title',
    'value' => '—',
    'description' => null,
    'icon' => 'document',
])

<div
    class="
        h-full w-full
        rounded-xl
        border border-gray-200
        bg-white
        p-4
        shadow-sm
        sm:p-5
    "
>

    <div class="flex items-start justify-between gap-3">

        <div class="min-w-0">

            <p class="text-xs font-medium text-gray-500 sm:text-sm">
                {{ $title }}
            </p>

            <p class="mt-2 text-2xl font-bold leading-8 tracking-tight text-gray-900 sm:text-3xl sm:leading-9">
                {{ $value }}
            </p>

            @if ($description)
                <p class="mt-1 text-xs text-gray-500 sm:text-sm">
                    {{ $description }}
                </p>
            @endif

        </div>


        <div
            @class([
                'flex h-9 w-9 shrink-0 items-center justify-center rounded-lg sm:h-10 sm:w-10',

                'bg-indigo-50 text-indigo-600' => $icon === 'document',
                'bg-emerald-50 text-emerald-600' => $icon === 'helpdesk',
                'bg-amber-50 text-amber-600' => $icon === 'users',
                'bg-violet-50 text-violet-600' => $icon === 'roles',
            ])
        >

            @if ($icon === 'document')

                <svg
                    class="h-5 w-5"
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

            @elseif ($icon === 'helpdesk')

                <svg
                    class="h-5 w-5"
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
                </svg>

            @elseif ($icon === 'users')

                <svg
                    class="h-5 w-5"
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
                    class="h-5 w-5"
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
                </svg>

            @endif

        </div>

    </div>

</div>