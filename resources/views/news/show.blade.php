@extends('layouts.app')

@section('content')
<div class="bg-white shadow-lg rounded-lg p-6">
    <h1 class="text-3xl font-bold text-blue-900 mb-6">{{ $news->title }}</h1>

    @if($news->image_path)
        <img src="{{ asset('storage/' . $news->image_path) }}" 
             alt="{{ $news->title }}" 
             class="w-full h-64 object-cover rounded-lg mb-6">
    @endif

    <div class="text-gray-700 leading-relaxed">
        {!! $news->content !!}
    </div>

    @auth
        @if(auth()->user()->isTeacher() || auth()->user()->isAdmin())
            <div class="mt-6 flex space-x-4">
                <a href="{{ route('news.edit', $news) }}" 
                   class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-800 transition-colors">
                    Редактирай
                </a>
                <form method="POST" action="{{ route('news.destroy', $news) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-500 transition-colors">
                        Изтрий
                    </button>
                </form>
            </div>
        @endif
    @endauth
</div>
@endsection