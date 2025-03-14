@if($paginator->hasPages())
    <div class="flex">
        @foreach($elements as $element)
            @if(is_string($element))
                <div class="dots">{{ $element }}</div>
            @elseif(is_array($element))
                @foreach($element as $page => $url)
                    @if($page == $paginator->currentPage())
                        <div class="page active">{{ $page }}</div>
                    @else
                        <div class="page" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">{{ $page }}</div>
                    @endif
                @endforeach
            @endif
        @endforeach

        <div class="info">{{ $paginator->firstItem() }}-{{ $paginator->lastItem() }} {{ __('of') }} {{ $paginator->total() }}</div>
    </div>

    <div class="flex">
        @if(!$paginator->onFirstPage())
            <div class="svg prev" wire:click="previousPage('{{ $paginator->getPageName() }}')">
                <svg>
                    <use xlink:href="#svg-prev"/>
                </svg>
            </div>
        @endif

        @if($paginator->hasMorePages())
            <div class="svg next" wire:click="nextPage('{{ $paginator->getPageName() }}')">
                <svg>
                    <use xlink:href="#svg-next"/>
                </svg>
            </div>
        @endif
    </div>
@else
    &nbsp;
@endif
