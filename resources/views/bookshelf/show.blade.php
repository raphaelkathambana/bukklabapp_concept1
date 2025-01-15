<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-text-800 dark:text-text-200">
                {{ $shelf->name }}
            </h2>
            <div class="relative ml-auto">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-text-700 dark:text-text-300 bg-background-50 dark:bg-background-900 rounded-md focus:outline-none">
                            <div x-data="{ name: '{{ $shelf->name }}' }" x-text="name"></div>
                            <div class="ms-1">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('bookshelves.edit', $shelf)" wire:navigate>
                            {{ __('Edit') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <button wire:click="deleteShelf" class="w-full text-start">
                            <x-dropdown-link>
                                {{ __('Delete') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>
    </x-slot>

    @livewire('book-shelf-details', ['shelfId' => $shelf->id])
</x-app-layout>
