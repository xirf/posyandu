<!-- component -->


<div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
    aria-modal="true">
    <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
        <div x-cloak @click="modelOpen = false" x-show="modelOpen"
            x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"></div>

        <div x-cloak x-show="modelOpen" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
            <div class="flex items-center justify-between space-x-4">
                <h1 class="text-xl font-medium text-gray-800 ">Invite team memebr</h1>
            </div>

            <p class="mt-2 text-sm text-gray-500 ">
                Add your teammate to your team and start work to get things done
            </p>

            <div class="mt-5">
                <div>
                    <label for="user name" class="block text-sm text-gray-700 capitalize dark:text-gray-200">Teammate
                        name</label>
                    <input placeholder="Arthur Melo" type="text"
                        class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                </div>

                <div class="mt-4">
                    <label for="email" class="block text-sm text-gray-700 capitalize dark:text-gray-200">Teammate
                        email</label>
                    <input placeholder="arthurmelo@example.app" type="email"
                        class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                </div>

                <div class="mt-4">
                    <h1 class="text-xs font-medium text-gray-400 uppercase">Permissions</h1>

                    <div class="mt-4 space-y-5">
                        <div class="flex items-center space-x-3 cursor-pointer" x-data="{ show: true }"
                            @click="show =!show">
                            <div class="relative w-10 h-5 transition duration-200 ease-linear rounded-full"
                                :class="[show ? 'bg-indigo-500' : 'bg-gray-300']">
                                <label for="show" @click="show =!show"
                                    class="absolute left-0 w-5 h-5 mb-2 transition duration-100 ease-linear transform bg-white border-2 rounded-full cursor-pointer"
                                    :class="[show ? 'translate-x-full border-indigo-500' : 'translate-x-0 border-gray-300']"></label>
                                <input type="checkbox" name="show"
                                    class="hidden w-full h-full rounded-full appearance-none active:outline-none focus:outline-none" />
                            </div>

                            <p class="text-gray-500">Can make task</p>
                        </div>

                        <div class="flex items-center space-x-3 cursor-pointer" x-data="{ show: false }"
                            @click="show =!show">
                            <div class="relative w-10 h-5 transition duration-200 ease-linear rounded-full"
                                :class="[show ? 'bg-indigo-500' : 'bg-gray-300']">
                                <label for="show" @click="show =!show"
                                    class="absolute left-0 w-5 h-5 mb-2 transition duration-100 ease-linear transform bg-white border-2 rounded-full cursor-pointer"
                                    :class="[show ? 'translate-x-full border-indigo-500' : 'translate-x-0 border-gray-300']"></label>
                                <input type="checkbox" name="show"
                                    class="hidden w-full h-full rounded-full appearance-none active:outline-none focus:outline-none" />
                            </div>

                            <p class="text-gray-500">Can delete task</p>
                        </div>

                        <div class="flex items-center space-x-3 cursor-pointer" x-data="{ show: true }"
                            @click="show =!show">
                            <div class="relative w-10 h-5 transition duration-200 ease-linear rounded-full"
                                :class="[show ? 'bg-indigo-500' : 'bg-gray-300']">
                                <label for="show" @click="show =!show"
                                    class="absolute left-0 w-5 h-5 mb-2 transition duration-100 ease-linear transform bg-white border-2 rounded-full cursor-pointer"
                                    :class="[show ? 'translate-x-full border-indigo-500' : 'translate-x-0 border-gray-300']"></label>
                                <input type="checkbox" name="show"
                                    class="hidden w-full h-full rounded-full appearance-none active:outline-none focus:outline-none" />
                            </div>

                            <p class="text-gray-500">Can edit task</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mt-6 gap-4">
                    <x-primary-button x-on:click="modelOpen=false" type="button">{{ __('Cancel') }}</x-primary-button>
                </div>
            </div>
        </div>
    </div>
</div>
