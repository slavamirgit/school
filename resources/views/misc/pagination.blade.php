<div class="flex">
    @foreach($data['links'] as $_link)
        @if($loop->first)
            @if($prev)
                <a href="{{ request()->fullUrlWithQuery(['page' => $prev]) }}" class="svg prev">
                    <svg>
                        <use xlink:href="#svg-prev"/>
                    </svg>
                </a>
            @endif
        @elseif($loop->last)
            @if($next)
                <a href="{{ request()->fullUrlWithQuery(['page' => $next]) }}" class="svg next">
                    <svg>
                        <use xlink:href="#svg-next"/>
                    </svg>
                </a>
            @endif
        @else
            <a href="{{ request()->fullUrlWithQuery(['page' => $_link['label']]) }}" class="page">{{ $_link['label'] }}</a>
        @endif
    @endforeach
</div>

<div class="flex">
    <div>{{ $data['from'] . ' — ' . $data['to'] . ' of ' . $data['total'] }}</div>
</div>

{{--
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
--}}
