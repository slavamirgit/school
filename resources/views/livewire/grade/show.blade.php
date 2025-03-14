<div class="stack">
    <div>
        <div>{{ __('Grade id') }}: {{ $grade['id'] }}</div>
        <div>{{ __('Grade name') }}: {{ $grade['name'] }}</div>
    </div>

    <div class="actions">
        <a href="{{ route('web.grades.edit', $grade['id']) }}" class="button blue">{{ __('Edit') }}</a>
        <div class="button red" wire:click="delete">{{ __('Delete') }}</div>
    </div>

    <div>
        <div>{{ __('Students') }}</div>
        @dump($students)
    </div>
</div>
