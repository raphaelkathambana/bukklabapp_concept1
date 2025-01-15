<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-text-800 dark:text-text-200">
            Edit Collection
        </h2>
    </x-slot>

    @livewire('book-shelf-edit', ['shelf' => $shelf])
</x-app-layout>
