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
                'https://www.tiktok.com/@lasepro2',
            ],
            'description' => __('messages.meta_description_home'),
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($localBusiness, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endpush

@php
    $materials = [
        ['key' => 'wood',  'video' => 'images/wood1.mp4'],
        ['key' => 'stone', 'video' => 'images/StoneRemove.mp4'],
        ['key' => 'metal', 'video' => 'images/metalvideo2.mp4'],
    ];

    $partners = [
        ['name' => 'Империум груп', 'url' => 'https://imperiumgroup-bg.com/', 'logo' => 'imperium.png'],
        ['name' => 'VIVAHOME', 'url' => 'https://vivahome.bg/', 'logo' => 'vivahome.png'],
        ['name' => 'Todoor', 'url' => 'https://todoor.bg/', 'logo' => 'todoor.svg'],
        ['name' => 'МААТ Инженеринг', 'url' => 'https://maatengineering.bg/shop/', 'logo' => 'maat.png'],
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

        <div class="wrap hero__inner">
            <h1 class="hero__title">
                <span class="hero__text">
                    <span class="hero__line">{{ __('messages.hero_headline_1') }}</span>
                    <span class="hero__line">{{ __('messages.hero_headline_2') }}</span>
                </span>
            </h1>
            <p class="hero__lead">{{ __('messages.hero_lead') }}</p>
            <div class="hero__actions">
                <a class="btn btn--beam" href="#contact">{{ __('messages.get_quote_now') }}</a>
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

    {{-- Партньори --}}
    <section class="sec sec--slim" id="partners">
        <div class="wrap">
            <div class="sec__head">
                <h2 class="sec__title">{{ __('messages.partners_title') }}</h2>
            </div>

            <ul class="partners">
                @foreach ($partners as $partner)
                    <li>
                        <a class="partner" href="{{ $partner['url'] }}" target="_blank" rel="noopener">
                            <span class="partner__logo">
                                <img src="{{ asset('images/partners/' . $partner['logo']) }}" alt="" loading="lazy">
                            </span>
                            <span class="partner__name">{{ $partner['name'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
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

                <div class="contact__social">
                    <a class="btn btn--ig social-btn" href="https://www.instagram.com/lase.pro" target="_blank" rel="noopener">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <rect x="3" y="3" width="18" height="18" rx="5"/>
                            <circle cx="12" cy="12" r="4.2"/>
                            <circle cx="17.5" cy="6.5" r="1.1" fill="currentColor" stroke="none"/>
                        </svg>
                        <span>Instagram</span>
                    </a>
                    <a class="btn btn--fb social-btn" href="https://www.facebook.com/profile.php?id=61577003014554" target="_blank" rel="noopener">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                        <span>Facebook</span>
                    </a>
                    <a class="btn btn--tt social-btn" href="https://www.tiktok.com/@lasepro2" target="_blank" rel="noopener">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                        </svg>
                        <span>TikTok</span>
                    </a>
                </div>
            </div>

            <div class="panel chat">
                <p class="chat__title">{{ __('messages.chat_title') }}</p>

                <a class="btn btn--viber chat__btn" href="viber://chat?number=%2B359886548030">
                    <svg width="30" height="30" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill="currentColor" d="M12 2C6.5 2 3 5.4 3 10.4c0 2.6 1.1 4.7 3 6.1V21l3.6-2.3c.8.2 1.5.3 2.4.3 5.5 0 9-3.400 9-8.600S17.500 2 12 2z"/>
                        <path class="chat__glyph" transform="translate(7.2 6.4) scale(0.4)" d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                    </svg>
                    <span>Viber</span>
                </a>

                <a class="btn btn--wa chat__btn" href="https://wa.me/359886548030" target="_blank" rel="noopener">
                    <svg width="30" height="30" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill="currentColor" d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                    </svg>
                    <span>WhatsApp</span>
                </a>
            </div>
        </div>
    </section>

@endsection
