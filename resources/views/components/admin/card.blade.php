<div class="bg-white rounded-lg border border-gray-200 shadow-sm max-w-6xl">

    @isset($title)

        <div class="border-b px-6 py-4">

            <h2 class="text-lg font-semibold text-gray-800">

                {{ $title }}

            </h2>

        </div>

    @endisset

    <div class="p-6">

        {{ $slot }}

    </div>

</div>