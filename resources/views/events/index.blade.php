@extends('layouts.app')

@section('content')
<div class="bg-white shadow-lg rounded-lg p-6">
    <h1 class="text-3xl font-bold text-blue-900 mb-6">Предстоящи събития</h1>
    @if($events->count() > 0)
        <p class="text-gray-700 mb-4">Тук можете да намерите информация за предстоящите събития, организирани от БТУ Маркетинг.</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            @foreach($events as $event)
         
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                    @if($event->image_path)
                        <img src="{{ asset('storage/' . $event->image_path) }}" 
                             alt="{{ $event->title }}" 
                             class="w-full h-48 object-cover">
                    @endif
                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-blue-900 mb-2">{{ $event->title }}</h3>
                        <div class="text-sm text-gray-600 space-y-1">
                            <p>
                                <i class="far fa-clock mr-2"></i>
                                {{ \Carbon\Carbon::parse($event->start_datetime)->format('d.m.Y H:i') }}
                            </p>
                                <p>
                                <i class="far fa-clock mr-2"></i>
                                {{ \Carbon\Carbon::parse($event->end_datetime)->format('d.m.Y H:i') }}
                            </p>
                            @if($event->location)
                                <p>
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    {{ $event->location }}
                                </p>
                            @endif
                        </div>
                        @if($event->description)
                            <div class="mt-3 text-gray-700">
                                {!! Str::limit($event->description, 150) !!}
                            </div>
                        @endif
                      
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $events->links() }}
        </div>
    @else
        <div class="text-center py-8 text-gray-600">
            <i class="far fa-calendar-times text-4xl mb-3"></i>
            <p>В момента няма предстоящи събития.</p>
        </div>
    @endif
</div>
@endsection