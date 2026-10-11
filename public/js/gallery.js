(function () {
    'use strict';

    var data = window.GALLERY || [];
    var dlg = document.getElementById('lb');
    if (!data.length || !dlg || typeof dlg.showModal !== 'function') return;

    var stage = document.getElementById('lb-stage');
    var titleEl = document.getElementById('lb-title');
    var descEl = document.getElementById('lb-desc');
    var countEl = document.getElementById('lb-count');
    var idx = 0;
    var opener = null;

    function render() {
        var item = data[idx];
        var old = stage.querySelector('.lb__media');
        if (old) {
            if (old.pause) old.pause();
            old.remove();
        }

        var el;
        if (item.type === 'video') {
            el = document.createElement('video');
            el.src = item.src;
            el.controls = true;
            el.autoplay = true;
            el.muted = true;
            el.loop = true;
            el.playsInline = true;
        } else {
            el = document.createElement('img');
            el.src = item.src;
            el.alt = item.title;
        }
        el.className = 'lb__media';
        stage.prepend(el);

        titleEl.textContent = item.title;
        descEl.textContent = item.desc || '';
        countEl.textContent = (idx + 1) + ' / ' + data.length;
    }

    function open(i, trigger) {
        idx = i;
        opener = trigger || null;
        render();
        if (!dlg.open) dlg.showModal();
    }

    function step(d) {
        idx = (idx + d + data.length) % data.length;
        render();
    }

    document.querySelectorAll('[data-index]').forEach(function (btn) {
        btn.addEventListener('click', function () { open(Number(btn.getAttribute('data-index')), btn); });
    });

    dlg.querySelector('[data-lb-close]').addEventListener('click', function () { dlg.close(); });
    dlg.querySelector('[data-lb-prev]').addEventListener('click', function () { step(-1); });
    dlg.querySelector('[data-lb-next]').addEventListener('click', function () { step(1); });

    stage.addEventListener('click', function (e) { if (e.target === stage) dlg.close(); });

    dlg.addEventListener('keydown', function (e) {
        if (e.key === 'ArrowLeft') { e.preventDefault(); step(-1); }
        if (e.key === 'ArrowRight') { e.preventDefault(); step(1); }
    });

    dlg.addEventListener('close', function () {
        var v = stage.querySelector('video');
        if (v) v.pause();
        if (opener) opener.focus();
    });

    /* Връзка от началната страница: /gallery#m12 отваря точния проект */
    var m = location.hash.match(/^#m(\d+)$/);
    if (m) {
        var i = data.findIndex(function (x) { return String(x.id) === m[1]; });
        if (i >= 0) open(i, null);
    }
})();
