@if ($paginator->hasPages())
    <div class="join mt-4 flex justify-center">
        {{-- Tombol Previous --}}
        @if ($paginator->onFirstPage())
            <button class="btn-sm join-item btn btn-disabled">«</button>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="btn-sm join-item btn">«</a>
        @endif

        {{-- Nomor Halaman Sekarang --}}
        <button class="btn-sm join-item btn">Page {{ $paginator->currentPage() }}</button>

        {{-- Tombol Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="btn-sm join-item btn">»</a>
        @else
            <button class="btn-sm join-item btn btn-disabled">»</button>
        @endif
    </div>
@endif
