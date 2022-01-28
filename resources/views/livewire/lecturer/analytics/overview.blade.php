<div>
    <div class="mt-6 flex justify-between items-center">
        <h3 class="text-gray-600">Overview</h3>
        <x-dropdown align="right">
            <x-slot name="trigger">
                <button
                    class="flex bg-white px-4 py-2 rounded-md items-center text-sm font-semibold text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out">
                    <div>{{ $month }}</div>

                    <div class="ml-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                </button>
            </x-slot>
            <x-slot name="content">
                <x-dropdown-link wire:click.prevent="$set('month', 'January')"
                                 href=""
                                 class="{{ $month === 'January' ? 'bg-gray-100' : '' }}">
                    January
                </x-dropdown-link>
                <x-dropdown-link wire:click.prevent="$set('month', 'February')"
                                 href=""
                                 class="{{ $month === 'February' ? 'bg-gray-100' : '' }}">
                    February
                </x-dropdown-link>
                <x-dropdown-link wire:click.prevent="$set('month', 'March')"
                                 href=""
                                 class="{{ $month === 'March' ? 'bg-gray-100' : '' }}">
                    March
                </x-dropdown-link>
                <x-dropdown-link wire:click.prevent="$set('month', 'April')"
                                 href=""
                                 class="{{ $month === 'April' ? 'bg-gray-100' : '' }}">
                    April
                </x-dropdown-link>
                <x-dropdown-link wire:click.prevent="$set('month', 'May')"
                                 href=""
                                 class="{{ $month === 'May' ? 'bg-gray-100' : '' }}">
                    May
                </x-dropdown-link>
                <x-dropdown-link wire:click.prevent="$set('month', 'June')"
                                 href=""
                                 class="{{ $month === 'June' ? 'bg-gray-100' : '' }}">
                    June
                </x-dropdown-link>
                <x-dropdown-link wire:click.prevent="$set('month', 'July')"
                                 href=""
                                 class="{{ $month === 'July' ? 'bg-gray-100' : '' }}">
                    July
                </x-dropdown-link>
                <x-dropdown-link wire:click.prevent="$set('month', 'August')"
                                 href=""
                                 class="{{ $month === 'August' ? 'bg-gray-100' : '' }}">
                    August
                </x-dropdown-link>
                <x-dropdown-link wire:click.prevent="$set('month', 'September')"
                                 href=""
                                 class="{{ $month === 'September' ? 'bg-gray-100' : '' }}">
                    September
                </x-dropdown-link>
                <x-dropdown-link wire:click.prevent="$set('month', 'October')"
                                 href=""
                                 class="{{ $month === 'October' ? 'bg-gray-100' : '' }}">
                    October
                </x-dropdown-link>
                <x-dropdown-link wire:click.prevent="$set('month', 'November')"
                                 href=""
                                 class="{{ $month === 'November' ? 'bg-gray-100' : '' }}">
                    November
                </x-dropdown-link>
                <x-dropdown-link wire:click.prevent="$set('month', 'December')"
                                 href=""
                                 class="{{ $month === 'December' ? 'bg-gray-100' : '' }}">
                    December
                </x-dropdown-link>
            </x-slot>
        </x-dropdown>
    </div>

    <div class="my-6 grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <livewire:lecturer.analytics.total-survey :selected-month="$month" wire:key="total-survey"/>

        <livewire:lecturer.analytics.active-survey :selected-month="$month" wire:key="active-survey"/>

        <livewire:lecturer.analytics.total-respondent :selected-month="$month" wire:key="total-respondent"/>

        <livewire:lecturer.analytics.total-report :selected-month="$month" wire:key="total-report"/>
    </div>
</div>
