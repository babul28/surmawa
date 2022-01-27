<x-college.menu>
    <x-college.item :active="$step === 'biodata'">
        <x-college.item-icon :active="$step === 'biodata'" :done="in_array($step, ['questionnaire', 'result'])">
            1
        </x-college.item-icon>
        <x-college.item-label>
            Biodata
        </x-college.item-label>
    </x-college.item>
    <x-college.item :active="$step === 'questionnaire'">
        <x-college.item-icon :active="$step === 'questionnaire'" :done="$step === 'result'">
            2
        </x-college.item-icon>
        <x-college.item-label>
            Isi Kuinioner
        </x-college.item-label>
    </x-college.item>
    <x-college.item :active="$step === 'result'">
        <x-college.item-icon :active="$step === 'result'">
            3
        </x-college.item-icon>
        <x-college.item-label>
            Umpan Balik
        </x-college.item-label>
    </x-college.item>

</x-college.menu>
