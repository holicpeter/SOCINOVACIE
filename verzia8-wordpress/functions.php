<?php
/**
 * Sociálne Inovácie v8 WordPress Theme Functions
 * Based on version 1 with full CMS functionality
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Theme setup
function socialne_inovacie_v8_setup() {
    // Add theme support for various features
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('responsive-embeds');
    
    // Add support for wide and full alignment
    add_theme_support('align-wide');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'socialne-inovacie-v8'),
        'footer' => __('Footer Menu', 'socialne-inovacie-v8'),
    ));
    
    // Add image sizes
    add_image_size('news-thumbnail', 80, 60, true);
    add_image_size('inspiration-thumbnail', 400, 180, true);
    add_image_size('hero-image', 1920, 1080, true);
}
add_action('after_setup_theme', 'socialne_inovacie_v8_setup');

// Enqueue scripts and styles
function socialne_inovacie_v8_scripts() {
    // Bootstrap CSS
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
    
    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
    
    // Theme stylesheet
    wp_enqueue_style('socialne-inovacie-v8-style', get_stylesheet_uri(), array(), '8.0');
    
    // Bootstrap JS
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array(), '5.3.0', true);
    
    // Theme JavaScript
    wp_enqueue_script('socialne-inovacie-v8-script', get_template_directory_uri() . '/js/theme.js', array('jquery'), '8.0', true);
    
    // Accessibility script
    wp_enqueue_script('accessibility-script', get_template_directory_uri() . '/js/accessibility.js', array(), '8.0', true);
}
add_action('wp_enqueue_scripts', 'socialne_inovacie_v8_scripts');

// Register custom post types
function socialne_inovacie_v8_custom_post_types() {
    // Aktuality (News)
    register_post_type('aktuality', array(
        'labels' => array(
            'name' => __('Aktuality', 'socialne-inovacie-v8'),
            'singular_name' => __('Aktualita', 'socialne-inovacie-v8'),
            'add_new' => __('Pridať aktualitu', 'socialne-inovacie-v8'),
            'add_new_item' => __('Pridať novú aktualitu', 'socialne-inovacie-v8'),
            'edit_item' => __('Upraviť aktualitu', 'socialne-inovacie-v8'),
            'new_item' => __('Nová aktualita', 'socialne-inovacie-v8'),
            'view_item' => __('Zobraziť aktualitu', 'socialne-inovacie-v8'),
            'search_items' => __('Hľadať aktuality', 'socialne-inovacie-v8'),
            'not_found' => __('Žiadne aktuality nenájdené', 'socialne-inovacie-v8'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon' => 'dashicons-megaphone',
        'rewrite' => array('slug' => 'aktuality'),
        'show_in_rest' => true,
    ));
    
    // Výzvy (Challenges)
    register_post_type('vyzvy', array(
        'labels' => array(
            'name' => __('Výzvy', 'socialne-inovacie-v8'),
            'singular_name' => __('Výzva', 'socialne-inovacie-v8'),
            'add_new' => __('Pridať výzvu', 'socialne-inovacie-v8'),
            'add_new_item' => __('Pridať novú výzvu', 'socialne-inovacie-v8'),
            'edit_item' => __('Upraviť výzvu', 'socialne-inovacie-v8'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon' => 'dashicons-flag',
        'rewrite' => array('slug' => 'vyzvy'),
        'show_in_rest' => true,
    ));
    
    // Podujatia (Events)
    register_post_type('podujatia', array(
        'labels' => array(
            'name' => __('Podujatia', 'socialne-inovacie-v8'),
            'singular_name' => __('Podujatie', 'socialne-inovacie-v8'),
            'add_new' => __('Pridať podujatie', 'socialne-inovacie-v8'),
            'add_new_item' => __('Pridať nové podujatie', 'socialne-inovacie-v8'),
            'edit_item' => __('Upraviť podujatie', 'socialne-inovacie-v8'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon' => 'dashicons-calendar-alt',
        'rewrite' => array('slug' => 'podujatia'),
        'show_in_rest' => true,
    ));
    
    // Inšpirácia (Inspiration)
    register_post_type('inspiracia', array(
        'labels' => array(
            'name' => __('Inšpirácia', 'socialne-inovacie-v8'),
            'singular_name' => __('Inšpirácia', 'socialne-inovacie-v8'),
            'add_new' => __('Pridať inšpiráciu', 'socialne-inovacie-v8'),
            'add_new_item' => __('Pridať novú inšpiráciu', 'socialne-inovacie-v8'),
            'edit_item' => __('Upraviť inšpiráciu', 'socialne-inovacie-v8'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon' => 'dashicons-lightbulb',
        'rewrite' => array('slug' => 'inspiracia'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'socialne_inovacie_v8_custom_post_types');

// Register widget areas
function socialne_inovacie_v8_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar - Výzvy', 'socialne-inovacie-v8'),
        'id' => 'sidebar-vyzvy',
        'description' => __('Sidebar pre zobrazenie aktívnych výziev', 'socialne-inovacie-v8'),
        'before_widget' => '<div class="widget card mb-3">',
        'after_widget' => '</div>',
        'before_title' => '<div class="card-header"><h5 class="card-title mb-0">',
        'after_title' => '</h5></div>',
    ));
    
    register_sidebar(array(
        'name' => __('Footer Widget Area', 'socialne-inovacie-v8'),
        'id' => 'footer-widgets',
        'description' => __('Widget oblasť pre footer', 'socialne-inovacie-v8'),
        'before_widget' => '<div class="col-md-3 widget">',
        'after_widget' => '</div>',
        'before_title' => '<h5>',
        'after_title' => '</h5>',
    ));
}
add_action('widgets_init', 'socialne_inovacie_v8_widgets_init');

// Custom meta boxes for additional fields
function socialne_inovacie_v8_add_meta_boxes() {
    // For Aktuality
    add_meta_box(
        'aktuality_meta',
        __('Dodatočné informácie', 'socialne-inovacie-v8'),
        'aktuality_meta_callback',
        'aktuality',
        'normal',
        'high'
    );
    
    // For Výzvy
    add_meta_box(
        'vyzvy_meta',
        __('Informácie o výzve', 'socialne-inovacie-v8'),
        'vyzvy_meta_callback',
        'vyzvy',
        'normal',
        'high'
    );
    
    // For Podujatia
    add_meta_box(
        'podujatia_meta',
        __('Informácie o podujatí', 'socialne-inovacie-v8'),
        'podujatia_meta_callback',
        'podujatia',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'socialne_inovacie_v8_add_meta_boxes');

// Meta box callbacks
function aktuality_meta_callback($post) {
    wp_nonce_field('aktuality_meta_nonce', 'aktuality_meta_nonce');
    $external_link = get_post_meta($post->ID, '_external_link', true);
    $source = get_post_meta($post->ID, '_source', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="external_link"><?php _e('Externý odkaz', 'socialne-inovacie-v8'); ?></label></th>
            <td><input type="url" id="external_link" name="external_link" value="<?php echo esc_attr($external_link); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="source"><?php _e('Zdroj', 'socialne-inovacie-v8'); ?></label></th>
            <td><input type="text" id="source" name="source" value="<?php echo esc_attr($source); ?>" class="regular-text" /></td>
        </tr>
    </table>
    <?php
}

function vyzvy_meta_callback($post) {
    wp_nonce_field('vyzvy_meta_nonce', 'vyzvy_meta_nonce');
    $deadline = get_post_meta($post->ID, '_deadline', true);
    $budget = get_post_meta($post->ID, '_budget', true);
    $application_link = get_post_meta($post->ID, '_application_link', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="deadline"><?php _e('Termín podania', 'socialne-inovacie-v8'); ?></label></th>
            <td><input type="date" id="deadline" name="deadline" value="<?php echo esc_attr($deadline); ?>" /></td>
        </tr>
        <tr>
            <th><label for="budget"><?php _e('Rozpočet', 'socialne-inovacie-v8'); ?></label></th>
            <td><input type="text" id="budget" name="budget" value="<?php echo esc_attr($budget); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="application_link"><?php _e('Odkaz na prihlášku', 'socialne-inovacie-v8'); ?></label></th>
            <td><input type="url" id="application_link" name="application_link" value="<?php echo esc_attr($application_link); ?>" class="regular-text" /></td>
        </tr>
    </table>
    <?php
}

function podujatia_meta_callback($post) {
    wp_nonce_field('podujatia_meta_nonce', 'podujatia_meta_nonce');
    $event_date = get_post_meta($post->ID, '_event_date', true);
    $event_location = get_post_meta($post->ID, '_event_location', true);
    $registration_link = get_post_meta($post->ID, '_registration_link', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="event_date"><?php _e('Dátum podujatia', 'socialne-inovacie-v8'); ?></label></th>
            <td><input type="datetime-local" id="event_date" name="event_date" value="<?php echo esc_attr($event_date); ?>" /></td>
        </tr>
        <tr>
            <th><label for="event_location"><?php _e('Miesto konania', 'socialne-inovacie-v8'); ?></label></th>
            <td><input type="text" id="event_location" name="event_location" value="<?php echo esc_attr($event_location); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="registration_link"><?php _e('Odkaz na registráciu', 'socialne-inovacie-v8'); ?></label></th>
            <td><input type="url" id="registration_link" name="registration_link" value="<?php echo esc_attr($registration_link); ?>" class="regular-text" /></td>
        </tr>
    </table>
    <?php
}

// Save meta box data
function socialne_inovacie_v8_save_meta_boxes($post_id) {
    // Save Aktuality meta
    if (isset($_POST['aktuality_meta_nonce']) && wp_verify_nonce($_POST['aktuality_meta_nonce'], 'aktuality_meta_nonce')) {
        if (isset($_POST['external_link'])) {
            update_post_meta($post_id, '_external_link', sanitize_url($_POST['external_link']));
        }
        if (isset($_POST['source'])) {
            update_post_meta($post_id, '_source', sanitize_text_field($_POST['source']));
        }
    }
    
    // Save Výzvy meta
    if (isset($_POST['vyzvy_meta_nonce']) && wp_verify_nonce($_POST['vyzvy_meta_nonce'], 'vyzvy_meta_nonce')) {
        if (isset($_POST['deadline'])) {
            update_post_meta($post_id, '_deadline', sanitize_text_field($_POST['deadline']));
        }
        if (isset($_POST['budget'])) {
            update_post_meta($post_id, '_budget', sanitize_text_field($_POST['budget']));
        }
        if (isset($_POST['application_link'])) {
            update_post_meta($post_id, '_application_link', sanitize_url($_POST['application_link']));
        }
    }
    
    // Save Podujatia meta
    if (isset($_POST['podujatia_meta_nonce']) && wp_verify_nonce($_POST['podujatia_meta_nonce'], 'podujatia_meta_nonce')) {
        if (isset($_POST['event_date'])) {
            update_post_meta($post_id, '_event_date', sanitize_text_field($_POST['event_date']));
        }
        if (isset($_POST['event_location'])) {
            update_post_meta($post_id, '_event_location', sanitize_text_field($_POST['event_location']));
        }
        if (isset($_POST['registration_link'])) {
            update_post_meta($post_id, '_registration_link', sanitize_url($_POST['registration_link']));
        }
    }
}
add_action('save_post', 'socialne_inovacie_v8_save_meta_boxes');

// NASES compliance functions
function socialne_inovacie_v8_accessibility_statement() {
    return __('Táto webová stránka je v súlade s vyhláškou č. 78/2020 Z. z. o štandardoch pre informačné technológie verejnej správy a spĺňa požiadavky WCAG 2.1 AA.', 'socialne-inovacie-v8');
}

// Add search functionality
function socialne_inovacie_v8_search_form() {
    $form = '<form role="search" method="get" class="search-form" action="' . home_url('/') . '">
        <label for="search-field" class="sr-only">' . __('Vyhľadávanie', 'socialne-inovacie-v8') . '</label>
        <input type="search" id="search-field" class="search-field" placeholder="' . esc_attr__('Vyhľadávanie...', 'socialne-inovacie-v8') . '" value="' . get_search_query() . '" name="s" required>
        <button type="submit" class="search-submit" aria-label="' . esc_attr__('Spustiť vyhľadávanie', 'socialne-inovacie-v8') . '">
            <i class="fas fa-search" aria-hidden="true"></i>
        </button>
    </form>';
    return $form;
}

// Custom excerpt length
function socialne_inovacie_v8_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'socialne_inovacie_v8_excerpt_length');

// Custom excerpt more
function socialne_inovacie_v8_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'socialne_inovacie_v8_excerpt_more');

// Add body classes for styling
function socialne_inovacie_v8_body_classes($classes) {
    $classes[] = 'light-mode';
    $classes[] = 'gov-sk-theme';
    return $classes;
}
add_filter('body_class', 'socialne_inovacie_v8_body_classes');

// Disable comments for custom post types
function socialne_inovacie_v8_disable_comments_post_types_support() {
    remove_post_type_support('aktuality', 'comments');
    remove_post_type_support('vyzvy', 'comments');
    remove_post_type_support('podujatia', 'comments');
    remove_post_type_support('inspiracia', 'comments');
}
add_action('init', 'socialne_inovacie_v8_disable_comments_post_types_support', 100);

// Helper function to get formatted date
function si_v8_format_date($date, $format = 'd. m. Y') {
    if (empty($date)) return '';
    return date_i18n($format, strtotime($date));
}

// Helper function to truncate text
function si_v8_truncate_text($text, $length = 100) {
    if (strlen($text) <= $length) return $text;
    return substr($text, 0, $length) . '...';
}
?>
