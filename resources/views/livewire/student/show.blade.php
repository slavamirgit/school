<div class="stack">
    <div>
        <div>{{ __('Student id') }}: {{ $student['id'] }}</div>
        <div>{{ __('Name') }}: {{ $student['firstname'] . ' ' . $student['lastname'] }}</div>
        <div>{{ __('Sex') }}: {{ $student['sex'] }}</div>
        <div>{{ __('Age') }}: {{ $student['age'] }}</div>
        <div>{{ __('Grade id') }}: {{ $student['grade_id'] }}</div>
    </div>

    <div class="actions">
        <a href="{{ route('students.edit', $student['id']) }}" class="button blue">{{ __('Edit') }}</a>
        <div class="button red" wire:click="delete">{{ __('Delete') }}</div>
    </div>
</div>
