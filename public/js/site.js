(function () {
    'use strict';

    /* Тема */
    document.querySelectorAll('[data-theme-toggle]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var next = document.documentElement.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-theme', next);
            try { localStorage.setItem('theme', next); } catch (e) {}
        });
    });

    /* Навигация: прозрачна над hero, плътна след скрол */
    var nav = document.querySelector('[data-nav]');
    if (nav && nav.getAttribute('data-nav-fixed') !== '1') {
        var onScroll = function () { nav.classList.toggle('is-solid', window.scrollY > 40); };
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
    }

    /* Видеата играят само когато се виждат (те са съдържанието — играят и при "без анимации") */
    var videos = document.querySelectorAll('video[data-lazyplay]');
    if ('IntersectionObserver' in window) {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (e.isIntersecting) {
                    var p = e.target.play();
                    if (p && p.catch) p.catch(function () {});
                } else {
                    e.target.pause();
                }
            });
        }, { threshold: 0.25 });
        videos.forEach(function (v) { io.observe(v); });
    }

    /* Панели "Какво почистваме": остава отворен последният посочен — без мигане в процепите */
    document.querySelectorAll('.mats').forEach(function (wrap) {
        var panels = wrap.querySelectorAll('.mat');
        panels.forEach(function (panel) {
            panel.addEventListener('mouseenter', function () {
                panels.forEach(function (p) { p.classList.toggle('is-open', p === panel); });
            });
        });
        wrap.addEventListener('mouseleave', function () {
            panels.forEach(function (p) { p.classList.remove('is-open'); });
        });
    });

    /* Преди / след: лъчът е разделителят */
    document.querySelectorAll('[data-compare]').forEach(function (root) {
        var range = root.querySelector('.compare__range');
        var before = root.querySelector('.compare__img--before');
        var after = root.querySelector('.compare__img--after');
        var pairs = [];
        try { pairs = JSON.parse(root.getAttribute('data-pairs') || '[]'); } catch (e) {}

        function setPos(v) { root.style.setProperty('--pos', v + '%'); }
        range.addEventListener('input', function () { setPos(range.value); });
        setPos(range.value);

        var tabs = document.querySelectorAll('[data-pair]');
        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                var pair = pairs[Number(tab.getAttribute('data-pair'))];
                if (!pair) return;
                before.src = pair.before;
                after.src = pair.after;
                before.alt = pair.label;
                after.alt = pair.label;
                if (pair.rn) root.style.setProperty('--rn', pair.rn);
                range.value = 50;
                setPos(50);
                tabs.forEach(function (t) { t.setAttribute('aria-pressed', t === tab ? 'true' : 'false'); });
            });
        });
    });
})();
