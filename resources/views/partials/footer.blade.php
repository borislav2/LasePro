<footer class="footer">
    <div class="wrap footer__row">
        <a class="wordmark" href="{{ route('home') }}" aria-label="LasePro">
            <img class="wordmark__icon" src="{{ asset('images/logo.jpg') }}" alt="" width="30" height="30" loading="lazy">
            <span>LASE<span class="wordmark__pro">PRO</span></span>
        </a>
        <p>{{ __('messages.precision_laser_cleaning') }}, {{ __('messages.varna_bulgaria') }}</p>
        <p>&copy; {{ date('Y') }} Lase Pro. {{ __('messages.all_rights_reserved') }}.</p>
    </div>
</footer>
