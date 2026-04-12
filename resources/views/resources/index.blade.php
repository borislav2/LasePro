@extends('layouts.app')

@section('content')
<div class="bg-white shadow-lg rounded-lg p-6">
    <h1 class="text-3xl font-bold text-blue-900 mb-6">Учебни материали</h1>

    @if($resources->count() > 0)
        <div class="grid gap-4">
            @foreach($resources as $resource)
                <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200 hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-blue-900">{{ $resource->title }}</h3>
                            @if($resource->description)
                                <p class="text-gray-600 mt-1">{{ $resource->description }}</p>
                            @endif
                            <div class="flex items-center mt-2 text-sm text-gray-500">
                                <span class="mr-4">
                                    <i class="far fa-calendar mr-1"></i>
                                    {{ $resource->created_at->format('d.m.Y') }}
                                </span>
                                <span>
                                    <i class="far fa-file mr-1"></i>
                                    {{ strtoupper($resource->mime_type) }}
                                </span>
                            </div>
                        </div>
                        <a href="{{ route('resources.download', $resource) }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-900 text-white rounded hover:bg-blue-800 transition-colors">
                            <i class="fas fa-download mr-2"></i>
                            Изтегли
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $resources->links() }}
        </div>
    @else
        <div class="text-center py-8 text-gray-600">
            <i class="far fa-folder-open text-4xl mb-3"></i>
            <p>В момента няма налични материали.</p>
        </div>
    @endif
</div>
@endsection