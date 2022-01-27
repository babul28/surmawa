<x-college-layout>
    <div class="min-h-screen flex flex-col md:flex-row">
        <x-college.menu>
            <x-college.item>
                <x-college.item-icon done>
                    1
                </x-college.item-icon>
                <x-college.item-label>
                    Biodata
                </x-college.item-label>
            </x-college.item>
            <x-college.item>
                <x-college.item-icon done>
                    2
                </x-college.item-icon>
                <x-college.item-label>
                    Isi Kuinioner
                </x-college.item-label>
            </x-college.item>
            <x-college.item active>
                <x-college.item-icon active done>
                    3
                </x-college.item-icon>
                <x-college.item-label>
                    Umpan Balik
                </x-college.item-label>
            </x-college.item>
        </x-college.menu>

        <div
            class="md:min-h-screen flex flex-col bg-gray-200 md:w-3/4 flex-1 py-8 px-6 md:pt-24 md:px-14 lg:px-32 xl:px-64 items-center justify-center">
            <img src="{{ asset('images/undraw_education_f8ru.png') }}" alt="Images" class="w-96">
            <h2 class="text-2xl font-bold text-gray-700 my-8">Terima kasih sudah memberikan tanggapan anda</h2>
            <a href="{{ route('college.home') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Kembali Ke Home
            </a>
        </div>
    </div>
</x-college-layout>
