<div class="relative flex-1">
    <div class="relative">
        <ul class="flex space-x-2 overflow-x-auto scrollbar-hide">
            @foreach($answers as $answer)
                <x-quistionare.number wire:click="$set('currentQuestion', {{ $loop->index }})"
                                      :active="$loop->index === $currentQuestion"
                                      :filled="(bool)$answer">
                    {{ $loop->iteration }}
                </x-quistionare.number>
            @endforeach
        </ul>
        <div class="absolute w-4 lg:w-6 2xl:w-8 right-0 top-0 bottom-0 bg-gradient-to-l from-gray-200"></div>
    </div>

    <div class="relative mt-3">
        <div class="overflow-hidden h-2 text-xs flex rounded bg-gray-300">
            <div style="width: {{ $this->progressInPercent }}%"
                 class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-gray-700"></div>
        </div>
    </div>

    <h2 class="text-xl md:text-2xl text-gray-800 font-bold mt-8">
        Isi Kuisioner
    </h2>
    <p class="text-gray-600">Pilih salah satu jawaban yang menurutmu paling sesuai</p>

    <div class="my-8 md:my-12">
        <div class="my-6" style="min-height: 200px">
            <h3 class="text-2xl md:text-3xl text-gray-800 font-semibold text-center">
                {{ $questions[$currentQuestion]['question'] }}
            </h3>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <x-button-secondary type="button"
                                wire:click="$set('answers.{{ $currentQuestion }}', 4)"
                                :active="$answers[$currentQuestion] === 4"
                                class="justify-center h-14 md:h-12 text-sm font-bold">
                Sangat Setuju
            </x-button-secondary>
            <x-button-secondary type="button"
                                wire:click="$set('answers.{{ $currentQuestion }}', 3)"
                                :active="$answers[$currentQuestion] === 3"
                                class="justify-center h-14 md:h-12 text-sm font-bold">
                Setuju
            </x-button-secondary>
            <x-button-secondary type="button"
                                wire:click="$set('answers.{{ $currentQuestion }}', 2)"
                                :active="$answers[$currentQuestion] === 2"
                                class="justify-center h-14 md:h-12 text-sm font-bold">
                Tidak Setuju
            </x-button-secondary>
            <x-button-secondary type="button"
                                wire:click="$set('answers.{{ $currentQuestion }}', 1)"
                                :active="$answers[$currentQuestion] === 1"
                                class="justify-center h-14 md:h-12 text-sm font-bold">
                Sangat Tidak Setuju
            </x-button-secondary>
        </div>
    </div>

    <div class="md:absolute md:bottom-0 md:left-0 md:right-0 flex justify-between">
        <x-button
            wire:click="previous"
            :disabled="!$currentQuestion"
            type="button" class="h-12 w-44 justify-between">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Sebelumnya
        </x-button>
        @if((count($this->alreadyAnswered) === count($questions)) && $currentQuestion === count($questions) - 1)
            <x-button
                wire:click="submit"
                type="button" class="h-12 w-44 justify-center">
                Submit
            </x-button>

        @else
            <x-button
                wire:click="next"
                :disabled="$currentQuestion === count($questions) - 1"
                type="button" class="h-12 w-44 justify-between">
                Selanjutnya
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </x-button>
        @endif
    </div>

</div>
