/* The Social Dust: theme + language switches */
(function () {
  var root = document.documentElement;

  // Dark / light
  var themeBtn = document.querySelector('.theme-switch');
  if (themeBtn) {
    var syncTheme = function () {
      var dark = root.getAttribute('data-theme') === 'dark';
      themeBtn.setAttribute('aria-pressed', dark ? 'true' : 'false');
    };
    syncTheme();
    themeBtn.addEventListener('click', function () {
      var next = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
      root.setAttribute('data-theme', next);
      try { localStorage.setItem('tsd_theme', next); } catch (e) {}
      syncTheme();
    });
  }

  // English / Bangla
  var langBtn = document.querySelector('.lang-switch');
  if (langBtn) {
    langBtn.addEventListener('click', function () {
      var next = root.getAttribute('data-lang') === 'bn' ? 'en' : 'bn';
      root.setAttribute('data-lang', next);
      root.setAttribute('lang', next);
      document.cookie = 'tsd_lang=' + next + ';path=/;max-age=31536000;SameSite=Lax';
      // Drop ?lang= from the address bar so the cookie choice wins.
      if (window.history && location.search.indexOf('lang=') > -1) {
        var u = new URL(location.href);
        u.searchParams.delete('lang');
        history.replaceState(null, '', u.toString());
      }
    });
  }

  // Search toggle
  var sBtn = document.querySelector('.search-toggle');
  var sRow = document.getElementById('tsd-search');
  if (sBtn && sRow) {
    sBtn.addEventListener('click', function () {
      var open = sRow.classList.toggle('open');
      sBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
      if (open) { var i = sRow.querySelector('input'); if (i) i.focus(); }
    });
  }

  // Newsletter: submit without reloading the page
  var nl = document.querySelector('.newsletter-form');
  if (nl) {
    var msgs = {
      ok: ['You’re in! Thanks for subscribing.', 'সাবস্ক্রাইব করার জন্য ধন্যবাদ!', 'nl-ok'],
      exists: ['You’re already subscribed.', 'আপনি আগেই সাবস্ক্রাইব করেছেন।', 'nl-ok'],
      invalid: ['Please enter a valid email address.', 'সঠিক ইমেইল ঠিকানা দিন।', 'nl-err'],
      error: ['Something went wrong. Please try again.', 'কিছু একটা সমস্যা হয়েছে। আবার চেষ্টা করুন।', 'nl-err']
    };
    var show = function (status) {
      var m = msgs[status] || msgs.error;
      var box = nl.querySelector('.nl-msg');
      box.innerHTML = '';
      var span = document.createElement('span');
      span.className = m[2];
      var en = document.createElement('span'); en.className = 't-en'; en.textContent = m[0];
      var bn = document.createElement('span'); bn.className = 't-bn'; bn.lang = 'bn'; bn.textContent = m[1];
      span.appendChild(en); span.appendChild(bn); box.appendChild(span);
    };
    nl.addEventListener('submit', function (e) {
      var email = nl.querySelector('input[type="email"]');
      nl.querySelector('.nl-lang').value = root.getAttribute('data-lang') || 'en';
      if (!email.value || !email.checkValidity()) { e.preventDefault(); show('invalid'); email.focus(); return; }
      if (!window.fetch || !window.TSD) return; // fall back to a normal form post
      e.preventDefault();
      var btn = nl.querySelector('button[type="submit"]');
      btn.disabled = true;
      fetch(window.TSD.ajax, { method: 'POST', body: new FormData(nl), credentials: 'same-origin' })
        .then(function (r) { return r.json(); })
        .then(function (d) { show(d.status); if (d.status === 'ok' || d.status === 'exists') email.value = ''; })
        .catch(function () { show('error'); })
        .then(function () { btn.disabled = false; });
    });
  }

  // Contact form
  var ct = document.querySelector('.contact-form');
  if (ct) {
    var topic = ct.querySelector('#ct-topic');
    var route = ct.querySelector('.ct-route-to');
    var syncTopic = function () {
      route.textContent = topic.value === 'advertising' ? route.getAttribute('data-ads') : route.getAttribute('data-general');
    };
    var syncOptions = function () {
      var l = root.getAttribute('data-lang') === 'bn' ? 'bn' : 'en';
      Array.prototype.forEach.call(topic.options, function (o) { o.textContent = o.getAttribute('data-' + l); });
    };
    topic.addEventListener('change', syncTopic);
    syncTopic(); syncOptions();
    if (langBtn) langBtn.addEventListener('click', syncOptions);

    var ctMsgs = {
      ok: ['Thanks! Your message has been sent. We’ll get back to you soon.', 'ধন্যবাদ! আপনার বার্তা পাঠানো হয়েছে। শিগগিরই উত্তর দেব।', 'nl-ok'],
      invalid: ['Please fill in your name, a valid email and a message.', 'নাম, সঠিক ইমেইল ও বার্তা লিখুন।', 'nl-err'],
      error: ['Sorry, it didn’t send. Please email us directly.', 'দুঃখিত, পাঠানো যায়নি। সরাসরি ইমেইল করুন।', 'nl-err']
    };
    var ctShow = function (status) {
      var m = ctMsgs[status] || ctMsgs.error;
      var box = ct.querySelector('.ct-msg');
      box.innerHTML = '';
      var span = document.createElement('span'); span.className = m[2];
      var en = document.createElement('span'); en.className = 't-en'; en.textContent = m[0];
      var bn = document.createElement('span'); bn.className = 't-bn'; bn.lang = 'bn'; bn.textContent = m[1];
      span.appendChild(en); span.appendChild(bn); box.appendChild(span);
    };
    ct.addEventListener('submit', function (e) {
      ct.querySelector('.ct-lang').value = root.getAttribute('data-lang') || 'en';
      var bad = null;
      ['#ct-name', '#ct-email', '#ct-message'].forEach(function (sel) {
        var f = ct.querySelector(sel);
        var ok = f.value.trim() !== '' && f.checkValidity();
        f.setAttribute('aria-invalid', ok ? 'false' : 'true');
        if (!ok && !bad) bad = f;
      });
      if (bad) { e.preventDefault(); ctShow('invalid'); bad.focus(); return; }
      if (!window.fetch || !window.TSD) return;
      e.preventDefault();
      var btn = ct.querySelector('.ct-submit');
      btn.disabled = true;
      fetch(window.TSD.ajax, { method: 'POST', body: new FormData(ct), credentials: 'same-origin' })
        .then(function (r) { return r.json(); })
        .then(function (d) {
          ctShow(d.status);
          if (d.status === 'ok') { ct.querySelector('#ct-message').value = ''; }
        })
        .catch(function () { ctShow('error'); })
        .then(function () { btn.disabled = false; });
    });
  }

  // Copy link
  document.addEventListener('click', function (e) {
    var b = e.target.closest && e.target.closest('.copy-link');
    if (!b) return;
    var url = b.getAttribute('data-url');
    var done = function () {
      var old = b.innerHTML;
      b.innerHTML = '<span class="t-en">Copied ✓</span><span class="t-bn">কপি হয়েছে ✓</span>';
      setTimeout(function () { b.innerHTML = old; }, 1600);
    };
    if (navigator.clipboard) { navigator.clipboard.writeText(url).then(done, function () {}); }
  });
})();

/* Animations: scroll reveal + small touches */
(function () {
  var root = document.documentElement;
  if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
  if (!('IntersectionObserver' in window)) return;
  root.classList.add('tsd-anim');
  var sel = '.card, .section-head, .archive-head, .about-intro, .about-band, .cover-card, .approach-item, .about-close, .legal-body section, .contact-card, .contact-form, .single-wrap > *, .newsletter-inner > *';
  var io = new IntersectionObserver(function (entries) {
    entries.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
  }, { rootMargin: '0px 0px -40px 0px', threshold: 0.08 });
  var watch = function (scope) {
    var groups = new Map();
    (scope || document).querySelectorAll(sel).forEach(function (el) {
      if (el.classList.contains('reveal') || el.dataset.seen || el.closest('.hero-body')) return;
      // Anything already on screen stays as it is: no flash, no waiting.
      if (!initialDone && el.getBoundingClientRect().top < window.innerHeight) { el.dataset.seen = '1'; return; }
      el.classList.add('reveal');
      var p = el.parentElement, i = groups.get(p) || 0;   // stagger siblings
      el.style.setProperty('--d', Math.min(i, 6) * 0.07 + 's');
      groups.set(p, i + 1);
      io.observe(el);
    });
  };
  var initialDone = false;
  watch();
  initialDone = true;
  // Safety net: reveal anything that is on screen but was missed (e.g. very fast scrolling).
  var sweep = function () {
    document.querySelectorAll('.reveal:not(.in)').forEach(function (el) {
      if (el.getBoundingClientRect().top < window.innerHeight) el.classList.add('in');
    });
  };
  var st; window.addEventListener('scroll', function () { clearTimeout(st); st = setTimeout(sweep, 200); }, { passive: true });
  setTimeout(sweep, 1500);
  // Search results and other injected content animate too.
  new MutationObserver(function (m) { m.forEach(function (r) { r.addedNodes.forEach(function (n) { if (n.nodeType === 1) watch(n.parentElement || n); }); }); })
    .observe(document.querySelector('main') || document.body, { childList: true, subtree: true });
  var tb = document.querySelector('.theme-switch');
  if (tb) tb.addEventListener('click', function () { tb.classList.remove('spin'); void tb.offsetWidth; tb.classList.add('spin'); });
})();
