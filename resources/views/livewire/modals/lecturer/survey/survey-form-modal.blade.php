<x-modal.container>
    <x-slot name="header">
        {{ __('Create New Survey') }}
    </x-slot>

    <x-slot name="body">
        <form class="space-y-4">
            <div class="md:flex md:items-center md:space-x-4">
                <x-label value="Name" class="md:flex-grow-0 md:flex-shrink-0 md:w-36 mb-1 md:mb-0"/>
                <div class="flex-1">
                    <x-input wire:model.debounce.500ms="state.name"
                             type="text" name="name" id="name" class="w-full"
                             :is-error="$errors->has('name')"/>
                    @error('name')
                    <span class="text-red-600 text-sm inline-block mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="md:flex md:items-center md:space-x-4">
                <x-label value="University" class="md:flex-grow-0 md:flex-shrink-0 md:w-36 mb-1 md:mb-0"/>
                <div class="flex-1">
                    <x-input wire:model.debounce.500ms="state.university"
                             type="text" name="university" id="university" class="w-full"
                             :is-error="$errors->has('university')"/>
                    @error('university')
                    <span class="text-red-600 text-sm inline-block mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="md:flex md:items-center md:space-x-4">
                <x-label value="Faculty" class="md:flex-grow-0 md:flex-shrink-0 md:w-36 mb-1 md:mb-0"/>
                <div class="flex-1">
                    <x-input wire:model.debounce.500ms="state.faculty"
                             type="text" name="faculty" id="faculty" class="w-full"
                             :is-error="$errors->has('faculty')"/>
                    @error('faculty')
                    <span class="text-red-600 text-sm inline-block mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="md:flex md:items-center md:space-x-4">
                <x-label value="Department" class="md:flex-grow-0 md:flex-shrink-0 md:w-36 mb-1 md:mb-0"/>
                <div class="flex-1">
                    <x-input wire:model.debounce.500ms="state.department"
                             type="text" name="department" id="department" class="w-full"
                             :is-error="$errors->has('department')"/>
                    @error('department')
                    <span class="text-red-600 text-sm inline-block mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="md:flex md:items-center md:space-x-4">
                <x-label value="Starts on" class="md:flex-grow-0 md:flex-shrink-0 md:w-36 mb-1 md:mb-0"/>
                <div class="flex-1">
                    <div class="flex space-x-2">
                        <div class="flex-1">
                            <x-input wire:model.debounce.500ms="state.date_starting_at"
                                     min="{{ $minDates['date_starting_at'] }}"
                                     type="date" name="date_starting_at" id="date_starting_at" class="w-full"
                                     :is-error="$errors->has('date_starting_at')"/>
                        </div>
                        <div class="flex-1">
                            <x-input wire:model.debounce.500ms="state.time_starting_at"
                                     min="{{ $minDates['time_starting_at'] }}"
                                     type="time" name="time_starting_at" id="time_starting_at" class="w-full"
                                     :is-error="$errors->has('time_starting_at')"/>
                        </div>
                    </div>
                    @error('starting_at')
                    <span class="text-red-600 text-sm inline-block mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="md:flex md:items-center md:space-x-4">
                <x-label value="Expires on" class="md:flex-grow-0 md:flex-shrink-0 md:w-36 mb-1 md:mb-0"/>
                <div class="flex-1">
                    <div class="flex space-x-2">
                        <div class="flex-1">
                            <x-input wire:model.debounce.500ms="state.date_expired_at"
                                     min="{{ $minDates['date_expired_at'] }}"
                                     type="date" name="date_expired_at" id="date_expired_at" class="w-full"
                                     :is-error="$errors->has('date_expired_at')"/>
                        </div>
                        <div class="flex-1">
                            <x-input wire:model.debounce.500ms="state.time_expired_at"
                                     min="{{ $minDates['time_expired_at'] }}"
                                     type="time" name="time_expired_at" id="time_expired_at" class="w-full"
                                     :is-error="$errors->has('time_expired_at')"/>
                        </div>
                    </div>
                    @error('expired_at')
                    <span class="text-red-600 text-sm inline-block mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <div class="flex justify-end space-x-4">
            <x-button-ignored wire:click="$emit('closeModal')">Cancel</x-button-ignored>
            <x-button wire:click="submit">Submit</x-button>
        </div>
    </x-slot>
</x-modal.container>
