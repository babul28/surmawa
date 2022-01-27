<div {{ $attributes->merge(['class' => 'border-b-2 border-gray-100 p-4 flex justify-between items-center']) }}>
    <h1 class="text-gray-700 font-bold">{{ $slot }}</h1>
    <x-button-ignored x-on:click="open=false" class="border-none">
        <x-icons.close class="text-gray-800"/>
    </x-button-ignored>
</div>
