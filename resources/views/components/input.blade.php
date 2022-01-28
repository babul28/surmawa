@props(['disabled' => false, 'isError' => false])

@php
    $baseClass = 'rounded-md shadow-sm border-gray-300 focus:ring focus:ring-opacity-50';
    $border = $isError ? 'border-red-400 focus:border-red-400 focus:ring-red-300' : 'focus:border-indigo-300 focus:ring-indigo-200';
    $classList = "$baseClass $border"
@endphp

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => $classList]) !!}>
