    <footer id="colophon" class="site-footer" role="contentinfo">
        <div class="container">
            <div class="footer-content">
                <!-- Footer Widget Area 1 -->
                <div class="footer-section">
                    <?php if (is_active_sidebar('footer-1')) : ?>
                        <?php dynamic_sidebar('footer-1'); ?>
                    <?php else : ?>
                        <h3><?php esc_html_e('Kontakt', 'socialne-inovacie'); ?></h3>
                        <p>
                            <strong>Ministerstvo práce, sociálnych vecí a rodiny SR</strong><br>
                            Špitálska 4-6<br>
                            816 43 Bratislava<br>
                            <i class="fas fa-phone" aria-hidden="true"></i> <a href="tel:+421259742042">+421 2 5974 2042</a><br>
                            <i class="fas fa-envelope" aria-hidden="true"></i> <a href="mailto:info@employment.gov.sk">info@employment.gov.sk</a>
                        </p>
                    <?php endif; ?>
                </div>

                <!-- Footer Widget Area 2 -->
                <div class="footer-section">
                    <?php if (is_active_sidebar('footer-2')) : ?>
                        <?php dynamic_sidebar('footer-2'); ?>
                    <?php else : ?>
                        <h3><?php esc_html_e('Užitočné odkazy', 'socialne-inovacie'); ?></h3>
                        <ul style="list-style: none; padding: 0;">
                            <li><a href="https://www.gov.sk">gov.sk</a></li>
                            <li><a href="https://www.employment.gov.sk">Ministerstvo práce, SV a rodiny</a></li>
                            <li><a href="https://www.upsvr.gov.sk">ÚPSVaR</a></li>
                            <li><a href="https://www.socpoist.sk">Sociálna poisťovňa</a></li>
                            <li><a href="https://www.health.gov.sk">Ministerstvo zdravotníctva</a></li>
                        </ul>
                    <?php endif; ?>
                </div>

                <!-- Footer Widget Area 3 -->
                <div class="footer-section">
                    <?php if (is_active_sidebar('footer-3')) : ?>
                        <?php dynamic_sidebar('footer-3'); ?>
                    <?php else : ?>
                        <h3><?php esc_html_e('Informácie', 'socialne-inovacie'); ?></h3>
                        <ul style="list-style: none; padding: 0;">
                            <li><a href="<?php echo esc_url(home_url('/ochrana-osobnych-udajov')); ?>"><?php esc_html_e('Ochrana osobných údajov', 'socialne-inovacie'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/podmienky-pouzitia')); ?>"><?php esc_html_e('Podmienky použitia', 'socialne-inovacie'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/pristupnost')); ?>"><?php esc_html_e('Vyhlásenie o prístupnosti', 'socialne-inovacie'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/mapa-stranky')); ?>"><?php esc_html_e('Mapa stránky', 'socialne-inovacie'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/rss')); ?>"><?php esc_html_e('RSS', 'socialne-inovacie'); ?></a></li>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <!-- NASES Compliance Section -->
            <div class="nases-compliance">
                <h3><?php esc_html_e('Vyhlásenie o prístupnosti', 'socialne-inovacie'); ?></h3>
                <p>
                    <?php esc_html_e('Táto webová stránka spĺňa požiadavky', 'socialne-inovacie'); ?>
                    <strong><?php esc_html_e('Vyhlášky č. 78/2020 Z. z.', 'socialne-inovacie'); ?></strong>
                    <?php esc_html_e('o štandardoch pre informačné systémy verejnej správy v oblasti prístupnosti.', 'socialne-inovacie'); ?>
                </p>
                <p>
                    <?php esc_html_e('Stránka je v súlade s', 'socialne-inovacie'); ?>
                    <strong><?php esc_html_e('WCAG 2.1 úroveň AA', 'socialne-inovacie'); ?></strong>
                    <?php esc_html_e('a európskou normou EN 301 549.', 'socialne-inovacie'); ?>
                </p>
                <p>
                    <?php esc_html_e('Pre nahláenie problémov s prístupnosťou kontaktujte:', 'socialne-inovacie'); ?>
                    <a href="mailto:info@employment.gov.sk">info@employment.gov.sk</a>
                </p>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <?php
                $footer_text = get_theme_mod('footer_text', '© 2024 Ministerstvo práce, sociálnych vecí a rodiny Slovenskej republiky');
                if ($footer_text) : ?>
                    <p><?php echo esc_html($footer_text); ?></p>
                <?php endif; ?>
                
                <p>
                    <?php esc_html_e('Posledná aktualizácia:', 'socialne-inovacie'); ?>
                    <time datetime="<?php echo esc_attr(date('c')); ?>">
                        <?php echo esc_html(date_i18n(get_option('date_format'))); ?>
                    </time>
                </p>

                <!-- Social Media Links -->
                <div class="social-links">
                    <a href="https://www.facebook.com/ministerstvoprace" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('Facebook', 'socialne-inovacie'); ?>">
                        <i class="fab fa-facebook-f" aria-hidden="true"></i>
                    </a>
                    <a href="https://twitter.com/MPSVaR_SK" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('Twitter', 'socialne-inovacie'); ?>">
                        <i class="fab fa-twitter" aria-hidden="true"></i>
                    </a>
                    <a href="https://www.linkedin.com/company/ministerstvo-prace-socialnych-veci-a-rodiny-sr" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('LinkedIn', 'socialne-inovacie'); ?>">
                        <i class="fab fa-linkedin-in" aria-hidden="true"></i>
                    </a>
                    <a href="https://www.youtube.com/channel/UC9QjQz8QQz8QQz8QQz8QQz8" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('YouTube', 'socialne-inovacie'); ?>">
                        <i class="fab fa-youtube" aria-hidden="true"></i>
                    </a>
                </div>

                <!-- Government Logos -->
                <div class="gov-logos">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo-gov-sk.png'); ?>" alt="<?php esc_attr_e('Logo gov.sk', 'socialne-inovacie'); ?>" width="120" height="40">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo-eu.png'); ?>" alt="<?php esc_attr_e('Logo Európskej únie', 'socialne-inovacie'); ?>" width="80" height="40">
                </div>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<!-- Back to Top Button -->
<button id="back-to-top" class="back-to-top" aria-label="<?php esc_attr_e('Návrat na začiatok stránky', 'socialne-inovacie'); ?>">
    <i class="fas fa-chevron-up" aria-hidden="true"></i>
    <span class="screen-reader-text"><?php esc_html_e('Návrat na začiatok', 'socialne-inovacie'); ?></span>
</button>

<?php wp_footer(); ?>
</body>
</html>
