<form action="{{ route('logout') }}" method="post" x-data>
    @csrf

    <a href="{{ route('logout') }}" x-on:click.prevent="$root.submit()">
        <span class="svg">
            <svg><use xlink:href="#svg-exit"/></svg>
        </span>
        <span>{{ __('Log Out') }}</span>
    </a>
</form>
