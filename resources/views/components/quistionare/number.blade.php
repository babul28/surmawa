@props(['filled' => false, 'active' => false])

@php
    $activeClass = $active ? 'bg-gray-700' : '';
    $filledClass = $filled ? !$active ? 'bg-green-700 border-green-700 hover:bg-green-600 hover:border-green-600' : '' : '';
    $defaultTextColor = $active || $filled ? 'text-white' : 'text-gray-700';
    $class = "flex-grow-0 flex-shrink-0 inline-block w-10 h-10 text-center leading-10 cursor-pointer rounded border border-gray-500 font-semibold hover:bg-gray-800 hover:border-gray-800 hover:text-white $filledClass $activeClass $defaultTextColor"
@endphp

<li {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</li>
