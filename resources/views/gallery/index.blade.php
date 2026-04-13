<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.gallery_title') ?? 'Gallery - Lase Pro' }}</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Orbitron:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/laser.css') }}">
    <style>
        .tech-font { font-family: 'Orbitron', monospace; }
    </style>
</head>
<body class="bg-gradient-to-b from-sky-50 to-cyan-50 min-h-screen">
<div class="min-h-screen bg-gradient-to-b from-[var(--soft-sky)] to-[var(--aqua-light)] py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-12">
            <h1 class="tech-font text-4xl md:text-5xl font-bold text-[var(--ocean-blue)] mb-4">
                {{ __('messages.gallery_heading') ?? 'Our Work Gallery' }}
            </h1>
            <p class="text-lg text-cyan-700 max-w-2xl mx-auto">
                {{ __('messages.gallery_subtitle') ?? 'Explore our laser cleaning results on wood, stone, and metal surfaces.' }}
            </p>
        </div>

        <!-- Filter Tabs -->
        <div class="flex flex-wrap justify-center gap-3 mb-10">
            <a href="{{ route('gallery') }}" 
               class="px-6 py-3 rounded-full font-medium transition-all duration-300 {{ !$category && !$type ? 'bg-cyan-500 text-white shadow-lg' : 'bg-white/70 text-cyan-700 hover:bg-cyan-100' }}">
                {{ __('messages.all') ?? 'All' }}
            </a>
            <a href="{{ route('gallery', ['category' => 'wood']) }}" 
               class="px-6 py-3 rounded-full font-medium transition-all duration-300 {{ $category === 'wood' ? 'bg-amber-500 text-white shadow-lg' : 'bg-white/70 text-amber-700 hover:bg-amber-100' }}">
                {{ __('messages.wood') ?? 'Wood' }}
            </a>
            <a href="{{ route('gallery', ['category' => 'stone']) }}" 
               class="px-6 py-3 rounded-full font-medium transition-all duration-300 {{ $category === 'stone' ? 'bg-slate-500 text-white shadow-lg' : 'bg-white/70 text-slate-700 hover:bg-slate-100' }}">
                {{ __('messages.stone') ?? 'Stone' }}
            </a>
            <a href="{{ route('gallery', ['category' => 'metal']) }}" 
               class="px-6 py-3 rounded-full font-medium transition-all duration-300 {{ $category === 'metal' ? 'bg-blue-500 text-white shadow-lg' : 'bg-white/70 text-blue-700 hover:bg-blue-100' }}">
                {{ __('messages.metal') ?? 'Metal' }}
            </a>
        </div>

        <!-- Type Filter -->
        <div class="flex flex-wrap justify-center gap-2 mb-10">
            <a href="{{ route('gallery', array_merge(request()->except('type'), $category ? ['category' => $category] : [])) }}" 
               class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ !$type ? 'bg-cyan-500/20 text-cyan-700 border-2 border-cyan-500' : 'bg-white/50 text-cyan-600 border-2 border-transparent hover:border-cyan-300' }}">
                {{ __('messages.all_types') ?? 'All Types' }}
            </a>
            <a href="{{ route('gallery', array_merge(['type' => 'image'], request()->except('type'), $category ? ['category' => $category] : [])) }}" 
               class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ $type === 'image' ? 'bg-cyan-500/20 text-cyan-700 border-2 border-cyan-500' : 'bg-white/50 text-cyan-600 border-2 border-transparent hover:border-cyan-300' }}">
                {{ __('messages.images') ?? 'Images' }}
            </a>
            <a href="{{ route('gallery', array_merge(['type' => 'video'], request()->except('type'), $category ? ['category' => $category] : [])) }}" 
               class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ $type === 'video' ? 'bg-cyan-500/20 text-cyan-700 border-2 border-cyan-500' : 'bg-white/50 text-cyan-600 border-2 border-transparent hover:border-cyan-300' }}">
                {{ __('messages.videos') ?? 'Videos' }}
            </a>
        </div>

        @if($featuredMedia->count() > 0 && !$category && !$type)
        <!-- Featured Section -->
        <div class="mb-12">
            <h2 class="tech-font text-2xl font-bold text-[var(--ocean-blue)] mb-6 text-center">
                {{ __('messages.featured_work') ?? 'Featured Work' }}
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($featuredMedia as $item)
                <div class="group relative overflow-hidden rounded-2xl bg-white shadow-lg hover:shadow-2xl transition-all duration-500">
                    @if($item->isVideo())
                        <video class="w-full h-64 object-cover" controls poster="{{ asset('storage/' . $item->file_path) }}">
                            <source src="{{ asset('storage/' . $item->file_path) }}" type="video/mp4">
                        </video>
                        <div class="absolute top-3 right-3 bg-red-500 text-white p-2 rounded-full">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    @else
                        <img src="{{ asset('storage/' . $item->file_path) }}" alt="{{ $item->title }}" 
                             class="w-full h-64 object-cover transform group-hover:scale-110 transition-transform duration-500">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold mb-2 {{ $item->category === 'wood' ? 'bg-amber-500 text-white' : ($item->category === 'stone' ? 'bg-slate-500 text-white' : 'bg-blue-500 text-white') }}">
                                {{ ucfirst($item->category) }}
                            </span>
                            <h3 class="text-white font-semibold text-lg">{{ $item->title }}</h3>
                            @if($item->description)
                                <p class="text-white/80 text-sm mt-1">{{ Str::limit($item->description, 100) }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- All Media Grid -->
        @if($media->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($media as $item)
            <div class="group relative overflow-hidden rounded-xl bg-white shadow-md hover:shadow-xl transition-all duration-300">
                @if($item->isVideo())
                    <div class="relative">
                        <video class="w-full h-48 object-cover" controls>
                            <source src="{{ asset('storage/' . $item->file_path) }}" type="video/mp4">
                        </video>
                        <div class="absolute top-2 right-2 bg-red-500/90 text-white p-1.5 rounded-full">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                @else
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('storage/' . $item->file_path) }}" alt="{{ $item->title }}" 
                             class="w-full h-48 object-cover transform group-hover:scale-105 transition-transform duration-300">
                    </div>
                @endif
                <div class="p-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $item->category === 'wood' ? 'bg-amber-100 text-amber-700' : ($item->category === 'stone' ? 'bg-slate-100 text-slate-700' : 'bg-blue-100 text-blue-700') }}">
                            {{ ucfirst($item->category) }}
                        </span>
                        <span class="text-xs text-gray-500">{{ $item->isVideo() ? 'Video' : 'Image' }}</span>
                    </div>
                    <h3 class="font-semibold text-gray-800 line-clamp-2">{{ $item->title }}</h3>
                    @if($item->description)
                        <p class="text-gray-600 text-sm mt-1 line-clamp-2">{{ $item->description }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16">
            <div class="text-6xl mb-4">📷</div>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">
                {{ __('messages.no_media_found') ?? 'No media found' }}
            </h3>
            <p class="text-gray-500">
                {{ __('messages.try_different_filter') ?? 'Try selecting a different category or type.' }}
            </p>
        </div>
        @endif

        <!-- CTA Section -->
        <div class="mt-16 text-center">
            <div class="bg-gradient-to-r from-cyan-500 to-blue-600 rounded-2xl p-8 md:p-12 text-white">
                <h2 class="tech-font text-3xl md:text-4xl font-bold mb-4">
                    {{ __('messages.ready_to_transform') ?? 'Ready to Transform Your Surfaces?' }}
                </h2>
                <p class="text-lg text-white/90 mb-8 max-w-2xl mx-auto">
                    {{ __('messages.get_quote_cta') ?? 'Get a free quote for your laser cleaning project. We handle wood, stone, and metal surfaces.' }}
                </p>
                <a href="{{ route('home') }}#quote" 
                   class="inline-flex items-center px-8 py-4 bg-white text-cyan-600 rounded-full font-semibold text-lg hover:bg-cyan-50 transition-all duration-300 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    {{ __('messages.get_free_quote') ?? 'Get Free Quote' }}
                </a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
