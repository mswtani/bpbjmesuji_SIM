@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
])

@php
    $baseClasses = [
        'inline-flex',
        'items-center',
        'justify-center',
        'gap-2',
        'rounded-lg',
        'font-medium',
        'transition',
        'focus:outline-none',
        'focus:ring-2',
        'focus:ring-offset-1',
        'disabled:pointer-events-none',
        'disabled:opacity-50',
    ];

    $variantClasses = match ($variant) {
        'secondary' => [
            'border',
            'border-gray-300',
            'bg-white',
            'text-gray-700',
            'hover:bg-gray-50',
            'focus:ring-gray-400/30',
        ],

        'danger' => [
            'bg-red-600',
            'text-white',
            'hover:bg-red-700',
            'focus:ring-red-500/30',
        ],

        'success' => [
            'bg-emerald-600',
            'text-white',
            'hover:bg-emerald-700',
            'focus:ring-emerald-500/30',
        ],

        default => [
            'bg-blue-600',
            'text-white',
            'hover:bg-blue-700',
            'focus:ring-blue-500/30',
        ],
    };

    $sizeClasses = match ($size) {
        'sm' => [
            'min-h-9',
            'px-3',
            'py-1.5',
            'text-xs',
        ],

        'lg' => [
            'min-h-11',
            'px-5',
            'py-2.5',
            'text-base',
        ],

        default => [
            'min-h-10',
            'px-4',
            'py-2',
            'text-sm',
        ],
    };
@endphp

<button
    type="{{ $type }}"
    {{ $attributes->merge([
        'class' => implode(' ', [
            ...$baseClasses,
            ...$variantClasses,
            ...$sizeClasses,
        ]),
    ]) }}
>
    {{ $slot }}
</button>