<x-college-layout>
    <div class="min-h-screen flex flex-col lg:flex-row">
        <div class="w-full lg:w-2/3 flex flex-col">
            <div class="px-8 py-6">
                <a href="/">
                    <x-application-logo class="w-36 h-16 fill-current text-gray-500"/>
                </a>
            </div>
            <div x-data="{
                activeIndex: 0,
                items: [
                    'Isi kuisioner yang telah disediakan dengan sungguh - sungguh dan jangan ada satupun yang terlewat',
                    'Isi informasi lengkap tentang data pribadimu untuk dapat melanjutkan ke tahap selanjutnya, pastikan diisi dengan lengkap',
                    'Kode ruang akan diberikan oleh admin dan silahkan diisi kode tersebut dibilah sebelah kanan layar untuk memasuki ruangan'
                ],
                incrementActiveIndex() {
                    if (this.activeIndex + 1 > 2) {
                        return this.activeIndex = 0
                    }

                    return this.activeIndex += 1
                },
                decrementActiveIndex() {
                    if (this.activeIndex - 1 < 0) {
                        return this.activeIndex = 2
                    }

                    return this.activeIndex -= 1
                }
            }"
                 class="flex-1 flex flex-col px-4 pb-8 md:py-16 lg:py-0 lg:container items-center justify-center relative">
                <h1 class="text-4xl uppercase font-bold text-gray-800 mb-12 lg:mb-20">Selamat Datang Mahasiswa</h1>

                <div class="h-72 w-72 overflow-hidden mb-12">
                    <x-college.landing-page-1 x-bind:class="{'hidden': activeIndex !== 0}"/>
                    <x-college.landing-page-2 x-bind:class="{'hidden': activeIndex !== 1}"/>
                    <x-college.landing-page-3 x-bind:class="{'hidden': activeIndex !== 2}"/>
                </div>

                <div class="w-full md:w-2/3 lg:w-full xl:w-2/3 h-20 overflow-hidden mb-4">
                    <template x-for="(item, key) in items" x-key="item">
                        <p x-show="activeIndex === key" class="text-lg text-center" x-text="item"></p>
                    </template>
                </div>

                <div class="w-full flex justify-center">
                    <template x-for="(item, key) in items" :key="item">
                    <span :class="{'bg-green-700': activeIndex === key, 'bg-gray-400': activeIndex !== key}"
                          class="inline-block w-5 h-2 rounded-full m-1"></span>
                    </template>
                </div>

                <div class="absolute top-50 left-5 right-5 md:top-50 md:left-20 md:right-20 flex justify-between">
                    <button x-on:click="decrementActiveIndex()"
                            class="w-10 h-10 bg-gray-300 opacity-50 rounded-md focus:outline-none hover:bg-gray-400 hover:text-white font-bold text-xl">
                        &lt;
                    </button>
                    <button x-on:click="incrementActiveIndex()"
                            class="w-10 h-10 bg-gray-300 opacity-50 rounded-md focus:outline-none hover:bg-gray-400 hover:text-white font-bold text-xl">
                        &gt;
                    </button>
                </div>
            </div>
        </div>
        {{-- End Left Section --}}

        {{-- Right Section --}}
        <div class="w-full lg:w-2/3 xl:w-1/3 bg-gray-800 flex flex-col justify-center items-center px-4 py-16 lg:p-8">
            @error('survey_code*')
            <div class="w-full bg-red-700 px-2 py-3 rounded-lg text-white flex items-stretch mb-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="w-11/12 pl-2">{{ $message }}</span>
            </div>
            @enderror
            <form x-data="otpForm()" action="{{ route('college.join.survey') }}" method="POST" autocomplete="off">
                <div class="w-full mx-auto md:w-2/3 lg:w-full h-52 bg-gray-600 rounded-xl p-6">
                    <h3 class="text-lg uppercase font-medium text-gray-100 text-center">Masukkan Kode Kelas</h3>
                    @csrf
                    <div class="flex flex-col items-center mt-6">
                        <div class="flex justify-between">
                            <template x-for="(input, index) in length" :key="index">
                                <input :x-ref="index" x-on:input="handleInput($event)" x-on:paste="handlePaste($event)"
                                       x-on:keydown.backspace="$event.target.value || handleBackspace($event.target.getAttribute('x-ref'))"
                                       type="text"
                                       class="w-1/6 h-20 mx-1 rounded-lg bg-gray-500 text-center font-semibold text-white text-3xl placeholder-gray-400 focus:ring-2 focus:ring-gray-300 focus:border-transparent"
                                       maxlength=1>
                            </template>
                        </div>
                    </div>
                    <input x-model="value" type="hidden" name="survey_code">
                </div>
                <div class="text-center mt-8">
                    <button type="submit"
                            class="px-20 py-4 w-full md:w-2/3 bg-gray-100 rounded-md text-lg uppercase font-bold hover:bg-gray-50">
                        Join
                    </button>
                </div>
            </form>
        </div>
        {{-- End Right Section --}}
    </div>

    <script>
        function otpForm() {
            return {
                length: 6,
                value: "",

                handleInput(e) {
                    const input = e.target;

                    this.value = Array.from(Array(this.length), (element, i) => {
                        return this.$refs[i].value || "";
                    }).join("");

                    if (input.nextElementSibling && input.value) {
                        input.nextElementSibling.focus();
                        input.nextElementSibling.select();
                    }
                },

                handlePaste(e) {
                    const paste = e.clipboardData.getData('text');
                    this.value = paste;

                    const inputs = Array.from(Array(this.length));

                    inputs.forEach((element, i) => {
                        this.$refs[i].value = paste[i] || '';
                    });
                },

                handleBackspace(e) {
                    const previous = parseInt(e, 10) - 1;
                    this.$refs[previous] && this.$refs[previous].focus();
                },
            };
        }
    </script>
</x-college-layout>
