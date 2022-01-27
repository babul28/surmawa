<div>
    <h3 class="text-2xl font-bold text-gray-800">Biodata</h3>
    <p class="text-gray-700 mb-6">Lengkapi biodatamu sebelum mengisi kuisioner.</p>

    <form wire:submit.prevent="submitBiodata" autocomplete="off">
        <div class="mb-4 md:mb-5">
            <x-label class="font-bold" for="name">Nama Lengkap</x-label>
            <x-input wire:model.debounce.500ms="name" type="text" name="name" id="name"
                     class="block mt-1 w-full"
                     :is-error="$errors->has('name')"
                     aria-label="name" autofocus/>
            @error('name')
            <span class="text-red-600 mt-1 text-sm inline-block">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4 md:mb-5">
            <x-label class="font-bold" for="nim">NIM</x-label>
            <x-input wire:model.debounce.500ms="nim" type="number" name="nim" id="nim" class="block mt-1 w-full"
                     :is-error="$errors->has('nim')"
                     aria-label="nim"/>
            @error('nim')
            <span class="text-red-600 mt-1 text-sm inline-block">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-8 md:mb-10">
            <span class="font-bold text-gray-700 text-sm">Jenis Kelamin</span>
            <div class="mt-2">
                <label class="inline-flex items-center">
                    <input wire:model="gender" type="radio" name="gender" value="L">
                    <span class="text-gray-700 ml-2">Laki-laki</span>
                </label>
                <label class="inline-flex items-center ml-6">
                    <input wire:model="gender" type="radio" name="gender" value="P">
                    <span class="text-gray-700 ml-2">Perempuan</span>
                </label>
            </div>
            @error('gender')
            <span class="text-red-600 mt-1 text-sm inline-block">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex justify-end">
            <x-button type="submit" class="block w-full lg:w-2/6 xl:1/4 justify-center mb-4 py-4">Selanjutnya</x-button>
        </div>
    </form>
</div>
