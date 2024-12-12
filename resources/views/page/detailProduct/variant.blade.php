<div class="my-2">
    <h3 class="mb-2 text-sm font-medium ">Variant</h3>
    <ul class="flex flex-wrap w-full gap-2">
        @forelse ($product->variants as $variant)
        <li>
            <input type="radio" id="{{ $variant->name }}" name="variant" value="{{ $variant->id }}" class="hidden peer" required/>
            <label for="{{ $variant->name }}"  @click="v = '{{ $variant->name }}'"
                class="inline-flex items-center justify-between w-full p-2 text-gray-500  border border-gray-200 rounded-lg cursor-pointer peer-checked:border-primary peer-checked:text-primary hover:text-gray-600 hover:bg-gray-100 ">
                <div class="block">
                    <div class="w-full text-sm font-semibold">{{ $variant->name }}</div>
                </div>
            </label>
        </li>
        @empty
        @endforelse


    </ul>

</div>
