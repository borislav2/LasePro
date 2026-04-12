<div>
    <!-- Success Message -->
    @if (session()->has('success'))
        <div class="mb-4 p-4 bg-green-500/20 border border-green-500 rounded-lg text-green-300">
            {{ session('success') }}
        </div>
    @endif

    <!-- Reservation Form -->
    <form wire:submit="submit" class="space-y-4">
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('messages.your_name') }} *</label>
                <input type="text" 
                       wire:model="name" 
                       placeholder="{{ __('messages.placeholder_name') }}"
                       class="w-full bg-[#0A1929] border border-[#00FF85]/30 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-[#00FF85] focus:outline-none transition-colors">
                @error('name')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('messages.phone_number') }} *</label>
                <input type="tel" 
                       wire:model="phone" 
                       placeholder="{{ __('messages.placeholder_phone') }}"
                       class="w-full bg-[#0A1929] border border-[#00FF85]/30 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-[#00FF85] focus:outline-none transition-colors">
                @error('phone')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('messages.address') }} *</label>
            <input type="text" 
                   wire:model="address" 
                   placeholder="{{ __('messages.placeholder_address') }}"
                   class="w-full bg-[#0A1929] border border-[#00FF85]/30 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-[#00FF85] focus:outline-none transition-colors">
            @error('address')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('messages.project_details') }}</label>
            <textarea wire:model="message" 
                      rows="4"
                      placeholder="{{ __('messages.placeholder_project_details') }}"
                      class="w-full bg-[#0A1929] border border-[#00FF85]/30 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-[#00FF85] focus:outline-none transition-colors resize-none">
            </textarea>
            @error('message')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('messages.preferred_date') }}</label>
            <input type="date" 
                   wire:model="preferred_date" 
                   class="w-full bg-[#0A1929] border border-[#00FF85]/30 rounded-lg px-4 py-3 text-white focus:border-[#00FF85] focus:outline-none transition-colors">
            @error('preferred_date')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Image Upload -->
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('messages.upload_images') }}</label>
            <div class="w-full border border-dashed rounded-lg p-6 text-center transition-colors cursor-pointer upload-dropzone"
                 x-data="{ dragging: false }"
                 @dragover.prevent="dragging = true"
                 @dragleave="dragging = false"
                 @drop.prevent="dragging = false"
                 :class="{ 'dragging': dragging }">
                
                <input type="file" 
                       wire:model="images" 
                       multiple 
                       accept="image/*"
                       class="hidden"
                       id="image-upload">
                
                <label for="image-upload" class="cursor-pointer block">
                    <svg class="w-10 h-10 mx-auto mb-2 upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="upload-text-primary text-sm mb-1">{{ __('messages.drag_drop_images') }}</p>
                    <p class="upload-text-secondary text-xs">{{ __('messages.file_formats') }}</p>
                </label>
            </div>
            
            @error('images')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
            @error('images.*')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror

            <!-- Preview uploaded images -->
            @if ($images)
                <div class="mt-4 grid grid-cols-3 gap-2">
                    @foreach($images as $key => $image)
                        <div class="relative">
                            <img src="{{ $image->temporaryUrl() }}" class="w-full h-20 object-cover rounded-lg">
                            <button type="button" wire:click="removeImage({{ $key }})" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-600">
                                ×
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif
            
            <div wire:loading wire:target="images" class="mt-2 text-sm text-cyan-400">
                <svg class="animate-spin inline w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                {{ __('messages.uploading') }}
            </div>
        </div>

        <div class="flex justify-center">
            <button type="submit" 
                    wire:loading.attr="disabled"
                    class="laser-btn px-8 py-4 rounded-full text-lg font-semibold w-full md:w-auto disabled:opacity-50">
                <span wire:loading.remove wire:target="submit">{{ __('messages.book_now_button') }}</span>
                <span wire:loading wire:target="submit">
                    <svg class="animate-spin inline w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    {{ __('messages.sending') }}
                </span>
            </button>
        </div>
    </form>

    <!-- Success Modal -->
    @if (session()->has('success'))
        <script>
            setTimeout(() => {
                alert('Reservation submitted successfully! We will contact you soon.');
            }, 100);
        </script>
    @endif
</div>
