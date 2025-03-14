<div>
    <form wire:submit="save">
        <div class="form-holder">
            <label class="fel">
                <div>{{ __('Grade Name') }}</div>
                <input type="text" wire:model.live="name">
                <x-back.misc.error for="name"/>
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
