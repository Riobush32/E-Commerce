<x-layouts-auth>
    @if (session('status'))
    <div role="alert" class="alert shadow-lg absolute w-96 top-20 right-20">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          class="stroke-info h-6 w-6 shrink-0">
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <div>
          <h3 class="font-bold">New message!</h3>
          <div class="text-xs">{{ session('status') }}</div>
        </div>
        {{-- <button class="btn btn-sm">See</button> --}}
      </div>
    @endif
    <div class="flex justify-center items-center">
        <div class="border-white border rounded-xl p-5 hover:scale-105 transition-all group">
            <div class="">
                <legend class="text-2xl">Forgot Password</legend>
                <hr class="my-2">
            </div>
            <form action="{{ route('password.email') }}" method="POST" class="">
                @csrf

                <label class="text-black form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text text-gray-50">Email</span>
                    </div>
                    <input type="email" name="email" id="email" class="bg-slate-700 border focus:-rotate-3 border-gray-300 text-gray-50 invalid:text-red-400 invalid:border-red-400 transition-all text-sm rounded-lg  block w-full p-2.5" placeholder="name@company.com" value="{{ old('email') }}" required />
                    
                </label>

                <div class="mt-3 text-right">
                    <button type="submit" class="btn btn-primary text-white font-light tracking-widest text-lg">Send Reset Link</button>
                </div>
            </form>

        </div>
    </div>



</x-layouts-auth>
