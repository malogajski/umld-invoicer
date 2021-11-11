<div x-data="{}">
    <div class="alert alert-info" role="alert">
        Click "Edit", modify that line data and click "Save".
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th width="250"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $index => $product)
            <tr>
                <td>
                    @if ($editedProductIndex === $index || $editedProductField === $index . '.name')
                        <input type="text"
                               @click.away="$wire.editedProductField === '{{ $index }}.name' ? $wire.saveProduct({{ $index }}) : null"
                               wire:model.defer="products.{{ $index }}.name"/>
                        @if ($errors->has('products.' . $index . '.name'))
                            <div class="invalid-feedback">{{ $errors->first('products.' . $index . '.name') }}</div>
                        @endif
                    @else
                        <div class="cursor-pointer" wire:click="editProductField({{ $index }}, 'name')">
                            {{ $product['name'] }}
                        </div>
                    @endif
                </td>
                <td>
                    @if ($editedProductIndex === $index || $editedProductField === $index . '.price')
                        <input type="text"
                               @click.away="$wire.editedProductField === '{{ $index }}.price' ? $wire.saveProduct({{ $index }}) : null"
                               wire:model.defer="products.{{ $index }}.price"/>
                        @if ($errors->has('products.' . $index . '.price'))
                            <div class="invalid-feedback">{{ $errors->first('products.' . $index . '.price') }}</div>
                        @endif
                    @else
                        <div class="cursor-pointer" wire:click="editProductField({{ $index }}, 'price')">
                            {{ $product['price'] }}
                        </div>
                    @endif
                </td>
                <td>
                    @if($editedProductIndex === $index || (isset($editedProductField) && (int)(explode('.',$editedProductField)[0])===$index))
                        <button class="btn btn-sm btn-success mr-1"
                                wire:click.prevent="saveProduct({{$index}})">
                            Save
                        </button>
                    @else
                        <button class="btn btn-sm btn-primary"
                                wire:click.prevent="editProduct({{$index}})">
                            Edit
                        </button>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
