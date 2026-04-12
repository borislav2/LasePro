{{-- filepath: c:\xampp\htdocs\btu-marketing\resources\views\news\create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="bg-white shadow-lg rounded-lg p-6">
    <h1 class="text-3xl font-bold text-blue-900 mb-6">Добавяне на новина</h1>

    <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Заглавие</label>
            <input type="text" name="title" id="title" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('title') border-red-500 @enderror"
                   value="{{ old('title') }}" required>
            @error('title')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="content" class="block text-sm font-medium text-gray-700">Съдържание</label>
            <textarea name="content" id="content" rows="6" 
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('content') border-red-500 @enderror"
                      required>{{ old('content') }}</textarea>
            @error('content')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Изображение (опционално)</label>
            <input type="file" name="image" id="image" 
                   class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            @error('image')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="is_published" class="inline-flex items-center">
                <input type="checkbox" name="is_published" id="is_published" value="1" 
                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                       {{ old('is_published') ? 'checked' : '' }}>
                <span class="ml-2 text-sm text-gray-700">Публикувай</span>
            </label>
        </div>

        <div class="flex justify-end">
            <button type="submit" 
                    class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-800 transition-colors">
                Запази
            </button>
        </div>
    </form>
</div>
@endsection