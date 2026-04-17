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
        
        <!-- Back Button -->
        <div class="mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/70 hover:bg-white text-cyan-700 font-medium transition-all duration-300 shadow-sm hover:shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                {{ __('messages.back_home') ?? 'Back to Home' }}
            </a>
        </div>

        <div class="text-center mb-12">
            <h1 class="tech-font text-4xl md:text-5xl font-bold text-[var(--ocean-blue)] mb-8">
                {{ __('messages.gallery_heading') ?? 'Our Work Gallery' }}
            </h1>
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

        <!-- Media Grid -->
        @if($media->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($media as $item)
            <div class="group relative overflow-hidden rounded-2xl bg-white shadow-lg hover:shadow-2xl transition-all duration-500 cursor-pointer" onclick="openModal('{{ $item->isVideo() ? 'video' : 'image' }}', '{{ asset($item->file_path) }}', '{{ $item->title }}')">
                @if($item->isVideo())
                    <video class="w-full h-64 object-cover" muted playsinline preload="metadata">
                        <source src="{{ asset($item->file_path) }}" type="video/mp4">
                    </video>
                    <div class="absolute inset-0 bg-black/30 flex items-center justify-center group-hover:bg-black/40 transition-all">
                        <div class="w-14 h-14 bg-red-500/90 text-white rounded-full flex items-center justify-center">
                            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                @else
                    <img src="{{ asset($item->file_path) }}" alt="{{ $item->title }}"
                         class="w-full h-64 object-cover transform group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all flex items-center justify-center">
                        <svg class="w-10 h-10 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                        </svg>
                    </div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <div class="absolute bottom-0 left-0 right-0 p-4">
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold mb-2 {{ $item->category === 'wood' ? 'bg-amber-500 text-white' : ($item->category === 'stone' ? 'bg-slate-500 text-white' : 'bg-blue-500 text-white') }}">
                            {{ ucfirst($item->category) }}
                        </span>
                        <h3 class="text-white font-semibold text-lg">{{ $item->title }}</h3>
                    </div>
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
            <div class="bg-gradient-to-r from-cyan-700 to-blue-800 rounded-2xl p-8 md:p-12 shadow-xl">
                <h2 class="tech-font text-3xl md:text-4xl font-bold mb-4" style="color: #ffffff; text-shadow: 0 2px 8px rgba(0,0,0,0.5);">
                    {{ __('messages.ready_to_transform') ?? 'Ready to Transform Your Surfaces?' }}
                </h2>
                <a href="{{ route('home') }}#contact" 
                   class="inline-flex items-center px-8 py-4 bg-white text-cyan-800 rounded-full font-semibold text-lg hover:bg-cyan-50 transition-all duration-300 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    {{ __('messages.get_free_quote') ?? 'Get Free Quote' }}
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal/Lightbox -->
<div id="mediaModal" class="fixed inset-0 z-50 hidden bg-black/95 backdrop-blur-sm" onclick="closeModal(event)">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative inline-block" onclick="event.stopPropagation()">
            <!-- Close Button -->
            <button onclick="closeModal()" class="absolute -top-10 right-0 text-white hover:text-cyan-400 transition-colors z-10">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            
            <!-- Modal Content - fits image size -->
            <div id="modalContent" class="relative rounded-lg overflow-hidden shadow-2xl">
                <!-- Image container -->
                <div id="imageContainer" class="hidden">
                    <img id="modalImage" src="" alt="" class="max-w-[90vw] max-h-[85vh] object-contain">
                    <!-- Title overlay at bottom -->
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-4">
                        <h3 id="modalImageTitle" class="text-xl font-semibold text-white"></h3>
                    </div>
                </div>
                <!-- Video container -->
                <div id="videoContainer" class="hidden">
                    <video id="modalVideo" class="max-w-[90vw] max-h-[85vh]" controls autoplay>
                        <source src="" type="video/mp4">
                    </video>
                    <!-- Title overlay at bottom for video -->
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-4">
                        <h3 id="modalVideoTitle" class="text-xl font-semibold text-white"></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function openModal(type, src, title) {
    const modal = document.getElementById('mediaModal');
    const imageContainer = document.getElementById('imageContainer');
    const videoContainer = document.getElementById('videoContainer');
    const modalImage = document.getElementById('modalImage');
    const modalVideo = document.getElementById('modalVideo');
    const modalImageTitle = document.getElementById('modalImageTitle');
    const modalVideoTitle = document.getElementById('modalVideoTitle');
    
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    
    if (type === 'image') {
        imageContainer.classList.remove('hidden');
        videoContainer.classList.add('hidden');
        modalImage.src = src;
        modalImage.alt = title;
        modalImageTitle.textContent = title;
    } else {
        imageContainer.classList.add('hidden');
        videoContainer.classList.remove('hidden');
        modalVideo.src = src;
        modalVideoTitle.textContent = title;
    }
}

function closeModal(event) {
    if (event && event.target !== event.currentTarget) return;
    
    const modal = document.getElementById('mediaModal');
    const modalVideo = document.getElementById('modalVideo');
    
    modal.classList.add('hidden');
    document.body.style.overflow = '';
    
    // Stop video when closing
    if (modalVideo) {
        modalVideo.pause();
        modalVideo.src = '';
    }
}

// Close on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeModal();
});
</script>

</body>
</html>
