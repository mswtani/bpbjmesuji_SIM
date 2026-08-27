@props([
    'title' => null,
    'description' => null,
    'padding' => true,
])

<div {{ $attributes->merge([
    'class' => 'rounded-2xl border border-gray-200 bg-white shadow-sm'
]) }}>

    @if ($title)
        <div class="border-b border-gray-100 px-4 py-4 sm:px-5">

            <h2 class="text-base font-semibold text-gray-900 sm:text-lg">
                {{ $title }}
            </h2>

            @if ($description)
                <p class="mt-1 text-xs leading-5 text-gray-500 sm:text-sm">
                    {{ $description }}
                </p>
            @endif

        </div>
    @endif


    @if ($padding)

        <div class="p-4 sm:p-5">
            {{ $slot }}
        </div>

    @else

        {{ $slot }}

    @endif

</div>