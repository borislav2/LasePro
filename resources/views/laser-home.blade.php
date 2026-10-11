@extends('layouts.site')

@section('title', __('messages.meta_title_home'))
@section('description', __('messages.meta_description_home'))
@section('canonical', url('/'))

@push('head')
    @php
        $localBusiness = [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => 'LasePro',
            'image' => asset('images/icons/icon-512.png'),
            'url' => url('/'),
            'telephone' => '+359886548030',
            'email' => 'lase.pro.bg@gmail.com',
            'address' => ['@type' => 'PostalAddress', 'addressLocality' => 'Varna', 'addressCountry' => 'BG'],
            'sameAs' => [
                'https://www.instagram.com/lase.pro',
                'https://www.facebook.com/profile.php?id=61577003014554',
            ],
            'description' => __('messages.meta_description_home'),
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($localBusiness, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    @livewireStyles
@endpush

@php
    $materials = [
        ['key' => 'wood',  'video' => 'images/wood1.mp4'],
        ['key' => 'stone', 'video' => 'images/StoneRemove.mp4'],
        ['key' => 'metal', 'video' => 'images/metalvideo2.mp4'],
    ];

    $cmp = 'storage/media/images/metal/compare/';
    $pairs = [
        [
            'label'  => __('messages.pair_table'),
            'before' => asset($cmp . 'table-before.jpg'),
            'after'  => asset($cmp . 'table-after.jpg'),
            'rn'     => round(1252 / 1436, 4),
        ],
        [
            'label'  => __('messages.pair_legs'),
            'before' => asset($cmp . 'legs-before.jpg'),
            'after'  => asset($cmp . 'legs-after.jpg'),
            'rn'     => round(1528 / 1744, 4),
        ],
    ];
@endphp

@section('content')

    {{-- Hero --}}
    <section class="hero">
        <video class="hero__video" autoplay muted loop playsinline preload="metadata" data-lazyplay aria-hidden="true">
            <source src="{{ asset('images/introvideo.mp4') }}" type="video/mp4">
        </video>
        <div class="hero__shade"></div>

        <div class="wrap hero__inner">
            <h1 class="hero__title">
                <span class="hero__text">
                    <span class="hero__line">{{ __('messages.hero_headline_1') }}</span>
                    <span class="hero__line">{{ __('messages.hero_headline_2') }}</span>
                </span>
            </h1>
            <p class="hero__lead">{{ __('messages.hero_lead') }}</p>
            <div class="hero__actions">
                <a class="btn btn--beam" href="#contact">{{ __('messages.get_free_quote') }}</a>
                <a class="btn btn--ghost" href="{{ route('gallery') }}">{{ __('messages.view_gallery') }}</a>
            </div>
        </div>
    </section>

    {{-- Материали --}}
    <section class="sec" id="materials">
        <div class="wrap">
            <div class="sec__head">
                <h2 class="sec__title">{{ __('messages.materials_title') }}</h2>
            </div>

            <div class="mats">
                @foreach ($materials as $m)
                    <a class="mat" href="{{ route('gallery', ['category' => $m['key']]) }}">
                        <video class="mat__video" muted loop playsinline preload="metadata" data-lazyplay aria-hidden="true">
                            <source src="{{ asset($m['video']) }}" type="video/mp4">
                        </video>
                        <span class="mat__shade"></span>
                        <span class="mat__body">
                            <span class="mat__name">{{ __('messages.' . $m['key']) }}</span>
                            <span class="mat__count">{{ __('messages.projects_count', ['count' => $counts[$m['key']] ?? 0]) }}</span>
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Преди / след --}}
    <section class="sec sec--dark" id="proof">
        <div class="wrap proof">
            <div>
                <h2 class="sec__title">{{ __('messages.proof_title') }}</h2>
                <p class="proof__hint">{{ __('messages.proof_hint') }}</p>

                <div class="tabs">
                    @foreach ($pairs as $i => $pair)
                        <button type="button" class="tab" data-pair="{{ $i }}" aria-pressed="{{ $i === 0 ? 'true' : 'false' }}">{{ $pair['label'] }}</button>
                    @endforeach
                </div>
            </div>

            <div class="compare" data-compare style="--rn: {{ $pairs[0]['rn'] }}" data-pairs="{{ json_encode($pairs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) }}">
                <div class="compare__stage">
                    <img class="compare__img compare__img--after" src="{{ $pairs[0]['after'] }}" alt="{{ $pairs[0]['label'] }}, {{ __('messages.label_after') }}" draggable="false">
                    <img class="compare__img compare__img--before" src="{{ $pairs[0]['before'] }}" alt="{{ $pairs[0]['label'] }}, {{ __('messages.label_before') }}" draggable="false">
                    <span class="compare__beam" aria-hidden="true"></span>
                    <span class="compare__tag compare__tag--before">{{ __('messages.label_before') }}</span>
                    <span class="compare__tag compare__tag--after">{{ __('messages.label_after') }}</span>
                    <input class="compare__range" type="range" min="0" max="100" value="50" aria-label="{{ __('messages.proof_hint') }}">
                </div>
            </div>
        </div>
    </section>

    {{-- Избрани работи --}}
    <section class="sec sec--alt" id="gallery">
        <div class="wrap">
            <div class="sec__head">
                <h2 class="sec__title">{{ __('messages.featured_work') }}</h2>
            </div>

            <div class="tiles">
                @foreach ($preview as $item)
                    <a class="tile" href="{{ route('gallery') }}#m{{ $item->id }}">
                        <img class="tile__media" src="{{ asset('storage/' . $item->file_path) }}" alt="" loading="lazy">
                        <span class="tile__cap">{{ $item->title }}</span>
                    </a>
                @endforeach
            </div>

            <div class="more">
                <a class="btn btn--line" href="{{ route('gallery') }}">{{ __('messages.all_work') }}</a>
            </div>
        </div>
    </section>

    {{-- Контакт --}}
    <section class="sec sec--dark" id="contact">
        <div class="wrap contact">
            <div>
                <h2 class="sec__title">{{ __('messages.contact_subtitle') }}</h2>
                <p class="contact__lead">{{ __('messages.contact_lead') }}</p>

                <ul class="contact__list">
                    <li><a class="contact__phone" href="tel:+359886548030">+359 886 548 030</a></li>
                    <li><a href="mailto:lase.pro.bg@gmail.com">lase.pro.bg@gmail.com</a></li>
                    <li>{{ __('messages.varna_bulgaria') }}</li>
                </ul>

                <p class="contact__social">
                    <a href="https://www.instagram.com/lase.pro" target="_blank" rel="noopener">Instagram</a>
                    <a href="https://www.facebook.com/profile.php?id=61577003014554" target="_blank" rel="noopener">Facebook</a>
                </p>
            </div>

            <div class="panel">
                @livewire('reservation-form')
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    @livewireScripts
@endpush
