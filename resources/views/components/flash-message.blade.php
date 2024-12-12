<div class="absolute right-20 z-20">
    @if ($message = Session::get('warning'))
        <div x-data="{ tampil: true }">
            <div x-init="setTimeout(() => tampil = false, 3000)" x-show="tampil" role="alert" class="alert alert-warning ">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span>Warning: {{ $message }}!</span>
            </div>
        </div>
    @endif
    @if ($message = Session::get('success'))
        <div x-data="{ tampil: true }">
            <div x-init="setTimeout(() => tampil = false, 3000)" x-show="tampil" role="alert" class="alert alert-success ">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span>success: {{ $message }}!</span>
            </div>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div x-data="{ tampil: true }">
            <div x-init="setTimeout(() => tampil = false, 3000)" x-show="tampil" role="alert" class="alert alert-error ">
                <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 shrink-0 stroke-current"
                fill="none"
                viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span>Error: {{ $message }}!</span>
            </div>
        </div>
    @endif
</div>
