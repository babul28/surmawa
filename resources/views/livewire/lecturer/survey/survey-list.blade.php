<div>
    @if($this->surveys->count())
        <div class="mt-6 space-y-4 md:space-y-0 md:grid md:grid-cols-2 md:gap-4 lg:grid-cols-3 lg:gap-4">
            @foreach($this->surveys as $survey)
                @php
                    $color = ['blue', 'pink', 'cyan', 'orange'][$survey->id % 4];
                @endphp
                <x-surveys.card :title="$survey->name"
                                :code="$survey->survey_code"
                                :color="$color"
                                :status="$survey->status_desc"
                                :href="route('lecturer.surveys.index', $survey->id)"
                                :key="$survey->id"/>
            @endforeach
        </div>
    @else
        <div class="mt-6 flex flex-col justify-end items-center h-72 md:h-80">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-24 xl:h-32 w-24 xl:w-32 text-gray-500 block" fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>

            <p class="mt-4 text-gray-600 text-lg md:text-xl mx-4 text-center">
                Upps, The survey you are looking for does not exist!
            </p>

        </div>
    @endif

    <div class="mt-4">
        {{ $this->surveys->links() }}
    </div>
</div>
