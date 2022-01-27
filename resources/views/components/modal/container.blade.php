<div {{ $attributes }}>
    @if($header ?? false)
        <x-modal.header>
            {{ $header ?? '' }}
        </x-modal.header>
    @endif

    <x-modal.body>
        {{ $body }}
    </x-modal.body>

    @if($footer ?? false)
        <x-modal.footer>
            {{ $footer ?? '' }}
        </x-modal.footer>
    @endif
</div>
