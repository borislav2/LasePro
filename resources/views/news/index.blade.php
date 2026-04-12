@extends('layouts.app')

@section('content')
<div class="bg-white shadow-lg rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-blue-900">Новини</h1>
        @auth
            @if(auth()->user()->isAdmin()|| auth()->user()->isTeacher())
                <a href="{{ route('news.create') }}" 
                   class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-800 transition-colors">
                    <i class="fas fa-plus mr-2"></i>Добави новина
                </a>
            @endif
        @endauth
    </div>

    @if($news->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($news as $item)
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                    @if($item->image_path)
                        <img src="{{ asset('storage/' . $item->image_path) }}" 
                             alt="{{ $item->title }}" 
                             class="w-full h-48 object-cover">
                    @endif
                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-blue-900 mb-2">{{ $item->title }}</h3>
                        <div class="text-sm text-gray-600 mb-3">
                            <i class="far fa-calendar mr-2"></i>
                            {{ $item->created_at->format('d.m.Y') }}
                        </div>
                        <div class="text-gray-700 mb-4">
                            {!! Str::limit(strip_tags($item->content), 150) !!}
                        </div>
                        <a href="{{ route('news.show', $item) }}" 
                           class="inline-block bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-800 transition-colors">
                            Прочети повече
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $news->links() }}
        </div>
    @else
        <div class="text-center py-8 text-gray-600">
            <i class="far fa-newspaper text-4xl mb-3"></i>
            <p>Все още няма публикувани новини.</p>
        </div>
    @endif
</div>
@endsection