<x-modal.container>
    <x-slot name="body">
        <p x-data="{code: `{{ $code }}`}" class="text-center mb-4 text-2xl font-bold text-gray-800 align-middle">
            #{{ $code }}
            <x-icons.copy x-on:click="$clipboard(code)"
                          class="w-5 h-5 text-gray-400 hover:text-gray-800 cursor-pointer"/>
        </p>

        <div class="flex justify-center align-center mb-4">
            {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(350)->errorCorrection('H')->generate(route('college.home', ['code' => $code])); !!}
        </div>

        <a href="{{ route('lecturer.surveys.qrcode', $code) }}" target="_blank"
           class="block mt-3 bg-gray-100 rounded-md px-4 py-1.5 text-gray-600 font-semibold hover:text-gray-800 hover:bg-gray-200 flex items-center justify-center">
            Download
            <x-icons.download class="w-4 h-4 ml-1"/>
        </a>

    </x-slot>
</x-modal.container>
