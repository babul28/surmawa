<div wire:init="initChart">
    <div class="flex justify-between items-center">
        <h3 class="text-gray-600">Analytics</h3>

        <x-dropdown align="right">
            <x-slot name="trigger">
                <button
                    class="flex bg-white px-4 py-2 rounded-md items-center text-sm font-semibold text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out">
                    <div>{{ $year }}</div>

                    <div class="ml-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                </button>
            </x-slot>
            <x-slot name="content">
                <x-dropdown-link wire:click.prevent="$set('year', '2022')" href=""
                                 class="{{ $year === '2022' ? 'bg-gray-100' : '' }}">
                    2022
                </x-dropdown-link>
                <x-dropdown-link wire:click.prevent="$set('year', '2021')" href=""
                                 class="{{ $year === '2021' ? 'bg-gray-100' : '' }}">
                    2021
                </x-dropdown-link>
                <x-dropdown-link wire:click.prevent="$set('year', '2020')" href=""
                                 class="{{ $year === '2020' ? 'bg-gray-100' : '' }}">
                    2020
                </x-dropdown-link>
                <x-dropdown-link wire:click.prevent="$set('year', '2019')" href=""
                                 class="{{ $year === '2019' ? 'bg-gray-100' : '' }}">
                    2019
                </x-dropdown-link>
                <x-dropdown-link wire:click.prevent="$set('year', '2018')" href=""
                                 class="{{ $year === '2018' ? 'bg-gray-100' : '' }}">
                    2018
                </x-dropdown-link>
            </x-slot>
        </x-dropdown>
    </div>

    <div class="bg-white p-4 shadow-sm rounded-md mt-6">
        <canvas id="myChart" height="175"></canvas>
    </div>
</div>
