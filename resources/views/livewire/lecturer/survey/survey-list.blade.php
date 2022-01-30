<div>
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

    <div class="mt-4">
        {{ $this->surveys->links() }}
    </div>
</div>
