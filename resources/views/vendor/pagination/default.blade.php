
@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
<style>
    .pagination-outer{ text-align: center; }
    .pagination{
        font-family: 'Noto Sans', sans-serif;
        display: inline-flex;
        position: relative;
    }
    .pagination li a.page-link{
        color: #2980b9;
        background-color: transparent;
        font-size: 22px;
        font-weight: 600;
        line-height: 43px;
        height: 45px;
        width: 45px;
        padding: 0;
        margin: 0 15px 0 0;
        border: none;
        position: relative;
        z-index: 1;
        transition: all 0.3s ease 0s;
    }
    .pagination li.active a.page-link,
    .pagination li a.page-link:hover,
    .pagination li.active a.page-link:hover{
        color: #fff;
        background: transparent;
    }
    .pagination li a.page-link:before{
        content: "";
        background: #2c3e50;
        width: 100%;
        height: 100%;
        opacity: 0;
        transform: scale(1.2);
        position: absolute;
        top: 0;
        left: 0;
        z-index: -1;
        -webkit-clip-path: polygon(0% 15%, 15% 15%, 15% 0%, 85% 0%, 85% 15%, 100% 15%, 100% 85%, 85% 85%, 85% 100%, 15% 100%, 15% 85%, 0% 85%);
        clip-path: polygon(0% 15%, 15% 15%, 15% 0%, 85% 0%, 85% 15%, 100% 15%, 100% 85%, 85% 85%, 85% 100%, 15% 100%, 15% 85%, 0% 85%);
        transition: all 0.3s ease 0s;
    }
    .pagination li.active a.page-link:before,
    .pagination li a.page-link:hover:before,
    .pagination li.active a.page-link:hover:before{
        opacity: 1;
        transform: scale(1) rotate(0);
    }
    .pagination li:first-child a.page-link{
        background: radial-gradient(transparent, rgba(0, 0, 0, 0.2));
        border-radius: 0;
        -webkit-clip-path: polygon(100% 0%, 75% 50%, 100% 100%, 25% 100%, 0% 50%, 25% 0%);
        clip-path: polygon(100% 0%, 75% 50%, 100% 100%, 25% 100%, 0% 50%, 25% 0%);
    }
    .pagination li:last-child a.page-link{
        background: radial-gradient(transparent, rgba(0, 0, 0, 0.2));
        margin-right: 0;
        border-radius: 0;
        -webkit-clip-path: polygon(75% 0%, 100% 50%, 75% 100%, 0% 100%, 25% 50%, 0% 0%);
        clip-path: polygon(75% 0%, 100% 50%, 75% 100%, 0% 100%, 25% 50%, 0% 0%);
    }
    .pagination li:first-child a.page-link:hover,
    .pagination li:last-child a.page-link:hover{
        background-color: #2c3e50;
    }
    .pagination li:first-child a.page-link:before,
    .pagination li:last-child a.page-link:before{
        display: none;
    }
    @media only screen and (max-width: 480px){
        .pagination{
            padding: 10px 0;
            margin: 0;
            display: block;
        }
        .pagination li{
            display: inline-block;
            margin: 0 0 10px;
        }
    }
</style>
