@extends('components.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-3xl font-bold text-blue-900 mb-6">{{ __('messages.edit_media') }}</h1>

        {{-- Current Preview --}}
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.current_file') }}</label>
            <div class="max-w-md rounded-lg overflow-hidden border">
                @if($media->isImage())
                    <img src="{{ $media->file_url }}" alt="{{ $media->title }}" class="w-full">
                @else
                    <video controls class="w-full">
                        <source src="{{ $media->file_url }}" type="video/mp4">
                    </video>
                @endif
            </div>
        </div>

        <form action="{{ route('media.update', $media) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">{{ __('messages.title') }}</label>
                <input type="text" name="title" id="title" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('title') border-red-500 @enderror"
                       value="{{ old('title', $media->title) }}" required>
                @error('title')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">{{ __('messages.description') }}</label>
                <textarea name="description" id="description" rows="4" 
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('description') border-red-500 @enderror">{{ old('description', $media->description) }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Category --}}
            <div class="mb-4">
                <label for="category" class="block text-sm font-medium text-gray-700">{{ __('messages.category') }}</label>
                <select name="category" id="category" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('category') border-red-500 @enderror"
                        required>
                    <option value="">{{ __('messages.select_category') }}</option>
                    <option value="wood" {{ old('category', $media->category) == 'wood' ? 'selected' : '' }}>{{ __('messages.wood') }}</option>
                    <option value="stone" {{ old('category', $media->category) == 'stone' ? 'selected' : '' }}>{{ __('messages.stone') }}</option>
                    <option value="metal" {{ old('category', $media->category) == 'metal' ? 'selected' : '' }}>{{ __('messages.metal') }}</option>
                </select>
                @error('category')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Type --}}
            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700">{{ __('messages.type') }}</label>
                <select name="type" id="type" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('type') border-red-500 @enderror"
                        required>
                    <option value="">{{ __('messages.select_type') }}</option>
                    <option value="image" {{ old('type', $media->type) == 'image' ? 'selected' : '' }}>{{ __('messages.image') }}</option>
                    <option value="video" {{ old('type', $media->type) == 'video' ? 'selected' : '' }}>{{ __('messages.video') }}</option>
                </select>
                @error('type')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- File Upload (Optional for edit) --}}
            <div class="mb-4">
                <label for="file" class="block text-sm font-medium text-gray-700">{{ __('messages.replace_file') }} ({{ __('messages.optional') }})</label>
                <input type="file" name="file" id="file" 
                       class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('file') border-red-500 @enderror"
                       accept="image/*,video/*">
                <p class="mt-1 text-sm text-gray-500">{{ __('messages.leave_empty_keep_current') }}</p>
                @error('file')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Display Order --}}
            <div class="mb-4">
                <label for="display_order" class="block text-sm font-medium text-gray-700">{{ __('messages.display_order') }}</label>
                <input type="number" name="display_order" id="display_order" min="0"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('display_order') border-red-500 @enderror"
                       value="{{ old('display_order', $media->display_order) }}">
                @error('display_order')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Checkboxes --}}
            <div class="mb-6 space-y-3">
                <label for="is_featured" class="inline-flex items-center">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1" 
                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                           {{ old('is_featured', $media->is_featured) ? 'checked' : '' }}>
                    <span class="ml-2 text-sm text-gray-700">{{ __('messages.featured') }}</span>
                </label>
                <br>
                <label for="is_published" class="inline-flex items-center">
                    <input type="checkbox" name="is_published" id="is_published" value="1" 
                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                           {{ old('is_published', $media->is_published) ? 'checked' : '' }}>
                    <span class="ml-2 text-sm text-gray-700">{{ __('messages.published') }}</span>
                </label>
            </div>

            {{-- Buttons --}}
            <div class="flex justify-between items-center">
                <a href="{{ route('media.index') }}" class="text-gray-600 hover:text-gray-800">
                    {{ __('messages.cancel') }}
                </a>
                <div class="flex gap-3">
                    <button type="submit" 
                            class="bg-blue-900 text-white px-6 py-2 rounded hover:bg-blue-800 transition-colors">
                        {{ __('messages.update') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
