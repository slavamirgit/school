<div class="flex">
    @foreach($data['links'] as $_link)
        @if($loop->first)
            @isset($prev['page'])
                <a href="{{ request()->fullUrlWithQuery(['page' => $prev['page']]) }}" class="svg prev">
                    <svg>
                        <use xlink:href="#svg-prev"/>
                    </svg>
                </a>
            @else
                <div class="svg prev disabled">
                    <svg>
                        <use xlink:href="#svg-prev"/>
                    </svg>
                </div>
            @endisset
        @elseif($loop->last)
            @isset($next['page'])
                <a href="{{ request()->fullUrlWithQuery(['page' => $next['page']]) }}" class="svg next">
                    <svg>
                        <use xlink:href="#svg-next"/>
                    </svg>
                </a>
            @else
                <div class="svg next disabled">
                    <svg>
                        <use xlink:href="#svg-next"/>
                    </svg>
                </div>
            @endisset
        @elseif($_link['label'] === '...')
            <div class="dots">...</div>
        @else
            <a
                href="{{ request()->fullUrlWithQuery(['page' => $_link['label']]) }}"
                @class(['page', 'active' => $data['current_page'] == $_link['label']])
            >{{ $_link['label'] }}</a>
        @endif
    @endforeach
</div>

<div class="flex">
    <div>{{ $data['from'] . ' — ' . $data['to'] . ' of ' . $data['total'] }}</div>
</div>
