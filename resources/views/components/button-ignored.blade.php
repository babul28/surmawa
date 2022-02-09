<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-2 py-1 rounded-md font-semibold text-gray-500 border border-transparent hover:border-gray-300 focus:outline-none focus:ring ring-gray-200 disabled:opacity-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
