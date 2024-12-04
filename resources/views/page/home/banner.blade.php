
    
        <section class="flex gap-4 w-full max-h-[510px] justify-center items-center overflow-hidden rounded-xl">
          {{-- main banner --}}
          <div class="w-3/4 flex items-end max-h-[500px] bg-slate-100 shadow-inner rounded-xl overflow-hidden relative hover:bg-slate-200 ease-in-out duration-300">
            <div class="p-16 w-2/3">
              <h1 class="text-5xl ">Lorem ipsum dolor sit amet consectetur.</h1>
              <p class="text-md mt-2">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus, autem. Temporibus laboriosam mollitia exercitationem odit!
              </p>
              <div class="mt-2">
                <button class="btn btn-primary text-white tracking-wide">Shop The Sale</button>
              </div>
            </div>
            <figure class=" h-full ">
              <img class="h-full w-auto object-cover" src="{{asset('img/modelBanner/model1.png')}}" alt="">
            </figure>
          </div>
          {{-- banner ke 2  --}}
          <div class="w-1/3 gap-4 py-5 content-between grid grid-cols-1 h-full">
            <div class="shadow-inner bg-slate-100 flex max-h-[210px] items-center overflow-hidden rounded-xl  hover:bg-slate-200 ease-in-out duration-300">
              <div class="w-2/3 pl-5 mt-8 z-10">
                <h1 class="text-xl mb-3">Lorem ipsum dolo.</h1>
                <p class="text-primary text-xl font-bold tracking-wide">Rp 200.000,00</p>
                <p class="text-neutral line-through">Rp 248.900,00</p>
              </div>
              <figure class="">
                <img class="w-auto object-right-bottom" src="{{asset('img/modelBanner/model3.png')}}" alt="">
              </figure>
            </div>

            {{-- banner ke 3  --}}
            <div class="shadow-inner bg-slate-100 flex max-h-[210px] items-center overflow-hidden rounded-xl justify-items-stretch hover:bg-slate-200 ease-in-out duration-300">
              <div class="w-2/3 pl-5 mt-8 z-10">
                <h1 class="text-xl mb-3">Lorem ipsum dolo.</h1>
                <p class="text-primary text-xl font-bold tracking-wide">Rp 200.000,00</p>
                <p class="text-neutral line-through">Rp 248.900,00</p>
              </div>
              <figure class="">
                <img class="w-auto object-right-bottom" src="{{asset('img/modelBanner/model2.png')}}" alt="">
              </figure>
            </div>
          </div>
        </section>
