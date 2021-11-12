<div>
{{--    @dd($categories)--}}
    <div class="m-2">
        <button wire:click.prevent="create"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add new product
        </button>
    </div>


    <table class="table min-w-full mb-4">
        <thead>
        <tr>
            <th wire:click="sortByColumn('id')" class="px-4 py-3 border-b-2 border-gray-300 text-left text-sm ">
                #
                @if ($sortColumn == 'id')
                    <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                @else
                    <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                @endif
            </th>
            <th wire:click="sortByColumn('name')" class="px-4 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                Name
                @if ($sortColumn == 'name')
                    <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                @else
                    <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                @endif
            </th>
            <th wire:click="sortByColumn('price')" class="px-4 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                Price
                @if ($sortColumn == 'price')
                    <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                @else
                    <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                @endif
            </th>
            <th wire:click="sortByColumn('description')" class="px-4 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                Description
                @if ($sortColumn == 'description')
                    <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                @else
                    <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                @endif
            </th>
            <th wire:click="sortByColumn('category_name')" class="px-4 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                Category
                @if ($sortColumn == 'category_name')
                    <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                @else
                    <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                @endif
            </th>
            <th></th>
        </tr>
        <tr>
            <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                <input wire:model="searchColumns.id" type="number" placeholder="Search..."
                       class="mt-2 text-sm sm:text-base pl-2 pr-2 rounded-lg border border-gray-400 w-20 py-0.5 focus:outline-none focus:border-blue-400"/>
            </td>
            <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                <input wire:model="searchColumns.name" type="text" placeholder="Search..."
                       class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-1 focus:outline-none focus:border-blue-400"/>
            </td>
            <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                From
                <input wire:model="searchColumns.price.0" type="number"
                       class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-1 focus:outline-none focus:border-blue-400"
                       style="width: 75px"/>
                to
                <input wire:model="searchColumns.price.1" type="number"
                       class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-1 focus:outline-none focus:border-blue-400"
                       style="width: 75px"/>
            </td>
            <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                <input wire:model="searchColumns.description" type="text" placeholder="Search..."
                       class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-1 focus:outline-none focus:border-blue-400"/>
            </td>
            <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                <select wire:model="searchColumns.product_category_id"
                        class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-1 focus:outline-none focus:border-blue-400">
                    <option value="">-- choose category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </td>
            <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5"></td>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-2">{{ $product->id }}</td>
                <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">{{ $product->name }}</td>
                <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">${{ number_format($product->price, 2) }}</td>
                <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">{{ Str::limit($product->description, 50) }}</td>
                <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">{{ $product->category->name ?? '' }}</td>
                <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">

                    <a href="#" wire:click.prevent="edit({{ $product->id }})"><i class="far fa-edit"></i></a>
                    <a href="#" wire:click.prevent="delete({{ $product->id }})"
                       onclick="confirm('Are you sure?') || event.stopImmediatePropagation()">
                        <i class="far fa-trash-alt"></i></a>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $products->links() }}

    {{--    modal--}}
    <div
        class="@if (!$showModal) hidden @endif flex items-center justify-center fixed left-0 bottom-0 w-full h-full bg-gray-800 bg-opacity-90">
        <div class="bg-white rounded-lg w-1/2">
            <form wire:submit.prevent="save" class="w-full">
                <div class="flex flex-col items-start p-4">
                    <div class="flex items-center w-full border-b pb-4">
                        <div class="text-gray-900 font-medium text-lg">{{ $productId ? 'Edit Product' : 'Add New Product' }}</div>
                        <svg wire:click="close"
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
                        <input wire:model.defer="product.name"
                               class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400"/>
                    </div>
                    <div class="w-full">
                        <label class="block font-medium text-sm text-gray-700" for="description">
                            Description
                        </label>
                        <input wire:model.defer="product.description"
                               class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400"/>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700" for="category">
                            Categories
                        </label>
                        <div class="mt-2 flex justify-between">
                            <div class="flex-1">
                                <select name="category" wire:model="product.product_category_id"
                                        class="text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400">
                                    <option value="">Select category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('product.product_category')
                                <div class="text-sm text-red-500 ml-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <button wire:click.prevent="$emit('openModal')"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold mr-2 flex justify-between py-2 px-4 rounded">
                                Add New Category
                            </button>
                            @livewire('codebooks.category-create')

                        </div>
                    </div>

                    <div class="py-4 border-b w-full mb-4">
                        <label class="block font-medium text-sm text-gray-700" for="title">
                            Price
                        </label>
                        <input wire:model.defer="product.price"
                               class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400"/>
                    </div>
                    <div class="py-4 border-b w-full mb-4">
                        <label class="block font-medium text-sm text-gray-700" for="tax">
                            Tax (%)
                        </label>
                        <input wire:model.defer="product.tax"
                               class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400"/>
                    </div>

                    <div class="ml-auto">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                type="submit">{{ $productId ? 'Save Changes' : 'Save' }}
                        </button>
                        <button class="bg-gray-500 text-white font-bold py-2 px-4 rounded"
                                wire:click="close"
                                type="button"
                                data-dismiss="modal">Close
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
