
<div class="" x-data="{readMore:false}">
    <div class=" flex items-center mb-4">
        <img class="w-10 h-10 me-4 rounded-full" src="{{ asset('img/modelBanner/model1.png') }}" alt="">
        <div class="font-medium ">
            <p>Jese Leos <time datetime="2014-08-16 19:00" class="block text-sm text-gray-500 ">Joined
                    on August 2014</time></p>
        </div>
    </div>
    <div class="flex items-center mb-1 space-x-1 rtl:space-x-reverse">

        <i class="text-sm fa-solid fa-star text-amber-500"></i>
        <i class="text-sm fa-solid fa-star text-amber-500"></i>
        <i class="text-sm fa-solid fa-star text-amber-500"></i>
        <i class="text-sm fa-solid fa-star text-amber-500"></i>
        <i class="text-sm fa-solid fa-star"></i>
        <h3 class="ms-2 text-sm font-semibold text-gray-900 ">Thinking to buy another one!</h3>
    </div>
    <footer class="mb-5 text-sm text-gray-500 ">
        <p>Reviewed in the United Kingdom on <time datetime="2017-03-03 19:00">March 3, 2017</time></p>
    </footer>
    <div class="">
        <p class="mb-2 text-gray-500 " :class="!readMore ? 'line-clamp-3' : ''">This is my third Invicta Pro Diver. They are just fantastic
            value for money. This one arrived yesterday and the first thing I did was set the time, popped on an
            identical strap from another Invicta and went in the shower with it to test the waterproofing.... No
            problems.</p>
    </div>

    <a @click="readMore = !readMore" @click.outside="readMore = false" x-text="readMore ? 'See less...':'Read more...'" class="cursor-pointer block mb-5 text-sm font-medium text-blue-600 hover:underline "></a>
    <aside>
        <p class="mt-1 text-xs text-gray-500 ">19 people found this helpful</p>
        <div class="flex items-center mt-3">
            <a href="#"
                class="px-2 py-1.5 text-xs font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">Helpful</a>
            <a href="#"
                class="ps-4 text-sm font-medium text-blue-600 hover:underline  border-gray-200 ms-4 border-s md:mb-0 ">Report
                abuse</a>
        </div>
    </aside>
</div>
