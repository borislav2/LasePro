<div>
    @if (session()->has('success'))
        <div class="notice" role="status">{{ session('success') }}</div>
    @endif

    <form wire:submit="submit" class="form" novalidate>
        <div class="form__row">
            <div class="field">
                <label class="field__label" for="f-name">{{ __('messages.your_name') }} *</label>
                <input id="f-name" class="field__input" type="text" wire:model="name" autocomplete="name"
                       placeholder="{{ __('messages.placeholder_name') }}">
                @error('name') <span class="field__error">{{ $message }}</span> @enderror
            </div>

            <div class="field">
                <label class="field__label" for="f-phone">{{ __('messages.phone_number') }} *</label>
                <input id="f-phone" class="field__input" type="tel" wire:model="phone" autocomplete="tel"
                       placeholder="{{ __('messages.placeholder_phone') }}">
                @error('phone') <span class="field__error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="field">
            <label class="field__label" for="f-address">{{ __('messages.address') }} *</label>
            <input id="f-address" class="field__input" type="text" wire:model="address" autocomplete="street-address"
                   placeholder="{{ __('messages.placeholder_address') }}">
            @error('address') <span class="field__error">{{ $message }}</span> @enderror
        </div>

        <div class="field">
            <label class="field__label" for="f-message">{{ __('messages.project_details') }}</label>
            <textarea id="f-message" class="field__input" rows="4" wire:model="message"
                      placeholder="{{ __('messages.placeholder_project_details') }}"></textarea>
            @error('message') <span class="field__error">{{ $message }}</span> @enderror
        </div>

        <div class="field">
            <label class="field__label" for="f-date">{{ __('messages.preferred_date') }}</label>
            <input id="f-date" class="field__input" type="date" wire:model="preferred_date">
            @error('preferred_date') <span class="field__error">{{ $message }}</span> @enderror
        </div>

        <div class="field" x-data="{ dragging: false }">
            <span class="field__label">{{ __('messages.upload_images') }}</span>
            <div class="drop"
                 :class="{ 'is-dragging': dragging }"
                 @dragover.prevent="dragging = true"
                 @dragleave="dragging = false"
                 @drop.prevent="dragging = false">
                <input id="image-upload" class="drop__input" type="file" wire:model="images" multiple accept="image/*">
                <label for="image-upload" class="drop__label">
                    <svg class="drop__icon" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 16V4m0 0L7.5 8.5M12 4l4.5 4.5M4 16v3a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-3"/></svg>
                    <span class="drop__text">{{ __('messages.drag_drop_images') }}</span>
                    <span class="drop__hint">{{ __('messages.file_formats') }}</span>
                </label>
            </div>

            @error('images') <span class="field__error">{{ $message }}</span> @enderror
            @error('images.*') <span class="field__error">{{ $message }}</span> @enderror

            @if ($images)
                <div class="previews">
                    @foreach ($images as $key => $image)
                        <div class="previews__item">
                            <img class="previews__img" src="{{ $image->temporaryUrl() }}" alt="">
                            <button type="button" class="previews__remove" wire:click="removeImage({{ $key }})" aria-label="{{ __('messages.delete') }}">&times;</button>
                        </div>
                    @endforeach
                </div>
            @endif

            <p class="form__status" wire:loading wire:target="images">{{ __('messages.uploading') }}</p>
        </div>

        <button type="submit" class="btn btn--beam form__submit" wire:loading.attr="disabled" wire:target="submit,images">
            <span wire:loading.remove wire:target="submit">{{ __('messages.book_now_button') }}</span>
            <span wire:loading wire:target="submit">{{ __('messages.sending') }}</span>
        </button>
    </form>
</div>
