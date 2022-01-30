<div class="flex items-center relative mt-3 md:mt-0">
    <x-input wire:model.debounce.500ms="search"
             type="search" class="mr-4 text-sm py-1.5 w-full md:w-72" placeholder="Search survey ..."/>

    <div x-data="{showFiltersOption: false}"
         x-on:click.away="showFiltersOption=false"
         class="mr-4">
        <x-button-secondary x-on:click="showFiltersOption=~showFiltersOption"
                            class="px-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
            </svg>
        </x-button-secondary>

        <div x-show="showFiltersOption"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="transform opacity-0 scale-95"
             x-transition:enter-end="transform opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="transform opacity-100 scale-100"
             x-transition:leave-end="transform opacity-0 scale-95"
             class="absolute w-64 top-12 right-0 md:right-44 z-10 bg-white rounded-md shadow-xl py-2"
             style="display: none">
            <div
                class="block py-2 px-2.5 text-xs uppercase font-bold border-b-2 border-gray-200">{{ __('Status') }}</div>
            <x-dropdown-link wire:click.prevent="$set('filter', 'active')"
                             href="{{ route('lecturer.surveys.index', ['filter' => 'active']) }}"
                             class="{{ $filter === 'active' ? 'bg-gray-100 text-gray-700 font-semibold' : '' }}">
                Active
            </x-dropdown-link>
            <x-dropdown-link wire:click.prevent="$set('filter', 'inactive')"
                             href="{{ route('lecturer.surveys.index', ['filter' => 'inactive']) }}"
                             class="{{ $filter === 'inactive' ? 'bg-gray-100 text-gray-700 font-semibold' : '' }}">
                Inactive
            </x-dropdown-link>
            <x-dropdown-link wire:click.prevent="$set('filter', 'expired')"
                             href="{{ route('lecturer.surveys.index', ['filter' => 'expired']) }}"
                             class="{{ $filter === 'expired' ? 'bg-gray-100 text-gray-700 font-semibold' : '' }}">
                Expired
            </x-dropdown-link>

            <div class="h-1 my-2 w-full bg-gray-100"></div>

            <div
                class="block py-2 px-2.5 text-xs uppercase font-bold border-b-2 border-gray-200">{{ __('Sort') }}</div>
            <x-dropdown-link wire:click.prevent="$set('sort', 'latest')"
                             href="{{ route('lecturer.surveys.index', ['sort' => 'latest']) }}"
                             class="{{ $sort === 'latest' ? 'bg-gray-100 text-gray-700 font-semibold' : '' }}">
                {{ __('Latest') }}
            </x-dropdown-link>
            <x-dropdown-link wire:click.prevent="$set('sort', 'oldest')"
                             href="{{ route('lecturer.surveys.index', ['sort' => 'oldest']) }}"
                             class="{{ $sort === 'oldest' ? 'bg-gray-100 text-gray-700 font-semibold' : '' }}">
                {{ __('Oldest') }}
            </x-dropdown-link>

            @if($filter)
                <div class="h-1 my-2 w-full bg-gray-100"></div>

                <x-dropdown-link wire:click.prevent="$set('filter', '')"
                                 href="{{ route('lecturer.surveys.index') }}"
                                 class="text-red-600 font-semibold">
                    {{ __('Reset') }}
                </x-dropdown-link>
            @endif
        </div>
    </div>

    <x-surveys.create-cta href="" class="hidden md:inline-block"/>

</div>
