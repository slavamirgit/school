<div class="stack">
    <div>
        <div>{{ __('Grade id') }}: {{ $grade['id'] }}</div>
        <div>{{ __('Grade name') }}: {{ $grade['name'] }}</div>
    </div>

    <div class="actions">
        <a href="{{ route('grades.edit', $grade['id']) }}" class="button blue">{{ __('Edit') }}</a>
        <div class="button red" wire:click="delete">{{ __('Delete') }}</div>
    </div>

    <div>
        <div>{{ __('Students') }}</div>

        @foreach($students as $_student)
            <br>
            <div>
                <div>{{ __('Id') }}: {{ $_student['id'] }}</div>
                <div>{{ __('Name') }}: {{ $_student['firstname'] . ' ' . $_student['lastname'] }}</div>
                <div>{{ __('Sex') }}: {{ $_student['sex'] }}</div>
                <div>{{ __('Age') }}: {{ $_student['age'] }}</div>
            </div>
        @endforeach
    </div>
</div>
