<div class="space-y-6">

    <div>

        <h1 class="text-3xl font-bold">

            {{ $title }}

        </h1>

        @isset($description)

            <p class="mt-2 text-gray-500">

                {{ $description }}

            </p>

        @endisset

    </div>

    {{ $slot }}

</div>