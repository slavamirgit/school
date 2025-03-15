<div>
    @dump($data)
    {{--
    @foreach($grades as $_grade)
        <div>
            <div>
                <a href="{{ route('grades.show', $_grade['id']) }}">{{ $_grade['id'] }} — {{ $_grade['name'] }}</a>
            </div>
        </div>
    @endforeach

    <div class="pagination">
        {{ $grades->links() }}
    </div>
    --}}
</div>
