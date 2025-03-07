<div class="" x-data="{ readMore: false }">
    <div class=" flex items-center mb-4">
        @if($coment->user->user_image != null)
        <img src="{{ asset($coment->user->user_image) }}" alt="">
        @else
        <img class="w-10 h-10 me-4 rounded-full" src="https://static.vecteezy.com/system/resources/previews/019/879/186/original/user-icon-on-transparent-background-free-png.png" alt="">
        @endif

        <div class="font-medium ">
            <p>{{ $coment->user->name }} <span class="block text-sm text-gray-500 ">{{ $coment->created_at }}</span></p>
        </div>
    </div>
    <div class="flex items-center mb-1 space-x-1 rtl:space-x-reverse">

        <div class="rating rating-sm">
            <input type="radio" name="rating-5" class="mask mask-star-2 bg-orange-400" {{ $coment->rating == 1 ? 'checked' : '' }} disabled/>
            <input type="radio" name="rating-5" class="mask mask-star-2 bg-orange-400" {{ $coment->rating == 2 ? 'checked' : '' }} disabled/>
            <input type="radio" name="rating-5" class="mask mask-star-2 bg-orange-400" {{ $coment->rating == 3 ? 'checked' : '' }} disabled/>
            <input type="radio" name="rating-5" class="mask mask-star-2 bg-orange-400" {{ $coment->rating == 4 ? 'checked' : '' }} disabled/>
            <input type="radio" name="rating-5" class="mask mask-star-2 bg-orange-400" {{ $coment->rating == 5 ? 'checked' : '' }} disabled/>
        </div>
    </div>
    <div class="">
        <p class="mb-2 text-gray-500 " :class="!readMore ? 'line-clamp-3' : ''">
           {{ $coment->coment }}</p>
    </div>

    <a @click="readMore = !readMore" @click.outside="readMore = false" x-text="readMore ? 'See less...':'Read more...'"
        class="cursor-pointer block mb-5 text-sm font-medium text-blue-600 hover:underline "></a>

</div>
