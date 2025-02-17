@if ($paginator->hasPages())
    <div class="join mt-4 flex justify-center">
        {{-- Tombol Previous --}}
        @if ($paginator->onFirstPage())
            <button class="join-item btn btn-sm btn-disabled"><i class="fa-solid fa-angles-left"></i></button>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="join-item btn-sm btn"><i class="fa-solid fa-angles-left"></i></a>
        @endif

        {{-- Nomor Halaman --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <button class="join-item btn-sm btn btn-disabled">{{ $element }}</button>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <button class="join-item btn-sm btn btn-active">{{ $page }}</button>
                    @else
                        <a href="{{ $url }}" class=" btn-sm join-item btn">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Tombol Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class=" btn-sm join-item btn"><i class="fa-solid fa-angles-right"></i></a>
        @else
            <button class=" btn-sm join-item btn btn-disabled"><i class="fa-solid fa-angles-right"></i></button>
        @endif
    </div>
@endif
