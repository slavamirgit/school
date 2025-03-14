<div>
    @foreach($students as $_student)
        <div>
            <div>
                <a href="{{ route('web.students.show', $_student['id']) }}">{{ $_student['id'] }} — {{ $_student['firstname'] . ' ' . $_student['lastname'] . ', ' . $_student['sex'] . ', ' . $_student['age'] }}</a>
            </div>
        </div>
    @endforeach

    <div class="pagination">
        {{ $students->links() }}
    </div>
</div>
