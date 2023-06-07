<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg ">

                <div class="mx-auto mt-3 max-w-7xl sm:px-6 lg:px-8">
                    <x-ui.alerts />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 ">

                    <div class="p-6">

                        <form method="POST" action="{{ route('shorturl.generate') }}">
                            @csrf

                            <!-- Url Address -->
                            <div>
                                <x-input-label for="url" :value="__('Url')" />
                                <x-text-input id="url" class="block mt-1 w-full" type="text" name="url" :value="old('url')" autofocus />
                                <x-input-error :messages="$errors->get('url')" class="mt-2" />
                            </div>
                    
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ml-3">
                                    {{ __('Crear url corta') }}
                                </x-primary-button>
                            </div>

                        </form>

                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">

                        <form method="POST" action="{{ route('shorturl.get') }}">
                            @csrf
                    
                            <!-- Short Code -->
                            <div>
                                <x-input-label for="code" :value="__('Url Corta')" />
                                <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code')" autofocus />
                                <x-input-error :messages="$errors->get('code')" class="mt-2" />
                            </div>
                    
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ml-3">
                                    {{ __('Obtener Url') }}
                                </x-primary-button>
                            </div>

                        </form>

                    </div>

                </div>

            </div>

            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg ">

                <livewire:short-url.index>

            </div>

        </div>
    </div>
</x-app-layout>
