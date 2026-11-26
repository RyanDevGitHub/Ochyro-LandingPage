</main>

<footer class="site-footer">
    <div class="container footer-grid">
        <div>
            <a href="/" class="brand brand-light" aria-label="Ochyro — accueil">
                <span class="brand-mark"><img src="/assets/imgs/ochyro_logo_bf_no_background.svg" alt="" width="40" height="40"></span>
                <span class="brand-text"><strong>Ochyro</strong><small>Automatisation IA</small></span>
            </a>
            <p class="footer-about">
                Nous identifions les tâches de votre entreprise qui peuvent être automatisées avec l’IA, puis nous les mettons en place. Audit et devis gratuits.
            </p>
        </div>

        <div>
            <h2 class="footer-title">Explorer</h2>
            <ul class="footer-links">
                <li><a href="/services">Ce qu’on automatise</a></li>
                <li><a href="/cas-usage">Cas d’usage</a></li>
                <li><a href="/#methode">Notre méthode</a></li>
                <li><a href="/#faq">Questions fréquentes</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
        </div>

        <div>
            <h2 class="footer-title">Parlons-en</h2>
            <ul class="footer-links">
                <li><a href="tel:<?= e(site('phone_href')) ?>"><?= icon('phone-linear', 18, 'accent') ?><?= e(site('phone_label')) ?></a></li>
                <li><a href="mailto:<?= e(site('email')) ?>"><?= icon('letter-linear', 18, 'accent') ?><?= e(site('email')) ?></a></li>
                <li><a href="<?= e(site('linkedin_url')) ?>" target="_blank" rel="noopener noreferrer"><?= icon('link-round-linear', 18, 'accent') ?>LinkedIn</a></li>
            </ul>
            <a class="btn btn-light" href="/contact#rdv" data-track="cta_footer">Réserver mon appel gratuit</a>
        </div>
    </div>

    <div class="container footer-bottom">
        <span>© <span id="year"><?= date('Y') ?></span> Ochyro — Tous droits réservés.</span>
        <span class="footer-legal">
            <a href="/mentions-legales">Mentions légales</a>
            <a href="/politique-de-confidentialite">Confidentialité</a>
            <button type="button" id="footer-cookies-btn">Gérer les cookies</button>
        </span>
    </div>
</footer>

<a class="call-fab" href="tel:<?= e(site('phone_href')) ?>" aria-label="Appeler Ochyro au <?= e(site('phone_label')) ?>">
    <?= icon('phone-linear', 20) ?> Appeler
</a>

<script defer src="https://cdn.jsdelivr.net/gh/orestbida/cookieconsent@v2.9.1/dist/cookieconsent.js"></script>
<script defer src="/assets/js/site.js?v=<?= (string) @filemtime(__DIR__ . '/../../../public/assets/js/site.js') ?>"></script>
</body>
</html>
