<header class="nav{{ $solid ? ' is-solid' : '' }}" data-nav data-nav-fixed="{{ $solid ? '1' : '0' }}">
    <div class="wrap nav__row">
        <a class="wordmark" href="{{ route('home') }}" aria-label="LasePro">
            <img class="wordmark__icon" src="{{ asset('images/logo.jpg') }}" alt="" width="36" height="36">
            <span>LASE<span class="wordmark__pro">PRO</span></span>
        </a>

        <div class="nav__tools">
            <a class="nav__phone" href="tel:+359886548030" aria-label="{{ __('messages.phone') }}: +359 886 548 030">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                <span>+359 886 548 030</span>
            </a>

            <nav class="lang" aria-label="Language">
                <a href="{{ route('language.switch', 'bg') }}" hreflang="bg" lang="bg" @if(app()->getLocale() === 'bg') aria-current="true" @endif>BG</a>
                <a href="{{ route('language.switch', 'en') }}" hreflang="en" lang="en" @if(app()->getLocale() === 'en') aria-current="true" @endif>EN</a>
            </nav>

            <button class="icon-btn" type="button" data-theme-toggle aria-label="{{ __('messages.theme_toggle') }}">
                <svg class="i-moon" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z"/></svg>
                <svg class="i-sun" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
            </button>
        </div>
    </div>
</header>
