<x-modal.container>
    <x-slot name="body">
        <div class="my-4">
            <p class="text-xl font-bold text-gray-800 text-center">Apakah Kamu Sudah Yakin Dengan Jawaban Kamu?</p>
        </div>
    </x-slot>
    <x-slot name="footer">
        <div class="flex space-x-4">
            <x-button-secondary wire:click="$emit('closeModal')" type="button" class="flex-1 h-12 justify-center text-sm font-bold">
                Batalkan
            </x-button-secondary>
            <x-button wire:click="confirm" type="button" class="flex-1 h-12 justify-center text-sm font-bold">
                Ya, Saya Yakin
            </x-button>
        </div>
    </x-slot>
</x-modal.container>
