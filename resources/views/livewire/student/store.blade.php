<div>
    <form wire:submit="save">
        <div class="form-holder">
            <label class="fel">
                <div>{{ __('Firstname') }}</div>
                <input type="text" wire:model.live="firstname">
                <x-back.misc.error for="firstname"/>
            </label>

            <label class="fel">
                <div>{{ __('Lastname') }}</div>
                <input type="text" wire:model.live="lastname">
                <x-back.misc.error for="lastname"/>
            </label>

            <label class="fel">
                <div>{{ __('Sex') }}</div>
                <input type="text" wire:model.live="sex">
                <x-back.misc.error for="sex"/>
            </label>

            <label class="fel">
                <div>{{ __('Age') }}</div>
                <input type="text" wire:model.live="age">
                <x-back.misc.error for="age"/>
            </label>

            <label class="fel">
                <div>{{ __('Grade id') }}</div>
                <input type="text" wire:model.live="grade_id">
                <x-back.misc.error for="grade_id"/>
            </label>

            @if($error)
                <div class="error">{{ $error }}</div>
            @endif

            @if($saved)
                <div
                    x-init="setTimeout(() => {
                        $wire.set('saved', false)
                    }, 2000)"
                >{{ __('Saved') }}</div>
            @endif

            <button type="submit" class="button green">{{ __('Save') }}</button>
        </div>
    </form>
</div>
