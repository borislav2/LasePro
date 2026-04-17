@extends('components.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-blue-900">{{ __('messages.gallery_management') }}</h1>
            <a href="{{ route('media.create') }}" 
               class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-800 transition-colors inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                {{ __('messages.add_media') }}
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Filter Tabs --}}
        <div class="flex flex-wrap gap-2 mb-6">
            <a href="{{ route('media.index') }}" 
               class="px-4 py-2 rounded-full text-sm font-medium {{ !request('category') ? 'bg-blue-900 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                {{ __('messages.all') }}
            </a>
            <a href="{{ route('media.index', ['category' => 'wood']) }}" 
               class="px-4 py-2 rounded-full text-sm font-medium {{ request('category') == 'wood' ? 'bg-amber-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                {{ __('messages.wood') }}
            </a>
            <a href="{{ route('media.index', ['category' => 'stone']) }}" 
               class="px-4 py-2 rounded-full text-sm font-medium {{ request('category') == 'stone' ? 'bg-stone-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                {{ __('messages.stone') }}
            </a>
            <a href="{{ route('media.index', ['category' => 'metal']) }}" 
               class="px-4 py-2 rounded-full text-sm font-medium {{ request('category') == 'metal' ? 'bg-slate-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                {{ __('messages.metal') }}
            </a>
        </div>

        @if($media->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach($media as $item)
                <div class="border rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                    {{-- Preview --}}
                    <div class="aspect-video bg-gray-100 relative">
                        @if($item->isImage())
                            <img src="{{ $item->file_url }}" alt="{{ $item->title }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <video class="w-full h-full object-cover">
                                <source src="{{ $item->file_url }}" type="video/mp4">
                            </video>
                            <div class="absolute inset-0 flex items-center justify-center bg-black/30">
                                <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                        @endif
                        
                        {{-- Badges --}}
                        <div class="absolute top-2 left-2 flex gap-1">
                            <span class="px-2 py-1 text-xs rounded-full 
                                {{ $item->category == 'wood' ? 'bg-amber-100 text-amber-800' : '' }}
                                {{ $item->category == 'stone' ? 'bg-stone-100 text-stone-800' : '' }}
                                {{ $item->category == 'metal' ? 'bg-slate-100 text-slate-800' : '' }}">
                                {{ __('messages.' . $item->category) }}
                            </span>
                            @if($item->is_featured)
                                <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                                    {{ __('messages.featured') }}
                                </span>
                            @endif
                        </div>
                        
                        @if(!$item->is_published)
                            <div class="absolute top-2 right-2">
                                <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">
                                    {{ __('messages.draft') }}
                                </span>
                            </div>
                        @endif
                    </div>
                    
                    {{-- Info --}}
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 truncate">{{ $item->title }}</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ Str::limit($item->description, 50) }}</p>
                        <div class="flex justify-between items-center mt-3">
                            <span class="text-xs text-gray-400">#{{ $item->display_order }}</span>
                            <div class="flex gap-2">
                                <a href="{{ route('media.edit', $item) }}" 
                                   class="text-blue-600 hover:text-blue-800 text-sm">
                                    {{ __('messages.edit') }}
                                </a>
                                <form action="{{ route('media.destroy', $item) }}" method="POST" 
                                      class="inline" onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                        {{ __('messages.delete') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="mt-6">
                {{ $media->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="text-gray-500">{{ __('messages.no_media_found') }}</p>
                <a href="{{ route('media.create') }}" class="text-blue-600 hover:text-blue-800 mt-2 inline-block">
                    {{ __('messages.add_first_media') }}
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
