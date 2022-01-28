@props(['count', 'title', 'color'])

<div class="shadow-sm px-8 py-4 rounded-md bg-white flex space-x-4 cursor-pointer hover:shadow-md">
    <div class="flex-1 flex flex-col justify-center">
        <h4 class="text-4xl xl:text-5xl font-semibold mb-1 text-gray-700">{{ $count }}</h4>
        <p class="text-sm md:text-md xl:text-base text-gray-700">{{ $title }}</p>
    </div>

    <div class="flex justify-center items-center">
        <div class="rounded-full w-20 h-20 xl:w-24 xl:h-24 flex justify-center items-center {{ $color }}">
            {{ $icon }}
        </div>
    </div>
</div>
