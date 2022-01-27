@props(['active' => false])

@php
    $additionalClass = $active ? 'border-transparent text-white bg-gray-700 hover:bg-gray-600 active:bg-gray-900 focus:border-gray-600 ring-gray-300' : 'border-gray-400 text-gray-600 hover:bg-gray-700 hover:text-white active:bg-gray-900 focus:border-gray-600 ring-gray-300';
    $class = 'inline-flex items-center px-4 py-2 border rounded-md font-semibold text-xs uppercase tracking-wide focus:outline-none focus:ring disabled:opacity-25 transition ease-in-out duration-150'
@endphp

<button {{ $attributes->merge(['type' => 'button', 'class' => $class . ' ' . $additionalClass]) }}>
    {{ $slot }}
</button>
