@if ($paginator->hasPages())
    <nav aria-label="Pagination Navigation" class="d-flex justify-content-center">
        <ul class="pagination pagination-modern mb-0">
            {{-- First Page Link --}}
            @if (!$paginator->onFirstPage())
                <li class="page-item">
                    <a class="page-link pagination-btn" href="{{ $paginator->url(1) }}" title="หน้าแรก">
                        <i class="fas fa-angle-double-left"></i>
                        <span class="d-none d-md-inline ms-1">แรก</span>
                    </a>
                </li>
            @endif

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link pagination-btn-disabled">
                        <i class="fas fa-chevron-left"></i>
                        <span class="d-none d-sm-inline ms-1">ก่อนหน้า</span>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link pagination-btn" href="{{ $paginator->previousPageUrl() }}" rel="prev" title="หน้าก่อนหน้า">
                        <i class="fas fa-chevron-left"></i>
                        <span class="d-none d-sm-inline ms-1">ก่อนหน้า</span>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link pagination-dots">
                            <i class="fas fa-ellipsis-h"></i>
                        </span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <span class="page-link pagination-current" title="หน้าปัจจุบัน">
                                    <span class="page-number">{{ $page }}</span>
                                    <span class="page-indicator">
                                        <i class="fas fa-circle"></i>
                                    </span>
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link pagination-number" href="{{ $url }}" title="ไปยังหน้า {{ $page }}">
                                    <span class="page-number">{{ $page }}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link pagination-btn" href="{{ $paginator->nextPageUrl() }}" rel="next" title="หน้าถัดไป">
                        <span class="d-none d-sm-inline me-1">ถัดไป</span>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link pagination-btn-disabled">
                        <span class="d-none d-sm-inline me-1">ถัดไป</span>
                        <i class="fas fa-chevron-right"></i>
                    </span>
                </li>
            @endif

            {{-- Last Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link pagination-btn" href="{{ $paginator->url($paginator->lastPage()) }}" title="หน้าสุดท้าย">
                        <span class="d-none d-md-inline me-1">สุดท้าย</span>
                        <i class="fas fa-angle-double-right"></i>
                    </a>
                </li>
            @endif
        </ul>
    </nav>

    {{-- Page Info --}}
    <div class="pagination-info-bottom text-center mt-3">
        <small class="text-muted">
            <i class="fas fa-info-circle me-1"></i>
            หน้า <strong>{{ $paginator->currentPage() }}</strong> 
            จาก <strong>{{ $paginator->lastPage() }}</strong> หน้า
            (รวม <strong>{{ number_format($paginator->total()) }}</strong> รายการ)
        </small>
    </div>
@endif
