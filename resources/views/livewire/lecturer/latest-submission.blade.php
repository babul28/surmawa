<div class="">
    <div class="space-y-2">
        @foreach($this->latestSubmission as $item)
            <x-activities.item src="https://ui-avatars.com/api/?background=random&name={{ $item->name }}"
                               alt="avatar"
                               :name="$item->name"
                               :date="$item->created_at->diffForHumans()"
                               href=""/>
        @endforeach
    </div>

    @if($this->latestSubmission->count() === 5)
        <div class="mt-6 flex justify-center">
            <a href="" class="text-gray-600 hover:text-blue-500">
                Show more
                <x-icons.arrow-right class="w-6 h-6"/>
            </a>
        </div>
    @endif
</div>
