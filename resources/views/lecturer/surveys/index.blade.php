<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Surveys') }}
        </h2>
    </x-slot>

    <x-container>
        <div class="md:flex md:justify-between md:items-center">
            <div class="flex justify-between">
                <h3 class="text-gray-600">Survey List</h3>
                
                <x-surveys.create-cta href="" class="md:hidden"/>
            </div>

            <livewire:lecturer.survey.survey-filter/>

        </div>

        <livewire:lecturer.survey.survey-list/>

    </x-container>

    <livewire:modal/>
</x-app-layout>
