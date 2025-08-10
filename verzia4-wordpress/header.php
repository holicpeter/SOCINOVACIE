<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index, follow">
    
    <!-- NASES Required Meta Tags -->
    <meta name="dcterms.title" content="<?php bloginfo('name'); ?>">
    <meta name="dcterms.description" content="<?php bloginfo('description'); ?>">
    <meta name="dcterms.language" content="sk">
    <meta name="dcterms.creator" content="Ministerstvo práce, sociálnych vecí a rodiny SR">
    <meta name="dcterms.publisher" content="Ministerstvo práce, sociálnych vecí a rodiny SR">
    
    <!-- Accessibility Declaration -->
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Skip Links for NASES Compliance -->
<div class="skip-links">
    <a href="#main-content" class="screen-reader-text"><?php esc_html_e('Preskočiť na hlavný obsah', 'socialne-inovacie'); ?></a>
    <a href="#primary-menu" class="screen-reader-text"><?php esc_html_e('Preskočiť na hlavné menu', 'socialne-inovacie'); ?></a>
    <a href="#footer" class="screen-reader-text"><?php esc_html_e('Preskočiť na footer', 'socialne-inovacie'); ?></a>
</div>

<div id="page" class="site">
    <header id="masthead" class="site-header" role="banner">
        <!-- Government Header Bar -->
        <div class="gov-header">
            <div class="container">
                <div class="gov-info">
                    <span><?php esc_html_e('Oficiálna stránka štátnej správy Slovenskej republiky', 'socialne-inovacie'); ?></span>
                </div>
                <div class="language-selector">
                    <a href="#" class="current" lang="sk" hreflang="sk">SK</a>
                    <a href="#" lang="en" hreflang="en">EN</a>
                </div>
            </div>
        </div>

        <!-- Main Header -->
        <div class="container">
            <div class="site-branding">
                <?php if (has_custom_logo()) : ?>
                    <div class="site-logo">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php endif; ?>
                
                <div class="site-identity">
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
                    $subtitle = get_theme_mod('site_subtitle', 'Ministerstvo práce, sociálnych vecí a rodiny Slovenskej republiky');
                    if ($subtitle) : ?>
                        <p class="site-description"><?php echo esc_html($subtitle); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e('Hlavné menu', 'socialne-inovacie'); ?>">
            <div class="container">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 'primary-menu',
                    'container'      => false,
                    'fallback_cb'    => 'socialne_inovacie_fallback_menu',
                ));
                ?>
                
                <!-- Mobile Menu Toggle -->
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="<?php esc_attr_e('Otvoriť hlavné menu', 'socialne-inovacie'); ?>">
                    <span class="menu-toggle-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                    <span class="menu-toggle-text"><?php esc_html_e('Menu', 'socialne-inovacie'); ?></span>
                </button>
            </div>
        </nav>
    </header>

    <!-- Breadcrumbs for navigation (NASES requirement) -->
    <?php if (!is_front_page()) : ?>
        <nav class="breadcrumbs" aria-label="<?php esc_attr_e('Navigácia stránky', 'socialne-inovacie'); ?>">
            <div class="container">
                <ol class="breadcrumb-list">
                    <li class="breadcrumb-item">
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <i class="fas fa-home" aria-hidden="true"></i>
                            <?php esc_html_e('Domov', 'socialne-inovacie'); ?>
                        </a>
                    </li>
                    <?php
                    if (is_category() || is_single()) {
                        echo '<li class="breadcrumb-item">';
                        the_category(' </li><li class="breadcrumb-item"> ');
                        echo '</li>';
                        if (is_single()) {
                            echo '<li class="breadcrumb-item active" aria-current="page">';
                            the_title();
                            echo '</li>';
                        }
                    } elseif (is_page()) {
                        echo '<li class="breadcrumb-item active" aria-current="page">';
                        the_title();
                        echo '</li>';
                    } elseif (is_archive()) {
                        echo '<li class="breadcrumb-item active" aria-current="page">';
                        post_type_archive_title();
                        echo '</li>';
                    }
                    ?>
                </ol>
            </div>
        </nav>
    <?php endif; ?>

<?php
/**
 * Fallback menu function
 */
function socialne_inovacie_fallback_menu() {
    echo '<ul id="primary-menu" class="primary-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Domov', 'socialne-inovacie') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/aktuality')) . '">' . esc_html__('Aktuality', 'socialne-inovacie') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/vyzvy')) . '">' . esc_html__('Výzvy', 'socialne-inovacie') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/podujatia')) . '">' . esc_html__('Podujatia', 'socialne-inovacie') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/o-nas')) . '">' . esc_html__('O nás', 'socialne-inovacie') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/kontakt')) . '">' . esc_html__('Kontakt', 'socialne-inovacie') . '</a></li>';
    echo '</ul>';
}
?>
