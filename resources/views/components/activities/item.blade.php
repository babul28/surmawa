@props(['src', 'alt', 'href', 'name', 'date'])

<div {{ $attributes->merge(['class' => 'bg-white shadow-sm rounded-md py-4 px-6 flex items-center space-x-5 hover:shadow-md']) }}>
    <div class="w-12 h-12 rounded-full flex-shrink-0 flex-grow-0">
        <img src="{{ $src }}" alt="{{ $name ?? $alt }} avatar" class="w-full rounded-full">
    </div>
    <div class="flex-1 overflow-hidden">
        <h5 class="font-semibold truncate">
            <a href="{{ $href }}" class="text-gray-700 hover:text-gray-900">
                <strong>{{ $name }}</strong> has been filled the survey.
            </a>
        </h5>
        <p class="text-xs text-gray-500">{{ $date }}</p>
    </div>
</div>
