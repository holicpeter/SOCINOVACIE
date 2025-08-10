<?php
/**
 * Theme functions and definitions
 * 
 * Sociálne inovácie WordPress Theme
 * NASES compliant theme for socialneinovacie.gov.sk
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Theme setup
 */
function socialne_inovacie_setup() {
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    add_theme_support('custom-logo');
    add_theme_support('customize-selective-refresh-widgets');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'socialne-inovacie'),
        'footer' => esc_html__('Footer Menu', 'socialne-inovacie'),
    ));
    
    // Add image sizes
    add_image_size('card-thumbnail', 120, 80, true);
    add_image_size('hero-image', 1200, 600, true);
}
add_action('after_setup_theme', 'socialne_inovacie_setup');

/**
 * Enqueue scripts and styles
 */
function socialne_inovacie_scripts() {
    // Main stylesheet
    wp_enqueue_style('socialne-inovacie-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap', array(), null);
    
    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
    
    // Main JavaScript
    wp_enqueue_script('socialne-inovacie-script', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true);
    
    // Accessibility script
    wp_enqueue_script('socialne-inovacie-accessibility', get_template_directory_uri() . '/js/accessibility.js', array('jquery'), '1.0.0', true);
    
    // Localize script for AJAX
    wp_localize_script('socialne-inovacie-script', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('socialne_inovacie_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'socialne_inovacie_scripts');

/**
 * Register widget areas
 */
function socialne_inovacie_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'socialne-inovacie'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'socialne-inovacie'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('Footer 1', 'socialne-inovacie'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Footer widget area 1.', 'socialne-inovacie'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('Footer 2', 'socialne-inovacie'),
        'id'            => 'footer-2',
        'description'   => esc_html__('Footer widget area 2.', 'socialne-inovacie'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('Footer 3', 'socialne-inovacie'),
        'id'            => 'footer-3',
        'description'   => esc_html__('Footer widget area 3.', 'socialne-inovacie'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'socialne_inovacie_widgets_init');

/**
 * Custom post types for content management
 */
function socialne_inovacie_custom_post_types() {
    // Aktuality (News)
    register_post_type('aktuality', array(
        'labels' => array(
            'name' => 'Aktuality',
            'singular_name' => 'Aktualita',
            'add_new' => 'Pridať aktualitu',
            'add_new_item' => 'Pridať novú aktualitu',
            'edit_item' => 'Upraviť aktualitu',
            'new_item' => 'Nová aktualita',
            'view_item' => 'Zobraziť aktualitu',
            'search_items' => 'Hľadať aktuality',
            'not_found' => 'Žiadne aktuality nenájdené',
            'not_found_in_trash' => 'Žiadne aktuality v koši'
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-megaphone',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest' => true,
    ));
    
    // Výzvy (Calls)
    register_post_type('vyzvy', array(
        'labels' => array(
            'name' => 'Výzvy',
            'singular_name' => 'Výzva',
            'add_new' => 'Pridať výzvu',
            'add_new_item' => 'Pridať novú výzvu',
            'edit_item' => 'Upraviť výzvu',
            'new_item' => 'Nová výzva',
            'view_item' => 'Zobraziť výzvu',
            'search_items' => 'Hľadať výzvy',
            'not_found' => 'Žiadne výzvy nenájdené',
            'not_found_in_trash' => 'Žiadne výzvy v koši'
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-bullhorn',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest' => true,
    ));
    
    // Podujatia (Events)
    register_post_type('podujatia', array(
        'labels' => array(
            'name' => 'Podujatia',
            'singular_name' => 'Podujatie',
            'add_new' => 'Pridať podujatie',
            'add_new_item' => 'Pridať nové podujatie',
            'edit_item' => 'Upraviť podujatie',
            'new_item' => 'Nové podujatie',
            'view_item' => 'Zobraziť podujatie',
            'search_items' => 'Hľadať podujatia',
            'not_found' => 'Žiadne podujatia nenájdené',
            'not_found_in_trash' => 'Žiadne podujatia v koši'
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-calendar-alt',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'socialne_inovacie_custom_post_types');

/**
 * Custom taxonomies
 */
function socialne_inovacie_custom_taxonomies() {
    // Kategórie pre všetky post types
    register_taxonomy('kategoria', array('aktuality', 'vyzvy', 'podujatia'), array(
        'labels' => array(
            'name' => 'Kategórie',
            'singular_name' => 'Kategória',
            'add_new_item' => 'Pridať novú kategóriu',
            'edit_item' => 'Upraviť kategóriu',
            'update_item' => 'Aktualizovať kategóriu',
            'view_item' => 'Zobraziť kategóriu',
            'separate_items_with_commas' => 'Oddeľte kategórie čiarkami',
            'add_or_remove_items' => 'Pridať alebo odstrániť kategórie',
            'choose_from_most_used' => 'Vybrať z najpoužívanejších',
            'popular_items' => 'Populárne kategórie',
            'search_items' => 'Hľadať kategórie',
            'not_found' => 'Žiadne kategórie nenájdené',
        ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'show_in_rest' => true,
    ));
}
add_action('init', 'socialne_inovacie_custom_taxonomies');

/**
 * Add custom meta fields
 */
function socialne_inovacie_add_meta_boxes() {
    add_meta_box(
        'vyzvy_details',
        'Detaily výzvy',
        'socialne_inovacie_vyzvy_meta_box',
        'vyzvy',
        'normal',
        'high'
    );
    
    add_meta_box(
        'podujatia_details',
        'Detaily podujatia',
        'socialne_inovacie_podujatia_meta_box',
        'podujatia',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'socialne_inovacie_add_meta_boxes');

/**
 * Meta box for Výzvy
 */
function socialne_inovacie_vyzvy_meta_box($post) {
    wp_nonce_field('socialne_inovacie_vyzvy_meta', 'socialne_inovacie_vyzvy_nonce');
    
    $amount = get_post_meta($post->ID, '_vyzva_amount', true);
    $status = get_post_meta($post->ID, '_vyzva_status', true);
    $deadline = get_post_meta($post->ID, '_vyzva_deadline', true);
    
    echo '<table class="form-table">';
    echo '<tr>';
    echo '<th><label for="vyzva_amount">Výška podpory:</label></th>';
    echo '<td><input type="text" id="vyzva_amount" name="vyzva_amount" value="' . esc_attr($amount) . '" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="vyzva_status">Status:</label></th>';
    echo '<td>';
    echo '<select id="vyzva_status" name="vyzva_status">';
    echo '<option value="Aktívna"' . selected($status, 'Aktívna', false) . '>Aktívna</option>';
    echo '<option value="Neaktívna"' . selected($status, 'Neaktívna', false) . '>Neaktívna</option>';
    echo '<option value="Ukončená"' . selected($status, 'Ukončená', false) . '>Ukončená</option>';
    echo '</select>';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="vyzva_deadline">Termín podania:</label></th>';
    echo '<td><input type="date" id="vyzva_deadline" name="vyzva_deadline" value="' . esc_attr($deadline) . '" /></td>';
    echo '</tr>';
    echo '</table>';
}

/**
 * Meta box for Podujatia
 */
function socialne_inovacie_podujatia_meta_box($post) {
    wp_nonce_field('socialne_inovacie_podujatia_meta', 'socialne_inovacie_podujatia_nonce');
    
    $location = get_post_meta($post->ID, '_podujatie_location', true);
    $date = get_post_meta($post->ID, '_podujatie_date', true);
    $time = get_post_meta($post->ID, '_podujatie_time', true);
    $capacity = get_post_meta($post->ID, '_podujatie_capacity', true);
    
    echo '<table class="form-table">';
    echo '<tr>';
    echo '<th><label for="podujatie_location">Miesto konania:</label></th>';
    echo '<td><input type="text" id="podujatie_location" name="podujatie_location" value="' . esc_attr($location) . '" class="regular-text" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="podujatie_date">Dátum:</label></th>';
    echo '<td><input type="date" id="podujatie_date" name="podujatie_date" value="' . esc_attr($date) . '" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="podujatie_time">Čas:</label></th>';
    echo '<td><input type="time" id="podujatie_time" name="podujatie_time" value="' . esc_attr($time) . '" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="podujatie_capacity">Kapacita:</label></th>';
    echo '<td><input type="number" id="podujatie_capacity" name="podujatie_capacity" value="' . esc_attr($capacity) . '" min="1" /></td>';
    echo '</tr>';
    echo '</table>';
}

/**
 * Save meta box data
 */
function socialne_inovacie_save_meta($post_id) {
    // Výzvy meta
    if (isset($_POST['socialne_inovacie_vyzvy_nonce']) && wp_verify_nonce($_POST['socialne_inovacie_vyzvy_nonce'], 'socialne_inovacie_vyzvy_meta')) {
        if (isset($_POST['vyzva_amount'])) {
            update_post_meta($post_id, '_vyzva_amount', sanitize_text_field($_POST['vyzva_amount']));
        }
        if (isset($_POST['vyzva_status'])) {
            update_post_meta($post_id, '_vyzva_status', sanitize_text_field($_POST['vyzva_status']));
        }
        if (isset($_POST['vyzva_deadline'])) {
            update_post_meta($post_id, '_vyzva_deadline', sanitize_text_field($_POST['vyzva_deadline']));
        }
    }
    
    // Podujatia meta
    if (isset($_POST['socialne_inovacie_podujatia_nonce']) && wp_verify_nonce($_POST['socialne_inovacie_podujatia_nonce'], 'socialne_inovacie_podujatia_meta')) {
        if (isset($_POST['podujatie_location'])) {
            update_post_meta($post_id, '_podujatie_location', sanitize_text_field($_POST['podujatie_location']));
        }
        if (isset($_POST['podujatie_date'])) {
            update_post_meta($post_id, '_podujatie_date', sanitize_text_field($_POST['podujatie_date']));
        }
        if (isset($_POST['podujatie_time'])) {
            update_post_meta($post_id, '_podujatie_time', sanitize_text_field($_POST['podujatie_time']));
        }
        if (isset($_POST['podujatie_capacity'])) {
            update_post_meta($post_id, '_podujatie_capacity', sanitize_text_field($_POST['podujatie_capacity']));
        }
    }
}
add_action('save_post', 'socialne_inovacie_save_meta');

/**
 * Customizer settings
 */
function socialne_inovacie_customize_register($wp_customize) {
    // Site Identity Section
    $wp_customize->add_setting('site_subtitle', array(
        'default' => 'Ministerstvo práce, sociálnych vecí a rodiny Slovenskej republiky',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('site_subtitle', array(
        'label' => 'Podtitul stránky',
        'section' => 'title_tagline',
        'type' => 'text',
    ));
    
    // Colors Section
    $wp_customize->add_section('socialne_inovacie_colors', array(
        'title' => 'Farby témy',
        'priority' => 30,
    ));
    
    $wp_customize->add_setting('primary_color', array(
        'default' => '#003d82',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label' => 'Primárna farba',
        'section' => 'socialne_inovacie_colors',
    )));
    
    // Footer Section
    $wp_customize->add_section('socialne_inovacie_footer', array(
        'title' => 'Footer nastavenia',
        'priority' => 120,
    ));
    
    $wp_customize->add_setting('footer_text', array(
        'default' => '© 2024 Ministerstvo práce, sociálnych vecí a rodiny Slovenskej republiky',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('footer_text', array(
        'label' => 'Footer text',
        'section' => 'socialne_inovacie_footer',
        'type' => 'textarea',
    ));
}
add_action('customize_register', 'socialne_inovacie_customize_register');

/**
 * NASES Compliance Features
 */

// Add accessibility declaration
function socialne_inovacie_accessibility_declaration() {
    return '<div class="accessibility-declaration">
        <h3>Vyhlásenie o prístupnosti</h3>
        <p>Táto webová stránka spĺňa požiadavky <strong>Vyhlášky č. 78/2020 Z. z.</strong> o štandardoch pre informačné systémy verejnej správy v oblasti prístupnosti.</p>
        <p>Stránka je v súlade s <strong>WCAG 2.1 úroveň AA</strong> a <strong>európskou normou EN 301 549</strong>.</p>
        <p>Pre nahláenie problémov s prístupnosťou kontaktujte: <a href="mailto:info@employment.gov.sk">info@employment.gov.sk</a></p>
    </div>';
}

// Add NASES required meta tags
function socialne_inovacie_meta_tags() {
    echo '<meta name="dcterms.title" content="' . esc_attr(get_bloginfo('name')) . '">' . "\n";
    echo '<meta name="dcterms.description" content="' . esc_attr(get_bloginfo('description')) . '">' . "\n";
    echo '<meta name="dcterms.language" content="sk">' . "\n";
    echo '<meta name="dcterms.creator" content="Ministerstvo práce, sociálnych vecí a rodiny SR">' . "\n";
    echo '<meta name="dcterms.publisher" content="Ministerstvo práce, sociálnych vecí a rodiny SR">' . "\n";
    echo '<meta name="dcterms.rights" content="© Ministerstvo práce, sociálnych vecí a rodiny SR">' . "\n";
    echo '<meta name="dcterms.type" content="Text">' . "\n";
    echo '<meta name="dcterms.format" content="text/html">' . "\n";
    echo '<meta name="dcterms.identifier" content="' . esc_url(home_url()) . '">' . "\n";
}
add_action('wp_head', 'socialne_inovacie_meta_tags');

/**
 * Security headers
 */
function socialne_inovacie_security_headers() {
    if (!is_admin()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
        header('Referrer-Policy: strict-origin-when-cross-origin');
    }
}
add_action('send_headers', 'socialne_inovacie_security_headers');

/**
 * Template hierarchy customization
 */
function socialne_inovacie_template_hierarchy($template) {
    if (is_home() || is_front_page()) {
        $custom_template = locate_template('front-page.php');
        if ($custom_template) {
            return $custom_template;
        }
    }
    return $template;
}
add_filter('template_include', 'socialne_inovacie_template_hierarchy');

/**
 * Excerpt length
 */
function socialne_inovacie_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'socialne_inovacie_excerpt_length');

/**
 * Excerpt more text
 */
function socialne_inovacie_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'socialne_inovacie_excerpt_more');

/**
 * Body classes
 */
function socialne_inovacie_body_classes($classes) {
    if (!is_admin()) {
        $classes[] = 'nases-compliant';
        $classes[] = 'gov-sk-theme';
    }
    return $classes;
}
add_filter('body_class', 'socialne_inovacie_body_classes');

/**
 * Load text domain
 */
function socialne_inovacie_load_textdomain() {
    load_theme_textdomain('socialne-inovacie', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'socialne_inovacie_load_textdomain');
?>
