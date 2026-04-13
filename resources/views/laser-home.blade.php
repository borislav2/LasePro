<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lase Pro - Прецизно лазерно почистване </title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Orbitron:wght@400;500;600;700;800;900&family=Exo+2:wght@400;500;600;700;800;900&family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/laser.css') }}">
    @livewireStyles
    <style>
        :root {
            --bg-body: #f0f9ff;
            --text-body: #0c4a6e;
        }
        
        [data-theme="dark"] {
            --bg-body: #020617;
            --text-body: #f0f9ff;
        }
        
        body, html {
            color: var(--text-body) !important;
            -webkit-text-fill-color: var(--text-body) !important;
            background: var(--bg-body) !important;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        
        .tech-font {
            font-family: 'Orbitron', 'Exo 2', 'Montserrat', monospace;
            
        }
        .brand-heading {
            color: var(--text-dark) !important;
            -webkit-text-fill-color: var(--text-dark) !important;
            background: none !important;
            background-image: none !important;
            -webkit-background-clip: unset !important;
            background-clip: unset !important;
        }
        .logo-text {
            color: var(--ocean-blue) !important;
            -webkit-text-fill-color: var(--ocean-blue) !important;
            background: none !important;
            background-image: none !important;
            -webkit-background-clip: unset !important;
            background-clip: unset !important;
        }
        .hero-bg {
            position: relative;
        }
        .hero-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            z-index: 0;
        }
        /* Mobile: Ensure video is centered and fully visible */
        @media (max-width: 768px) {
            .hero-video {
                object-fit: cover;
                object-position: center center;
                width: 100%;
                height: 100%;
            }
            .hero-bg {
                min-height: 100vh;
            }
        }
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, 
                rgba(224, 242, 254, 0.3) 0%, 
                rgba(224, 242, 254, 0.5) 50%,
                rgba(224, 242, 254, 0.95) 85%,
                rgba(224, 242, 254, 1) 100%);
            z-index: 1;
        }
        [data-theme="dark"] .hero-overlay {
            background: linear-gradient(to bottom, 
                rgba(2, 6, 23, 0.3) 0%, 
                rgba(2, 6, 23, 0.5) 50%,
                rgba(2, 6, 23, 0.95) 85%,
                rgba(2, 6, 23, 1) 100%);
        }
        
        /* Navigation theme styles */
        .nav-theme {
            background: var(--nav-bg);
            border-bottom: 1px solid var(--border-color);
            box-shadow: 0 4px 20px var(--shadow-color);
        }
        
        /* Section backgrounds */
        .section-light { background: var(--fresh-bg); }
        .section-gradient-1 { 
            background: linear-gradient(to bottom, var(--soft-sky), var(--aqua-light)); 
        }
        .section-gradient-2 { 
            background: linear-gradient(to bottom, var(--aqua-light), var(--soft-sky)); 
        }
    </style>
</head>
<body class="text-[var(--text-body)] overflow-x-hidden px-0">
    
  

    <!-- Navigation -->
    <nav class="fixed top-0 w-full nav-theme backdrop-blur-md z-50 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center h-16">
                <!-- Mobile: All items on left -->
                <div class="flex md:hidden items-center space-x-2 w-full">
                    <!-- Logo -->
                    <div class="nav-logo-container flex-shrink-0">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Lase Pro Logo" class="h-7 w-auto rounded-lg">
                    </div>
                    <!-- Phone icon -->
                    <a href="tel:+359886548030" class="w-8 h-8 rounded-full flex items-center justify-center bg-cyan-500/20 text-cyan-600 hover:bg-cyan-500 hover:text-white transition-all flex-shrink-0">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                    </a>
                    <!-- Email icon -->
                    <a href="mailto:lase.pro.bg@gmail.com" class="w-8 h-8 rounded-full flex items-center justify-center bg-cyan-500/20 text-cyan-600 hover:bg-cyan-500 hover:text-white transition-all flex-shrink-0">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                    </a>
                    <!-- Theme Toggle Mobile -->
                    <button id="theme-toggle-mobile" class="theme-toggle flex-shrink-0" style="transform: scale(0.8);" aria-label="Toggle dark mode">
                        <span class="theme-toggle-icon sun">☀️</span>
                        <span class="theme-toggle-icon moon">🌙</span>
                    </button>
                    <!-- Language Switcher Mobile -->
                    <div class="flex space-x-1 flex-shrink-0">
                        <a href="{{ route('language.switch', 'bg') }}" 
                           class="w-6 h-6 rounded-full flex items-center justify-center text-[10px] font-medium {{ app()->getLocale() === 'bg' ? 'bg-cyan-500 text-white' : 'border border-cyan-400 text-cyan-700 hover:border-cyan-500' }} transition-all">
                            BG
                        </a>
                        <a href="{{ route('language.switch', 'en') }}" 
                           class="w-6 h-6 rounded-full flex items-center justify-center text-[10px] font-medium {{ app()->getLocale() === 'en' ? 'bg-cyan-500 text-white' : 'border border-cyan-400 text-cyan-700 hover:border-cyan-500' }} transition-all">
                            EN
                        </a>
                    </div>
                </div>
                
                <!-- Desktop: Logo on left, controls on right -->
                <div class="hidden md:flex items-center justify-between w-full">
                    <!-- Logo -->
                    <div class="nav-logo-container">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Lase Pro Logo" class="h-10 w-auto rounded-lg">
                        <div class="tech-font text-2xl font-bold logo-text">LASE PRO</div>
                    </div>
                    
                    <!-- Controls -->
                    <div class="flex items-center space-x-6">
                        <a href="tel:+359886548030" class="flex items-center space-x-2 text-cyan-700 hover:text-cyan-500 transition-colors font-medium">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                            <span>+359 886 548 030</span>
                        </a>
                        <a href="mailto:lase.pro.bg@gmail.com" class="flex items-center space-x-2 text-cyan-700 hover:text-cyan-500 transition-colors font-medium">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                            <span>lase.pro.bg@gmail.com</span>
                        </a>
                        <!-- Theme Toggle -->
                        <button id="theme-toggle" class="theme-toggle" aria-label="Toggle dark mode">
                            <span class="theme-toggle-icon sun">☀️</span>
                            <span class="theme-toggle-icon moon">🌙</span>
                        </button>
                        <!-- Language Switcher -->
                        <div class="flex space-x-2">
                            <a href="{{ route('language.switch', 'bg') }}" 
                               class="px-3 py-1 rounded-full text-sm font-medium {{ app()->getLocale() === 'bg' ? 'bg-cyan-500 text-white' : 'border border-cyan-400 text-cyan-700 hover:border-cyan-500' }} transition-all">
                                BG
                            </a>
                            <a href="{{ route('language.switch', 'en') }}" 
                               class="px-3 py-1 rounded-full text-sm font-medium {{ app()->getLocale() === 'en' ? 'bg-cyan-500 text-white' : 'border border-cyan-400 text-cyan-700 hover:border-cyan-500' }} transition-all">
                                EN
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative h-screen flex items-center justify-center hero-bg overflow-hidden">
        <!-- Video Background -->
        <video autoplay muted loop playsinline class="hero-video">
            <source src="{{ asset('images/introvideo.mp4') }}" type="video/mp4">
        </video>
        <!-- Overlay to fade video text at bottom -->
        <div class="hero-overlay"></div>
        <!-- Particles -->
        <div id="particles" class="absolute inset-0 pointer-events-none z-[2]"></div>
        <div class="laser-beam-container absolute inset-0 z-[2]">
            <div class="laser-beam"></div>
            <div class="laser-beam"></div>
        </div>
        <!-- Hero Content -->
        <div class="max-w-7xl mx-auto text-center relative z-10 pt-20">
            <div class="fade-in-up">
               
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold mb-6 tech-font">
                 <span class="block brand-heading">{{ __('messages.hero_title') }}</span>
                </h1>
                
                <p class="text-xl md:text-2xl mb-8 max-w-4xl mx-auto leading-relaxed" style="color: var(--text-ocean);">
                    {{ __('messages.hero_description') }}
                </p>
                
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <div class="w-6 h-10 border-2 rounded-full flex justify-center" style="border-color: var(--cyan-blue);">
                <div class="w-1 h-3 rounded-full mt-2 animate-pulse" style="background: var(--cyan-blue);"></div>
            </div>
        </div>
    </section>

    <!-- WOOD Section - Fullscreen -->
    <section class="relative h-screen flex items-center justify-center overflow-hidden" id="wood">
        <!-- Video Background -->
        <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover">
            <source src="{{ asset('images/wood1.mp4') }}" type="video/mp4">
        </video>
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="relative z-10 text-center text-white px-4">
            <div class="text-6xl mb-4">🪵</div>
            <h2 class="text-5xl md:text-7xl font-bold tech-font mb-4">{{ __('messages.wood_restoration') }}</h2>
            <p class="text-xl md:text-2xl mb-8 max-w-2xl mx-auto">{{ __('messages.paint_removal') }}</p>
            
            <!-- Featured Media Preview -->
            @if($woodMedia->count() > 0)
            <div class="flex justify-center gap-4 mb-8">
                @foreach($woodMedia->take(3) as $media)
                <div class="w-24 h-24 md:w-32 md:h-32 rounded-lg overflow-hidden border-2 border-white/50 shadow-lg">
                    @if($media->isVideo())
                        <video class="w-full h-full object-cover" muted loop>
                            <source src="{{ asset('storage/' . $media->file_path) }}" type="video/mp4">
                        </video>
                    @else
                        <img src="{{ asset('storage/' . $media->file_path) }}" alt="{{ $media->title }}" class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                    @endif
                </div>
                @endforeach
            </div>
            @endif
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('gallery', ['category' => 'wood']) }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-full font-semibold bg-cyan-400 text-cyan-900 hover:bg-cyan-300 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ __('messages.view_gallery') ?? 'View Gallery' }}
                </a>
                <a href="{{ route('home') }}#contact" class="inline-flex items-center gap-2 px-8 py-4 rounded-full font-semibold border-2 border-white text-white hover:bg-white hover:text-cyan-900 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    {{ __('messages.get_quote') ?? 'Get Quote' }}
                </a>
            </div>
        </div>
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
        </div>
    </section>


    <!-- STONE Section - Fullscreen -->
    <section class="relative h-screen flex items-center justify-center overflow-hidden" id="stone">
        <!-- Video Background -->
        <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover">
            <source src="{{ asset('images/StoneRemove.mp4') }}" type="video/mp4">
        </video>
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="relative z-10 text-center text-white px-4">
            <div class="text-6xl mb-4">🏛️</div>
            <h2 class="text-5xl md:text-7xl font-bold tech-font mb-4">{{ __('messages.natural_stone_cleaning') }}</h2>
            <p class="text-xl md:text-2xl mb-8 max-w-2xl mx-auto">{{ __('messages.stone_granite_marble') }}</p>
            
            <!-- Featured Media Preview -->
            @if($stoneMedia->count() > 0)
            <div class="flex justify-center gap-4 mb-8">
                @foreach($stoneMedia->take(3) as $media)
                <div class="w-24 h-24 md:w-32 md:h-32 rounded-lg overflow-hidden border-2 border-white/50 shadow-lg">
                    @if($media->isVideo())
                        <video class="w-full h-full object-cover" muted loop>
                            <source src="{{ asset('storage/' . $media->file_path) }}" type="video/mp4">
                        </video>
                    @else
                        <img src="{{ asset('storage/' . $media->file_path) }}" alt="{{ $media->title }}" class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                    @endif
                </div>
                @endforeach
            </div>
            @endif
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('gallery', ['category' => 'stone']) }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-full font-semibold bg-cyan-400 text-cyan-900 hover:bg-cyan-300 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ __('messages.view_gallery') ?? 'View Gallery' }}
                </a>
                <a href="{{ route('home') }}#contact" class="inline-flex items-center gap-2 px-8 py-4 rounded-full font-semibold border-2 border-white text-white hover:bg-white hover:text-cyan-900 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    {{ __('messages.get_quote') ?? 'Get Quote' }}
                </a>
            </div>
        </div>
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
        </div>
    </section>

    <!-- METAL Section - Fullscreen -->
    <section class="relative h-screen flex items-center justify-center overflow-hidden" id="metal">
        <!-- Video Background -->
        <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover">
            <source src="{{ asset('images/0-02-05-ec5e4a233a114682bb1975ce54ef60b40c89ae6a015002ecf865918dd516a592_cd1975d9abc04f06.mp4') }}" type="video/mp4">
        </video>
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="relative z-10 text-center text-white px-4">
            <div class="text-6xl mb-4">⚙️</div>
            <h2 class="text-5xl md:text-7xl font-bold tech-font mb-4">{{ __('messages.metal_treatment') }}</h2>
            <p class="text-xl md:text-2xl mb-8 max-w-2xl mx-auto">{{ __('messages.weld_seam_cleaning') }}</p>
            
            <!-- Featured Media Preview -->
            @if($metalMedia->count() > 0)
            <div class="flex justify-center gap-4 mb-8">
                @foreach($metalMedia->take(3) as $media)
                <div class="w-24 h-24 md:w-32 md:h-32 rounded-lg overflow-hidden border-2 border-white/50 shadow-lg">
                    @if($media->isVideo())
                        <video class="w-full h-full object-cover" muted loop>
                            <source src="{{ asset('storage/' . $media->file_path) }}" type="video/mp4">
                        </video>
                    @else
                        <img src="{{ asset('storage/' . $media->file_path) }}" alt="{{ $media->title }}" class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                    @endif
                </div>
                @endforeach
            </div>
            @endif
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('gallery', ['category' => 'metal']) }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-full font-semibold bg-cyan-400 text-cyan-900 hover:bg-cyan-300 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ __('messages.view_gallery') ?? 'View Gallery' }}
                </a>
                <a href="{{ route('home') }}#contact" class="inline-flex items-center gap-2 px-8 py-4 rounded-full font-semibold border-2 border-white text-white hover:bg-white hover:text-cyan-900 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    {{ __('messages.get_quote') ?? 'Get Quote' }}
                </a>
            </div>
        </div>
    </section>

    <!-- New Gallery Section with Tabs -->
   


    <script>
        // Gallery State
        let currentMaterial = 'wood';
        let currentType = 'images';
        
        function switchMaterial(material) {
            currentMaterial = material;
            updateGalleryTabs();
            showGalleryContent();
        }
        
        function switchType(type) {
            currentType = type;
            updateGalleryTabs();
            showGalleryContent();
        }
        
        function openGallery(material, type) {
            currentMaterial = material;
            currentType = type;
            document.getElementById('gallery-section').scrollIntoView({ behavior: 'smooth' });
            updateGalleryTabs();
            showGalleryContent();
        }
        
        function updateGalleryTabs() {
            // Update material tabs
            document.querySelectorAll('#material-tabs .gallery-tab').forEach(tab => {
                tab.classList.toggle('active', tab.dataset.material === currentMaterial);
            });
            
            // Update type tabs
            document.querySelectorAll('#type-tabs .gallery-tab').forEach(tab => {
                tab.classList.toggle('active', tab.dataset.type === currentType);
            });
        }
        
        function showGalleryContent() {
            // Hide all
            document.querySelectorAll('.gallery-content').forEach(el => {
                el.classList.add('hidden');
                el.classList.remove('grid');
            });
            
            // Show current
            const targetId = `${currentMaterial}-${currentType}`;
            const target = document.getElementById(targetId);
            if (target) {
                target.classList.remove('hidden');
                target.classList.add('grid');
            }
        }
        
        // Initialize
        showGalleryContent();
    </script>
    <!-- Gallery Preview -->
    <section id="gallery" class="py-20 section-gradient-1">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 fade-in-up">
                <h2 class="text-4xl md:text-5xl font-bold tech-font mb-4">
                    <span style="color: var(--ocean-blue);">{{ __('messages.gallery_title') }}</span>
                </h2>
                <p class="text-xl" style="color: var(--text-ocean);">{{ __('messages.gallery_subtitle') }}</p>
            </div>

            <div class="masonry-grid">
                <!-- Gallery Item 1 -->
                <div class="masonry-item fade-in-up gallery-item" style="animation-delay: 0.1s" onclick="openLightbox(this)">
                    <img src="{{ asset('images/viber_image_2026-03-24_00-31-15-815.jpg') }}" alt="Laser cleaning project 1" class="w-full rounded-lg gallery-img">
                    <div class="gallery-overlay">
                        <div class="gallery-icon">🔍</div>
                        <p class="gallery-text">{{ __('messages.view_project') }}</p>
                    </div>
                </div>
                <!-- Gallery Item 2 -->
                <div class="masonry-item fade-in-up gallery-item" style="animation-delay: 0.2s" onclick="openLightbox(this)">
                    <img src="{{ asset('images/viber_image_2026-03-24_00-31-16-252.jpg') }}" alt="Laser cleaning project 2" class="w-full rounded-lg gallery-img">
                    <div class="gallery-overlay">
                        <div class="gallery-icon">🔍</div>
                        <p class="gallery-text">{{ __('messages.view_project') }}</p>
                    </div>
                </div>
                <!-- Gallery Item 3 -->
                <div class="masonry-item fade-in-up gallery-item" style="animation-delay: 0.3s" onclick="openLightbox(this)">
                    <img src="{{ asset('images/1774304653801954.jpg') }}" alt="Laser cleaning project 3" class="w-full rounded-lg gallery-img">
                    <div class="gallery-overlay">
                        <div class="gallery-icon">🔍</div>
                        <p class="gallery-text">{{ __('messages.view_project') }}</p>
                    </div>
                </div>
                <!-- Gallery Item 4 -->
                <div class="masonry-item fade-in-up gallery-item" style="animation-delay: 0.4s" onclick="openLightbox(this)">
                    <img src="{{ asset('images/1774304579347529.jpg') }}" alt="Laser cleaning project 4" class="w-full rounded-lg gallery-img">
                    <div class="gallery-overlay">
                        <div class="gallery-icon">🔍</div>
                        <p class="gallery-text">{{ __('messages.view_project') }}</p>
                    </div>
                </div>
                <!-- Gallery Item 5 -->
                <div class="masonry-item fade-in-up gallery-item" style="animation-delay: 0.5s" onclick="openLightbox(this)">
                    <img src="{{ asset('images/1774304544768486.jpg') }}" alt="Laser cleaning project 5" class="w-full rounded-lg gallery-img">
                    <div class="gallery-overlay">
                        <div class="gallery-icon">🔍</div>
                        <p class="gallery-text">{{ __('messages.view_project') }}</p>
                    </div>
                </div>
                <!-- Gallery Item 6 -->
                <div class="masonry-item fade-in-up gallery-item" style="animation-delay: 0.6s" onclick="openLightbox(this)">
                    <img src="{{ asset('images/1774304515818586.jpg') }}" alt="Laser cleaning project 6" class="w-full rounded-lg gallery-img">
                    <div class="gallery-overlay">
                        <div class="gallery-icon">🔍</div>
                        <p class="gallery-text">{{ __('messages.view_project') }}</p>
                    </div>
                </div>
                <!-- Gallery Item 7 -->
                <div class="masonry-item fade-in-up gallery-item" style="animation-delay: 0.7s" onclick="openLightbox(this)">
                    <img src="{{ asset('images/1774304238932155.jpg') }}" alt="Laser cleaning project 7" class="w-full rounded-lg gallery-img">
                    <div class="gallery-overlay">
                        <div class="gallery-icon">🔍</div>
                        <p class="gallery-text">{{ __('messages.view_project') }}</p>
                    </div>
                </div>
            </div>

            <!-- Lightbox Modal -->
            <div id="lightbox" class="lightbox" onclick="closeLightbox(event)">
                <div class="lightbox-content">
                    <span class="lightbox-close" onclick="closeLightbox(event)">&times;</span>
                    <img id="lightbox-img" src="" alt="Gallery Image" class="lightbox-img">
                    <div class="lightbox-nav">
                        <button class="lightbox-prev" onclick="changeImage(-1, event)">&#10094;</button>
                        <button class="lightbox-next" onclick="changeImage(1, event)">&#10095;</button>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('gallery') }}" class="laser-btn px-8 py-4 rounded-full text-lg inline-block">
                    {{ __('messages.gallery_title') }}
                </a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 section-gradient-2">
        <div class="max-w-7xl mx-auto">
            <div class="text-center fade-in-up mb-12">
                <h2 class="text-4xl md:text-5xl font-bold tech-font mb-4">
                    <span class="brand-heading">{{ __('messages.get_in_touch') }}</span>
                </h2>
                <p class="text-xl" style="color: var(--text-ocean);">{{ __('messages.contact_subtitle') }}</p>
            </div>
            <div class="fade-in-up" style="animation-delay: 0.2s">
                <h3 class="text-2xl font-bold mb-6" style="color: var(--ocean-blue);">{{ __('messages.get_quote') }}</h3>
                @livewire('reservation-form')
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="py-16 border-t" style="background: linear-gradient(to right, var(--soft-sky), var(--aqua-light)); border-color: var(--border-color);">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-12 mb-12">
                <!-- Brand Column -->
                <div class="text-center md:text-left">
                    <div class="flex items-center justify-center md:justify-start mb-4">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Lase Pro Logo" class="h-12 w-auto rounded-lg mr-3">
                        <div class="tech-font text-2xl font-bold" style="color: var(--ocean-blue);">LASE PRO</div>
                    </div>
                    <p class="mb-2" style="color: var(--text-ocean);">{{ __('messages.precision_laser_cleaning') }}</p>
                    <p class="font-semibold" style="color: var(--sky-blue);">{{ __('messages.varna_bulgaria') }}</p>
                </div>
                
                <!-- Quick Links -->
                <div class="text-center">
                    <h4 class="text-lg font-semibold mb-4" style="color: var(--text-dark);">{{ __('messages.quick_links') }}</h4>
                    <div class="space-y-2">
                        <a href="#gallery" class="block transition-colors" style="color: var(--text-ocean);" onmouseover="this.style.color='var(--ocean-blue)'" onmouseout="this.style.color='var(--text-ocean)'">{{ __('messages.gallery') }}</a>
                        <a href="#contact" class="block transition-colors" style="color: var(--text-ocean);" onmouseover="this.style.color='var(--ocean-blue)'" onmouseout="this.style.color='var(--text-ocean)'">{{ __('messages.contact_footer') }}</a>
                    </div>
                </div>
                
                <!-- Contact & Social -->
                <div class="text-center md:text-left">
                    <h4 class="text-lg font-semibold mb-4" style="color: var(--text-dark);">{{ __('messages.contact_footer') }}</h4>
                    <div class="space-y-3">
                        <a href="mailto:lase.pro.bg@gmail.com" class="flex items-center justify-center md:justify-start space-x-2 transition-colors hover:opacity-80" style="color: var(--text-ocean);">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                            <span>lase.pro.bg@gmail.com</span>
                        </a>
                        <a href="tel:+359886548030" class="flex items-center justify-center md:justify-start space-x-2 transition-colors hover:opacity-80" style="color: var(--text-ocean);">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                            <span>+359 886 548 030</span>
                        </a>
                        <div class="flex items-center justify-center md:justify-start space-x-2" style="color: var(--text-ocean);">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                            <span>Varna, Bulgaria</span>
                        </div>
                    </div>
                    
                    <!-- Social Icons -->
                    <div class="flex items-center justify-center md:justify-start space-x-3 mt-6">
                        <a href="https://www.instagram.com/lase.pro" target="_blank" 
                           class="w-9 h-9 rounded-full flex items-center justify-center transition-all" style="background: var(--card-bg);" onmouseover="this.style.background='var(--ocean-blue)'; this.querySelector('svg').style.color='white';" onmouseout="this.style.background='var(--card-bg)'; this.querySelector('svg').style.color='var(--text-ocean)';">
                            <svg class="w-4 h-4" style="color: var(--text-ocean);" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <a href="https://www.facebook.com/profile.php?id=61577003014554" target="_blank" 
                           class="w-9 h-9 rounded-full flex items-center justify-center transition-all" style="background: var(--card-bg);" onmouseover="this.style.background='var(--ocean-blue)'; this.querySelector('svg').style.color='white';" onmouseout="this.style.background='var(--card-bg)'; this.querySelector('svg').style.color='var(--text-ocean)';">
                            <svg class="w-4 h-4" style="color: var(--text-ocean);" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Copyright Bar -->
            <div class="pt-8 text-center border-t" style="border-color: var(--border-color);">
                <p class="text-sm" style="color: var(--text-muted);">
                    {{ date('Y') }} Lase Pro. {{ __('messages.all_rights_reserved') }}.
                </p>
            </div>
        </div>
    </footer>

    @livewireScripts

    <!-- JavaScript -->
    <script>
        // Generate floating particles
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            if (!particlesContainer) return;
            
            for (let i = 0; i < 20; i++) {
                const particle = document.createElement('div');
                particle.className = 'laser-particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 3 + 's';
                particlesContainer.appendChild(particle);
            }
        }

      

        // Scroll animations
        function handleScroll() {
            const elements = document.querySelectorAll('.fade-in-up');
            elements.forEach(element => {
                const rect = element.getBoundingClientRect();
                if (rect.top < window.innerHeight * 0.8) {
                    element.classList.add('visible');
                }
            });
        }

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        // Lightbox functionality
        let currentImageIndex = 0;
        const galleryImages = [];

        function initGallery() {
            const items = document.querySelectorAll('.gallery-item img');
            items.forEach((img, index) => {
                galleryImages.push(img.src);
                img.closest('.gallery-item').dataset.index = index;
            });
        }

        function openLightbox(element) {
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = document.getElementById('lightbox-img');
            const img = element.querySelector('img');
            
            currentImageIndex = parseInt(element.dataset.index);
            lightboxImg.src = img.src;
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox(event) {
            if (event.target.id === 'lightbox' || event.target.className === 'lightbox-close') {
                const lightbox = document.getElementById('lightbox');
                lightbox.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        }

        function changeImage(direction, event) {
            event.stopPropagation();
            currentImageIndex += direction;
            
            if (currentImageIndex < 0) {
                currentImageIndex = galleryImages.length - 1;
            } else if (currentImageIndex >= galleryImages.length) {
                currentImageIndex = 0;
            }
            
            const lightboxImg = document.getElementById('lightbox-img');
            lightboxImg.style.opacity = '0';
            
            setTimeout(() => {
                lightboxImg.src = galleryImages[currentImageIndex];
                lightboxImg.style.opacity = '1';
            }, 200);
        }

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            const lightbox = document.getElementById('lightbox');
            if (!lightbox.classList.contains('active')) return;
            
            if (e.key === 'Escape') {
                lightbox.classList.remove('active');
                document.body.style.overflow = 'auto';
            } else if (e.key === 'ArrowLeft') {
                changeImage(-1, { stopPropagation: () => {} });
            } else if (e.key === 'ArrowRight') {
                changeImage(1, { stopPropagation: () => {} });
            }
        });

        // Enhanced laser effects - Clean Cyan
        function addLaserEffects() {
            // Add random laser sweeps
            setInterval(() => {
                const laser = document.createElement('div');
                laser.className = 'random-laser';
                laser.style.cssText = `
                    position: fixed;
                    width: 2px;
                    height: 100vh;
                    background: linear-gradient(to bottom, transparent, #22d3ee, transparent);
                    box-shadow: 0 0 20px #22d3ee;
                    left: ${Math.random() * 100}%;
                    top: 0;
                    pointer-events: none;
                    z-index: 1;
                    animation: laserSweep 0.5s ease-out forwards;
                `;
                document.body.appendChild(laser);
                
                setTimeout(() => laser.remove(), 500);
            }, 3000);
        }

        // Theme Toggle functionality
        function initThemeToggle() {
            const themeToggle = document.getElementById('theme-toggle');
            const themeToggleMobile = document.getElementById('theme-toggle-mobile');
            const html = document.documentElement;
            
            // Check for saved theme preference or default to 'light'
            const savedTheme = localStorage.getItem('theme') || 'light';
            html.setAttribute('data-theme', savedTheme);
            
            function toggleTheme() {
                const currentTheme = html.getAttribute('data-theme');
                const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                
                html.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);
            }
            
            // Desktop theme toggle
            if (themeToggle) {
                themeToggle.addEventListener('click', toggleTheme);
            }
            
            // Mobile theme toggle
            if (themeToggleMobile) {
                themeToggleMobile.addEventListener('click', toggleTheme);
            }
        }

        // Initialize everything
        document.addEventListener('DOMContentLoaded', () => {
            createParticles();
            initGallery();
            addLaserEffects();
            initThemeToggle();
            handleScroll();
            window.addEventListener('scroll', handleScroll);
        });
            
        // Add CSS animation for random lasers
        const style = document.createElement('style');
        style.textContent = `
            @keyframes laserSweep {
                0% { opacity: 0; transform: scaleY(0); }
                50% { opacity: 1; transform: scaleY(1); }
                100% { opacity: 0; transform: scaleY(0); }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
