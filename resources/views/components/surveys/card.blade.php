@props(['title', 'code', 'href', 'status', 'color'])

@php
    switch ($status){
    case 'Active':
    case 'active':
        $badgeBgColor = 'bg-green-100';
        $badgeBgColorPrimary = 'bg-green-600';
        $badgeTextColor = 'text-green-600';
        break;
    case 'Inactive':
    case 'inactive':
        $badgeBgColor = 'bg-gray-100';
        $badgeBgColorPrimary = 'bg-gray-600';
        $badgeTextColor = 'text-gray-600';
        break;
    case 'Expired':
    case 'expired':
    default:
        $badgeBgColor = 'bg-red-100';
        $badgeBgColorPrimary = 'bg-red-600';
        $badgeTextColor = 'text-red-600';
    }

    switch($color){
    case 'pink':
        $bgColor = 'bg-pink-200';
        $bgColorMuted = 'bg-pink-100';
        $textColor = 'text-pink-500';
        $bgColorPrimary = 'bg-pink-500';
        $textColorPrimary = 'text-white';
        $buttonClass = 'hover:bg-pink-700 focus:bg-pink-800 active:bg-pink-900 focus:ring-pink-300 focus:border-pink-900';
        break;
    case 'cyan':
        $bgColor = 'bg-cyan-200';
        $bgColorMuted = 'bg-cyan-100';
        $textColor = 'text-cyan-500';
        $bgColorPrimary = 'bg-cyan-500';
        $textColorPrimary = 'text-white';
        $buttonClass = 'hover:bg-cyan-700 focus:bg-cyan-800 active:bg-cyan-900 focus:ring-cyan-300 focus:border-cyan-900';
        break;
    case 'orange':
        $bgColor = 'bg-orange-200';
        $bgColorMuted = 'bg-orange-100';
        $textColor = 'text-orange-500';
        $bgColorPrimary = 'bg-orange-500';
        $textColorPrimary = 'text-white';
        $buttonClass = 'hover:bg-orange-700 focus:bg-orange-800 active:bg-orange-900 focus:ring-orange-300 focus:border-orange-900';
        break;
    case 'blue':
    default:
        $bgColor = 'bg-blue-200';
        $bgColorMuted = 'bg-blue-100';
        $textColor = 'text-blue-500';
        $bgColorPrimary = 'bg-blue-500';
        $textColorPrimary = 'text-white';
        $buttonClass = 'hover:bg-blue-700 focus:bg-blue-800 active:bg-blue-900 focus:ring-blue-300 focus:border-blue-900';
    }
@endphp

<div
    class="rounded-lg bg-white shadow-sm p-4 relative hover:shadow-md flex flex-col">
    <div class="flex-shrink flex-grow">
        <div class="flex w-100 space-x-4 items-center mb-6">
            <div
                class="w-20 h-20 rounded-full {{ $bgColor }} {{ $textColor }} flex-grow-0 flex-shrink-0 flex justify-center items-center">
                <x-icons.folder-alt class="w-12 h-12"/>
            </div>

            <div class="flex-1 overflow-hidden">
                <div class="flex space-x-2 mb-2">
                    <h2 class="flex-1 text-base text-gray-700 line-clamp-2">{{ $title }}</h2>
                    <div class="flex-grow-0 flex-shrink-0">
                        <p class="{{ $badgeBgColor }} {{ $badgeTextColor }} font-semibold px-3 py-1 rounded-md text-xs flex items-center justify-center space-x-2">
                            <span class="w-1.5 h-1.5 {{ $badgeBgColorPrimary }} rounded-full inline-block"></span>
                            <span>{{ Str::title($status) }}</span>
                        </p>
                    </div>
                </div>
                <div x-data="{input: `{{ $code }}`}" class="text-3xl font-bold text-gray-800">
                    #<span class="select-all">{{ $code }}</span>
                    <x-icons.copy x-on:click="$clipboard(input)"
                                  class="w-5 h-5 text-gray-300 hover:text-gray-700 cursor-pointer"/>
                </div>
            </div>
        </div>
    </div>
    <div class="{{ $bgColorMuted }} rounded-md px-4 py-2 flex justify-between space-x-4">
        <div x-data="{showQRCode: false}"
             x-on:click="showQRCode=true"
             x-on:click.away="showQRCode=false"
             x-on:mouseover="showQRCode=true"
             x-on:mouseleave="showQRCode=false"
             class="w-8 h-8 {{ $bgColorPrimary }} {{ $textColorPrimary }} rounded-md flex justify-center items-center cursor-pointer relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-current" fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
            </svg>

            <div
                x-show="showQRCode"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="absolute left-10 xl:left-auto -top-16 z-10 bg-white text-blue-600 shadow-xl rounded-lg w-44 w-44 p-2"
                style="display: none"
            >
                <div x-on:click="Livewire.emit('openModal', 'qr-code-detail-modal', { code: `{{ $code }}` })">
                    {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(160)->generate(route('college.home', ['code' => $code])); !!}
                </div>

                <a href="{{ route('lecturer.surveys.qrcode', $code) }}" target="_blank"
                   class="block mt-3 text-sm font-semibold flex items-center justify-center hover:text-blue-700">
                    Download
                    <x-icons.download class="w-4 h-4 ml-1"/>
                </a>

            </div>

        </div>
        <div class="flex-1 flex justify-end">
            <x-link-button href="{{ $href }}"
                           class="{{ $bgColorPrimary }} {{ $buttonClass }}">
                Details
            </x-link-button>
        </div>
    </div>
</div>
