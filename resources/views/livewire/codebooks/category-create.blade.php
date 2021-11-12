<div class="@if (!$showModal) hidden @endif flex items-center justify-center fixed left-0 bottom-0 w-full h-full bg-gray-800 bg-opacity-90">
    <div class="bg-white rounded-lg w-1/2">
        <form wire:submit.prevent="save" class="w-full">
            <div class="flex flex-col items-start p-4">
                <div class="flex items-center w-full border-b pb-4">
                    <div class="text-gray-900 font-medium text-lg">Create category</div>
                    <svg wire:click="closeModal"
                         class="ml-auto fill-current text-gray-700 w-6 h-6 cursor-pointer"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"/>
                    </svg>
                </div>
                <div class="w-full">
                    <label class="block font-medium text-sm text-gray-700" for="title">
                        Name
                    </label>
                    <input wire:model.defer="name"
                           class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400"/>
                    @error('name')
                    <div class="text-sm text-red-500 ml-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="ml-auto mt-4">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            type="submit">Save
                    </button>
                    <button class="bg-gray-500 text-white font-bold py-2 px-4 rounded"
                            wire:click="closeModal"
                            type="button">Close
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
