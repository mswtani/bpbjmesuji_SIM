@props([
    'title',
    'description',
    'type' => 'info',
    'href' => null,
    'unread' => false,
])

@php
    $styles = match ($type) {
        'warning' => [
            'wrapper' => 'hover:bg-amber-50/50',
            'icon' => 'bg-amber-50 text-amber-600',
        ],

        'success' => [
            'wrapper' => 'hover:bg-emerald-50/50',
            'icon' => 'bg-emerald-50 text-emerald-600',
        ],

        'danger' => [
            'wrapper' => 'hover:bg-red-50/50',
            'icon' => 'bg-red-50 text-red-600',
        ],

        default => [
            'wrapper' => 'hover:bg-blue-50/50',
            'icon' => 'bg-blue-50 text-blue-600',
        ],
    };
@endphp

@if ($href)
    <a
        href="{{ $href }}"
        class="
            flex w-full items-start gap-3
            rounded-lg p-3
            transition
            {{ $styles['wrapper'] }}
        "
    >
@else
    <div
        class="
            flex w-full items-start gap-3
            rounded-lg p-3
            transition
            {{ $styles['wrapper'] }}
        "
    >
@endif

        <div
            class="
                flex h-9 w-9 shrink-0
                items-center justify-center
                rounded-lg
                {{ $styles['icon'] }}
            "
        >
            @if ($type === 'warning')

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
                        d="M12 9v4m0 4h.01M10.3 3.8 2.7 17a2 2 0 0 0 1.73 3h15.14a2 2 0 0 0 1.73-3L13.7 3.8a2 2 0 0 0-3.4 0Z"
                    />
                </svg>

            @elseif ($type === 'success')

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
                        d="m5 12 4 4L19 6"
                    />
                </svg>

            @elseif ($type === 'danger')

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
                        d="M12 9v4m0 4h.01M10.3 3.8 2.7 17a2 2 0 0 0 1.73 3h15.14a2 2 0 0 0 1.73-3L13.7 3.8a2 2 0 0 0-3.4 0Z"
                    />
                </svg>

            @else

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
                        d="M13 16h-1v-4h-1m1-4h.01M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Z"
                    />
                </svg>

            @endif
        </div>


        <div class="min-w-0 flex-1">

            <h3 class="text-sm font-semibold text-gray-900">
                {{ $title }}
            </h3>

            <p class="mt-1 text-xs leading-5 text-gray-500 sm:text-sm">
                {{ $description }}
            </p>

        </div>

@if ($href)
    </a>
@else
    </div>
@endif