<div x-data="modalData()"
     x-init="initModal(); modalListener(); $watch('open', watchModal);"
     x-show="open"
     class="fixed z-50 inset-0 overflow-y-auto" style="display: none">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div x-on:click="open = false"
             class="fixed inset-0 transition-opacity"
             aria-hidden="true">
            <div class="absolute inset-0 bg-gray-800 opacity-50"></div>
        </div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        @php
            $max_width_arr = [
                'lg' => 'sm:max-w-lg',
                'xl' => 'sm:max-w-xl',
                '2xl' => 'sm:max-w-2xl',
                '3xl' => 'sm:max-w-2xl lg:max-w-3xl',
                '4xl' => 'sm:max-w-2xl lg:max-w-4xl',
                '5xl' => 'sm:max-w-2xl lg:max-w-5xl',
                '6xl' => 'sm:max-w-2xl lg:max-w-6xl',
            ]
        @endphp

        <div x-show="open"
             class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle {{ $max_width_arr[$maxWidth] }} w-full"
             role="dialog" aria-modal="true" aria-labelledby="modal-headline"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform scale-90"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-90" style="display: none">

            @if ($modalBodyComponent)
                @livewire($modalBodyComponent, $data, key($modalBodyComponent))
            @endif

        </div>
    </div>

    <script>
        function modalData() {
            return {
                open: @entangle('open').defer,
                modalListener() {
                    document.addEventListener('keydown', (event) => {
                        if (event.code === 'Escape' && this.open) {
                            this.open = false;
                        }
                    })
                },
                watchModal(value) {
                    const bodyEl = document.querySelector('body');
                    if (value) {
                        bodyEl.classList.add('overflow-hidden');
                    } else {
                        setTimeout(() => {
                        @this.emit('selfCloseModal');
                        }, 200);
                        bodyEl.classList.remove('overflow-hidden');
                    }
                },
                initModal() {
                    Livewire.on('openModal', () => {
                        setTimeout(() => {
                            this.open = true;
                        }, 150);
                    });

                    Livewire.on('closeModal', () => {
                        this.open = false;
                        setTimeout(() => {
                        @this.emit('selfCloseModal');
                        }, 200);
                    });
                }
            }
        }
    </script>
</div>
