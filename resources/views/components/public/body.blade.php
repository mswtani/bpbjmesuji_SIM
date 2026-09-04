@props([
    'class' => '',
])

<main
    {{ $attributes->merge([
        'class' => "min-h-screen bg-white {$class}",
    ]) }}
>
    {{ $slot }}
</main>