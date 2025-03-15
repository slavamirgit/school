<div>
    @foreach($items as $_grade)
        <div>
            <a href="{{ route('grades.show', $_grade['id']) }}">{{ $_grade['id'] }} — {{ $_grade['name'] }}</a>
        </div>
    @endforeach

    <div class="pagination">
        @include('misc.pagination')
    </div>
</div>
