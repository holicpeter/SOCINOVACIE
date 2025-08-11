<?php
// Footer content
$footer_options = get_option('socialne_inovacie_footer_options', array());
?>

<footer class="main-footer" id="footer" role="contentinfo">
    <div class="container">
        <div class="row">
            <!-- Footer Logo and Description -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="footer-logo">
                    <div class="d-flex align-items-center mb-3">
                        <?php if (has_custom_logo()) : ?>
                            <?php the_custom_logo(); ?>
                        <?php else : ?>
                            <i class="fas fa-shield-alt text-primary me-2" aria-hidden="true"></i>
                        <?php endif; ?>
                        <div>
                            <h5 class="mb-0"><?php _e('Sociálne inovácie', 'socialne-inovacie-v8'); ?></h5>
                            <small class="text-muted">gov.sk</small>
                        </div>
                    </div>
                    <p class="text-muted">
                        <?php
                        echo isset($footer_options['description']) ? esc_html($footer_options['description']) : 
                             __('Podporujeme inovatívne riešenia sociálnych problémov a zvyšujeme kvalitu života občanov Slovenskej republiky.', 'socialne-inovacie-v8');
                        ?>
                    </p>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="footer-title"><?php _e('Rýchle odkazy', 'socialne-inovacie-v8'); ?></h6>
                <ul class="footer-links">
                    <li><a href="<?php echo get_post_type_archive_link('aktuality'); ?>"><?php _e('Aktuality', 'socialne-inovacie-v8'); ?></a></li>
                    <li><a href="<?php echo get_post_type_archive_link('vyzvy'); ?>"><?php _e('Výzvy', 'socialne-inovacie-v8'); ?></a></li>
                    <li><a href="<?php echo get_post_type_archive_link('podujatia'); ?>"><?php _e('Podujatia', 'socialne-inovacie-v8'); ?></a></li>
                    <li><a href="<?php echo get_post_type_archive_link('inspiracia'); ?>"><?php _e('Inšpirácia', 'socialne-inovacie-v8'); ?></a></li>
                    <li><a href="https://socialneinovacie.gov.sk/" target="_blank" rel="noopener noreferrer"><?php _e('Oficiálna stránka', 'socialne-inovacie-v8'); ?></a></li>
                </ul>
            </div>

            <!-- Government Links -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h6 class="footer-title"><?php _e('Vládne portály', 'socialne-inovacie-v8'); ?></h6>
                <ul class="footer-links">
                    <li><a href="https://www.gov.sk/" target="_blank" rel="noopener noreferrer">gov.sk</a></li>
                    <li><a href="https://www.employment.gov.sk/" target="_blank" rel="noopener noreferrer"><?php _e('Ministerstvo práce', 'socialne-inovacie-v8'); ?></a></li>
                    <li><a href="https://www.slovensko.sk/" target="_blank" rel="noopener noreferrer">slovensko.sk</a></li>
                    <li><a href="https://data.gov.sk/" target="_blank" rel="noopener noreferrer"><?php _e('Otvorené dáta', 'socialne-inovacie-v8'); ?></a></li>
                    <li><a href="https://www.slov-lex.sk/" target="_blank" rel="noopener noreferrer">Slov-Lex</a></li>
                </ul>
            </div>

            <!-- Contact Information -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h6 class="footer-title"><?php _e('Kontakt', 'socialne-inovacie-v8'); ?></h6>
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-building me-2" aria-hidden="true"></i>
                        <span><?php _e('Ministerstvo práce, sociálnych vecí a rodiny SR', 'socialne-inovacie-v8'); ?></span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt me-2" aria-hidden="true"></i>
                        <span>
                            <?php
                            echo isset($footer_options['address']) ? esc_html($footer_options['address']) : 
                                 'Špitálska 4, 6, 8<br>816 43 Bratislava';
                            ?>
                        </span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone me-2" aria-hidden="true"></i>
                        <a href="tel:<?php echo isset($footer_options['phone']) ? esc_attr($footer_options['phone']) : '+421257863111'; ?>">
                            <?php echo isset($footer_options['phone']) ? esc_html($footer_options['phone']) : '+421 2 5786 3111'; ?>
                        </a>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope me-2" aria-hidden="true"></i>
                        <a href="mailto:<?php echo isset($footer_options['email']) ? esc_attr($footer_options['email']) : 'sekretariat@employment.gov.sk'; ?>">
                            <?php echo isset($footer_options['email']) ? esc_html($footer_options['email']) : 'sekretariat@employment.gov.sk'; ?>
                        </a>
                    </div>
                </div>

                <!-- Search Widget Area -->
                <?php if (is_active_sidebar('footer-search')) : ?>
                    <div class="footer-search mt-3">
                        <?php dynamic_sidebar('footer-search'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="footer-links-bottom">
                        <a href="<?php echo get_privacy_policy_url() ? get_privacy_policy_url() : '#'; ?>" class="footer-link">
                            <?php _e('Ochrana osobných údajov', 'socialne-inovacie-v8'); ?>
                        </a>
                        <a href="#" class="footer-link" data-bs-toggle="modal" data-bs-target="#accessibilityModal">
                            <?php _e('Vyhlásenie o dostupnosti', 'socialne-inovacie-v8'); ?>
                        </a>
                        <a href="#" class="footer-link"><?php _e('Podmienky používania', 'socialne-inovacie-v8'); ?></a>
                        <a href="#" class="footer-link"><?php _e('Mapa stránky', 'socialne-inovacie-v8'); ?></a>
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="copyright">
                        <p class="mb-0">
                            &copy; <?php echo date('Y'); ?> 
                            <?php _e('Ministerstvo práce, sociálnych vecí a rodiny SR', 'socialne-inovacie-v8'); ?>
                        </p>
                        <small class="text-muted">
                            <?php _e('Všetky práva vyhradené', 'socialne-inovacie-v8'); ?> | 
                            <?php _e('Vyvinuté v súlade s NASES', 'socialne-inovacie-v8'); ?>
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- EU Funding -->
        <div class="eu-funding text-center mt-4 pt-4">
            <div class="row align-items-center justify-content-center">
                <div class="col-auto">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/eu-flag.webp" 
                         alt="<?php _e('Európska únia', 'socialne-inovacie-v8'); ?>" 
                         class="eu-flag" 
                         width="60" 
                         height="40">
                </div>
                <div class="col-auto">
                    <small class="text-muted">
                        <?php _e('Tento projekt je spolufinancovaný Európskou úniou', 'socialne-inovacie-v8'); ?>
                    </small>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Accessibility Modal -->
<div class="modal fade" id="accessibilityModal" tabindex="-1" aria-labelledby="accessibilityModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="accessibilityModalLabel">
                    <?php _e('Vyhlásenie o dostupnosti', 'socialne-inovacie-v8'); ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php _e('Zavrieť', 'socialne-inovacie-v8'); ?>"></button>
            </div>
            <div class="modal-body">
                <p><?php _e('Tá webová stránka je v súlade s vyhláškou č. 78/2020 Z. z. o štandardoch pre informačné technológie verejnej správy a spĺňa požiadavky WCAG 2.1 úroveň AA.', 'socialne-inovacie-v8'); ?></p>
                
                <h6><?php _e('Funkcie dostupnosti:', 'socialne-inovacie-v8'); ?></h6>
                <ul>
                    <li><?php _e('Navigácia pomocou klávesnice', 'socialne-inovacie-v8'); ?></li>
                    <li><?php _e('Podpora čítačiek obrazovky', 'socialne-inovacie-v8'); ?></li>
                    <li><?php _e('Vysoký kontrast', 'socialne-inovacie-v8'); ?></li>
                    <li><?php _e('Možnosť zmeny veľkosti písma', 'socialne-inovacie-v8'); ?></li>
                    <li><?php _e('Alternatívne texty pre obrázky', 'socialne-inovacie-v8'); ?></li>
                </ul>
                
                <h6><?php _e('Kontakt pre hlásenie problémov s dostupnosťou:', 'socialne-inovacie-v8'); ?></h6>
                <p>
                    <strong><?php _e('Email:', 'socialne-inovacie-v8'); ?></strong> 
                    <a href="mailto:dostupnost@employment.gov.sk">dostupnost@employment.gov.sk</a><br>
                    <strong><?php _e('Telefón:', 'socialne-inovacie-v8'); ?></strong> +421 2 5786 3111
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <?php _e('Zavrieť', 'socialne-inovacie-v8'); ?>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Back to Top Button -->
<button id="backToTop" class="btn btn-primary back-to-top" aria-label="<?php _e('Späť na vrch', 'socialne-inovacie-v8'); ?>">
    <i class="fas fa-chevron-up" aria-hidden="true"></i>
</button>

<?php wp_footer(); ?>

<!-- Accessibility and Interaction Scripts -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Back to top functionality
    const backToTopButton = document.getElementById('backToTop');
    
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTopButton.style.display = 'block';
        } else {
            backToTopButton.style.display = 'none';
        }
    });
    
    backToTopButton.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // Skip links focus management
    document.querySelectorAll('.skip-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.focus();
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
    
    // High contrast mode
    if (localStorage.getItem('high-contrast') === 'true') {
        document.body.classList.add('high-contrast');
    }
    
    // Font size adjustment
    const savedFontSize = localStorage.getItem('font-size');
    if (savedFontSize) {
        document.documentElement.style.fontSize = savedFontSize;
    }
    
    // Keyboard navigation enhancement
    document.addEventListener('keydown', function(e) {
        // Tab navigation enhancement
        if (e.key === 'Tab') {
            document.body.classList.add('keyboard-navigation');
        }
        
        // Escape key to close modals
        if (e.key === 'Escape') {
            const openModal = document.querySelector('.modal.show');
            if (openModal) {
                const closeButton = openModal.querySelector('.btn-close');
                if (closeButton) closeButton.click();
            }
        }
    });
    
    // Mouse interaction removes keyboard navigation class
    document.addEventListener('mousedown', function() {
        document.body.classList.remove('keyboard-navigation');
    });
    
    // Form validation enhancement
    const forms = document.querySelectorAll('form');
    forms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(function(field) {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('is-invalid');
                    field.setAttribute('aria-invalid', 'true');
                } else {
                    field.classList.remove('is-invalid');
                    field.removeAttribute('aria-invalid');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                const firstInvalid = form.querySelector('.is-invalid');
                if (firstInvalid) {
                    firstInvalid.focus();
                }
            }
        });
    });
});
</script>

</body>
</html>
