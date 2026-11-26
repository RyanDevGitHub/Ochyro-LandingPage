/* Ochyro — comportements du site (menu, animations, cookies, Calendly, formulaire). */
(function () {
    'use strict';

    // ── Menu mobile ───────────────────────────────────────────
    var menuBtn = document.getElementById('menuBtn');
    var mobileMenu = document.getElementById('mobileMenu');
    if (menuBtn && mobileMenu) {
        menuBtn.addEventListener('click', function () {
            var open = mobileMenu.hasAttribute('hidden');
            if (open) { mobileMenu.removeAttribute('hidden'); } else { mobileMenu.setAttribute('hidden', ''); }
            menuBtn.setAttribute('aria-expanded', String(open));
        });
        mobileMenu.addEventListener('click', function (e) {
            if (e.target.closest('a')) {
                mobileMenu.setAttribute('hidden', '');
                menuBtn.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // ── Apparition au scroll ──────────────────────────────────
    var reveals = document.querySelectorAll('.reveal');
    if ('IntersectionObserver' in window) {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
        reveals.forEach(function (el) { io.observe(el); });
    } else {
        reveals.forEach(function (el) { el.classList.add('in'); });
    }

    // ── Suivi des clics sur les CTA (PostHog, respecte le consentement) ──
    document.addEventListener('click', function (e) {
        var el = e.target.closest('[data-track]');
        if (el && window.posthog && typeof window.posthog.capture === 'function') {
            window.posthog.capture('cta_click', { location: el.getAttribute('data-track') });
        }
    });

    // ── Calendly : popup (mobile) + redirection après confirmation ──
    document.addEventListener('click', function (e) {
        var btn = e.target.closest('[data-calendly]');
        if (!btn) { return; }
        e.preventDefault();
        var url = btn.getAttribute('data-calendly-url');
        if (window.Calendly && url) {
            window.Calendly.initPopupWidget({ url: url });
        } else if (url) {
            window.location.href = url;
        }
    });

    var calendlyOrigin = /^https:\/\/([a-z0-9-]+\.)?calendly\.com$/i;
    window.addEventListener('message', function (event) {
        if (!calendlyOrigin.test(event.origin || '')) { return; }
        if (event.data && typeof event.data === 'object' && event.data.event === 'calendly.event_scheduled') {
            if (window.posthog && typeof window.posthog.capture === 'function') {
                window.posthog.capture('call_booked');
            }
            window.location.href = '/rendez-vous-confirme';
        }
    });

    // ── Formulaire de contact ─────────────────────────────────
    var form = document.getElementById('contact-form');
    if (form) {
        var submitButton = document.getElementById('contact-submit');
        var okBox = document.getElementById('contact-success');
        var errBox = document.getElementById('contact-error');

        form.addEventListener('submit', async function (event) {
            event.preventDefault();
            okBox.hidden = true;
            errBox.hidden = true;

            var fd = new FormData(form);
            var payload = {
                name: String(fd.get('name') || '').trim(),
                email: String(fd.get('email') || '').trim(),
                phone: String(fd.get('phone') || '').trim(),
                message: String(fd.get('message') || '').trim(),
                website: String(fd.get('website') || '')
            };

            var label = submitButton.textContent;
            submitButton.disabled = true;
            submitButton.textContent = 'Envoi en cours…';

            try {
                var response = await fetch('/contact', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });
                var data = await response.json();
                if (!response.ok || !data.success) {
                    throw new Error(data.error || 'Envoi impossible.');
                }
                form.reset();
                okBox.hidden = false;
                if (window.posthog && typeof window.posthog.capture === 'function') {
                    window.posthog.capture('contact_form_sent');
                }
            } catch (err) {
                errBox.textContent = (err && err.message) || 'Envoi impossible pour le moment. Réessayez dans quelques minutes.';
                errBox.hidden = false;
            } finally {
                submitButton.disabled = false;
                submitButton.textContent = label;
            }
        });
    }

    // ── Consentement cookies ──────────────────────────────────
    window.addEventListener('load', function () {
        if (typeof window.initCookieConsent !== 'function') { return; }
        var cc = window.initCookieConsent();

        function pushConsent(level) {
            if (typeof window.gtag !== 'function') { return; }
            var marketing = level.indexOf('marketing') !== -1 ? 'granted' : 'denied';
            var analytics = level.indexOf('analytics') !== -1 ? 'granted' : 'denied';
            window.gtag('consent', 'update', {
                ad_storage: marketing,
                ad_user_data: marketing,
                ad_personalization: marketing,
                analytics_storage: analytics,
                functionality_storage: analytics,
                personalization_storage: analytics
            });
        }

        window.cc = cc;
        var cookiesBtn = document.getElementById('footer-cookies-btn');
        if (cookiesBtn) { cookiesBtn.addEventListener('click', function () { cc.showSettings(); }); }

        cc.run({
            current_lang: 'fr',
            onAccept: function (cookie) { pushConsent(cookie.level || []); },
            onChange: function (cookie) { pushConsent(cookie.level || []); },
            languages: {
                fr: {
                    consent_modal: {
                        title: 'Nous utilisons des cookies',
                        description: 'Cookies essentiels au fonctionnement du site et, si vous l’acceptez, cookies de mesure d’audience et publicitaires (Google Ads) pour mesurer la performance de nos campagnes. <a href="/politique-de-confidentialite" class="cc-link">En savoir plus</a>.',
                        primary_btn: { text: 'Tout accepter', role: 'accept_all' },
                        secondary_btn: { text: 'Tout refuser', role: 'accept_necessary' }
                    },
                    settings_modal: {
                        title: 'Préférences des cookies',
                        save_settings_btn: 'Enregistrer',
                        accept_all_btn: 'Tout accepter',
                        reject_all_btn: 'Tout refuser',
                        blocks: [
                            { title: 'Cookies nécessaires', description: 'Essentiels au fonctionnement du site (sécurité, prise de rendez-vous Calendly). Toujours actifs.', toggle: { value: 'essential', enabled: true, readonly: true } },
                            { title: 'Mesure d’audience', description: 'Statistiques de visite (PostHog) pour améliorer le site.', toggle: { value: 'analytics', enabled: false, readonly: false } },
                            { title: 'Marketing & publicité', description: 'Google Ads : mesure des conversions issues de nos campagnes.', toggle: { value: 'marketing', enabled: false, readonly: false } }
                        ]
                    }
                }
            }
        });
    });
})();
