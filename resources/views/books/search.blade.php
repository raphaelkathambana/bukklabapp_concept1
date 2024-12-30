<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Search Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200">
                    {{ __('Search for a Book') }}
                </h3>

                <!-- Embed the BookSearch Livewire Component -->
                {{-- @livewire('book-search') --}}
                <livewire:book-search />
            </div>
        </div>
    </div>
</x-app-layout>
