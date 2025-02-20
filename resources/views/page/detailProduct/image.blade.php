
<div class="w-2/5 p-5">
    <div class="grid gap-4 " x-data="{mainImage:'{{ asset($product->product_photos->first()->photo_patch) }}'}">
        <div>
            <img class="h-auto w-full rounded-lg" :src="mainImage"
                alt="">
        </div>
        <div class="grid grid-cols-5 gap-4 mt-5">
            @forelse ($product->product_photos as $photo )
            <div @click="mainImage = '{{ asset($photo->photo_patch) }}'" class="cursor-pointer">
                <img class="h-auto max-w-full rounded-lg" src="{{ asset($photo->photo_patch) }}" alt="">
            </div>
            @empty
            <div @click="mainImage = 'https://flowbite.s3.amazonaws.com/docs/gallery/square/image-1.jpg'" class="cursor-pointer">
                <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-1.jpg" alt="">
            </div>
            @endforelse
            @forelse ($product->variants as $variant)
            <div @click="mainImage = '{{ asset($variant->variant_image) }}'" class="cursor-pointer">
                <img class="h-auto max-w-full rounded-lg" src="{{ asset($variant->variant_image) }}" alt="">
            </div>
            @empty

            @endforelse

        </div>
    </div>
</div>
