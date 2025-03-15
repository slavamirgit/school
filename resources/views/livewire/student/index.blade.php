<div>
    @foreach($items as $_student)
        <div>
            <a
                href="{{ route('students.show', $_student['id']) }}"
            >{{ $_student['id'] }} — {{ $_student['firstname'] . ' ' . $_student['lastname'] . ', ' . $_student['grade']['name'] . ', ' . $_student['sex'] . ', ' . $_student['age'] }}</a>
        </div>
    @endforeach

    <div class="pagination">
        @include('misc.pagination')
    </div>
</div>
