<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index, follow">
    <meta name="description" content="Oficiálna stránka Ministerstva práce, sociálnych vecí a rodiny SR pre sociálne inovácie">
    <meta name="keywords" content="sociálne inovácie, digitalizácia, NASES, vláda, Slovensko">
    
    <!-- NASES Compliance Meta Tags -->
    <meta name="dcterms.title" content="<?php bloginfo('name'); ?>">
    <meta name="dcterms.creator" content="Ministerstvo práce, sociálnych vecí a rodiny SR">
    <meta name="dcterms.subject" content="Sociálne inovácie, digitalizácia">
    <meta name="dcterms.description" content="Oficiálna stránka pre sociálne inovácie">
    <meta name="dcterms.publisher" content="Gov.sk">
    <meta name="dcterms.language" content="sk">
    <meta name="dcterms.format" content="text/html">
    <meta name="dcterms.type" content="Text">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?php bloginfo('name'); ?>">
    <meta property="og:description" content="Sociálne inovácie - Ministerstvo práce, sociálnych vecí a rodiny SR">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo home_url(); ?>">
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
    
    <!-- Security Headers -->
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-Frame-Options" content="SAMEORIGIN">
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">
    
    <!-- Preload critical resources -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" as="style">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/assets/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/apple-touch-icon.png">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class('dark-mode'); ?>>
<?php wp_body_open(); ?>

<!-- Skip to content link for accessibility -->
<a class="screen-reader-text" href="#main"><?php esc_html_e('Preskočiť na hlavný obsah', 'socialneinovacie-dark'); ?></a>

<!-- Government Bar -->
<div class="gov-bar" role="banner">
    <div class="container">
        <?php esc_html_e('Oficiálna stránka štátnej správy Slovenskej republiky', 'socialneinovacie-dark'); ?>
    </div>
</div>

<!-- Site Header -->
<header class="site-header" role="banner">
    <div class="container">
        <!-- Site Branding -->
        <div class="site-branding">
            <?php if (has_custom_logo()) : ?>
                <div class="site-logo">
                    <?php the_custom_logo(); ?>
                </div>
            <?php endif; ?>
            
            <?php if (is_front_page() && is_home()) : ?>
                <h1 class="site-title">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <?php bloginfo('name'); ?>
                    </a>
                </h1>
            <?php else : ?>
                <p class="site-title">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <?php bloginfo('name'); ?>
                    </a>
                </p>
            <?php endif; ?>
            
            <?php
            $description = get_bloginfo('description', 'display');
            if ($description || is_customize_preview()) :
            ?>
                <p class="site-description"><?php echo $description; ?></p>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Main Navigation -->
    <nav class="main-nav" role="navigation" aria-label="<?php esc_attr_e('Hlavné menu', 'socialneinovacie-dark'); ?>">
        <div class="container">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'main',
                'menu_class'     => 'nav-menu',
                'container'      => false,
                'fallback_cb'    => 'socialneinovacie_dark_fallback_menu',
            ));
            ?>
        </div>
    </nav>
</header>

<?php
// Fallback menu function
function socialneinovacie_dark_fallback_menu() {
    echo '<ul class="nav-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Domov', 'socialneinovacie-dark') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/aktuality/')) . '">' . esc_html__('Aktuality', 'socialneinovacie-dark') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/vyzvy/')) . '">' . esc_html__('Výzvy', 'socialneinovacie-dark') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/podujatia/')) . '">' . esc_html__('Podujatia', 'socialneinovacie-dark') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/o-nas/')) . '">' . esc_html__('O nás', 'socialneinovacie-dark') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/kontakt/')) . '">' . esc_html__('Kontakt', 'socialneinovacie-dark') . '</a></li>';
    echo '</ul>';
}
?>
