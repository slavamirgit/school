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

            <button type="submit" class="button green">{{ __('Save') }}</button>
        </div>
    </form>
</div>
