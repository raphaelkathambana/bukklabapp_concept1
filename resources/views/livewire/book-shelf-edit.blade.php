<div class="py-6">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-background-50 dark:bg-background-900 rounded-lg shadow-md p-6">
            <form wire:submit.prevent="updateShelf">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="name" class="block text-text-700 dark:text-text-300">Name</label>
                        <input type="text" id="name" wire:model="name" id="name"
                            class="form-input w-full mt-2 border-accent-300 dark:border-accent-500 rounded-md shadow-sm focus:ring focus:ring-accent-200 dark:focus:ring-accent-700" />
                        @error('name')
                            <span class="text-sm text-danger-500 dark:text-danger-300">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-text-700 dark:text-text-300">Description</label>
                        <textarea id="description" wire:model="description" rows="4"
                            class="form-textarea w-full mt-2 border-accent-300 dark:border-accent-500 rounded-md shadow-sm focus:ring focus:ring-accent-200 dark:focus:ring-accent-700"></textarea>
                        @error('description')
                            <span class="text-sm text-danger-500 dark:text-danger-300">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="visibility" class="block text-text-700 dark:text-text-300">Visibility</label>
                        <select id="visibility" wire:model="visibility"
                            class="form-select w-full mt-2 border-accent-300 dark:border-accent-500 rounded-md shadow-sm focus:ring focus:ring-accent-200 dark:focus:ring-accent-700">
                            <option value="public">Public</option>
                            <option value="private">Private</option>
                        </select>
                        @error('visibility')
                            <span class="text-sm text-danger-500 dark:text-danger-300">{{ $message }}</span>
                        @enderror
                    </div>
                    </div>
        </div>

        <div class="mt-6">
            <button type="submit"
                class="bg-accent-500 dark:bg-accent-700 text-white px-4 py-2 rounded-md shadow-md hover:bg-accent-400 dark:hover:bg-accent-600">
                Save Changes
            </button>
            <button>
                <a href="{{ route('bookshelves.show', $shelf) }}"
                    class="text-white bg-red-500 dark:bg-red-700 rounded px-4 py-2">Cancel</a>
            </button>
        </div>
        </form>
    </div>
</div>
</div>
