@extends('layouts.site')

@section('title', __('messages.meta_title_gallery'))
@section('description', __('messages.meta_description_gallery'))
@section('canonical', route('gallery'))
@section('nav_solid', '1')

@php
    $url = fn ($c, $t) => route('gallery', array_filter(['category' => $c, 'type' => $t]));

    $items = $media->map(fn ($m) => [
        'id' => $m->id,
        'type' => $m->type,
        'src' => asset('storage/' . $m->file_path),
        'title' => $m->title,
        'desc' => $m->description,
    ])->values();
@endphp

@section('content')

    <section class="gal-head">
        <div class="wrap">
            <h1 class="gal-title">{{ __('messages.gallery_heading') }}</h1>

            <div class="filters">
                <div class="filters__row">
                    <a class="chip" href="{{ $url(null, $type) }}" @if(!$category) aria-current="true" @endif>{{ __('messages.all') }}</a>
                    @foreach (['wood', 'stone', 'metal'] as $c)
                        <a class="chip" href="{{ $url($c, $type) }}" @if($category === $c) aria-current="true" @endif>{{ __('messages.' . $c) }}</a>
                    @endforeach
                </div>
                <div class="filters__row">
                    <a class="chip" href="{{ $url($category, null) }}" @if(!$type) aria-current="true" @endif>{{ __('messages.all_types') }}</a>
                    <a class="chip" href="{{ $url($category, 'image') }}" @if($type === 'image') aria-current="true" @endif>{{ __('messages.images') }}</a>
                    <a class="chip" href="{{ $url($category, 'video') }}" @if($type === 'video') aria-current="true" @endif>{{ __('messages.videos') }}</a>
                </div>
            </div>
        </div>
    </section>

    <section class="gal-body">
        <div class="wrap">
            @if ($media->count() > 0)
                <div class="tiles">
                    @foreach ($media as $i => $item)
                        <button class="tile" type="button" id="m{{ $item->id }}" data-index="{{ $i }}">
                            @if ($item->isVideo())
                                <video class="tile__media" src="{{ asset('storage/' . $item->file_path) }}#t=0.1" muted playsinline preload="metadata" aria-hidden="true"></video>
                                <span class="tile__play" aria-hidden="true">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="#fff"><path d="M7 4.5v15l13-7.5z"/></svg>
                                </span>
                            @else
                                <img class="tile__media" src="{{ asset('storage/' . $item->file_path) }}" alt="" loading="lazy">
                            @endif
                            <span class="tile__cap">{{ $item->title }}</span>
                        </button>
                    @endforeach
                </div>
            @else
                <div class="gal-empty">
                    <strong>{{ __('messages.no_media_found') }}</strong>
                    <p>{{ __('messages.try_different_filter') }}</p>
                </div>
            @endif
        </div>
    </section>

    <section class="sec sec--dark">
        <div class="wrap gal-cta">
            <h2 class="sec__title">{{ __('messages.ready_to_transform') }}</h2>
            <a class="btn btn--beam" href="{{ route('home') }}#contact">{{ __('messages.get_quote_now') }}</a>
        </div>
    </section>

    <dialog class="lb" id="lb" aria-label="{{ __('messages.gallery_heading') }}">
        <div class="lb__inner">
            <div class="lb__stage" id="lb-stage">
                <button class="lb__btn lb__btn--close" type="button" data-lb-close aria-label="{{ __('messages.lb_close') }}">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M5 5l14 14M19 5L5 19"/></svg>
                </button>
                <button class="lb__btn lb__btn--prev" type="button" data-lb-prev aria-label="{{ __('messages.lb_prev') }}">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 5l-7 7 7 7"/></svg>
                </button>
                <button class="lb__btn lb__btn--next" type="button" data-lb-next aria-label="{{ __('messages.lb_next') }}">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
            <div class="lb__bar">
                <div>
                    <p class="lb__title" id="lb-title"></p>
                    <p class="lb__desc" id="lb-desc"></p>
                </div>
                <span class="lb__count" id="lb-count"></span>
            </div>
        </div>
    </dialog>

@endsection

@push('scripts')
    <script>window.GALLERY = @json($items);</script>
    <script src="{{ asset('js/gallery.js') }}?v={{ filemtime(public_path('js/gallery.js')) }}" defer></script>
@endpush
