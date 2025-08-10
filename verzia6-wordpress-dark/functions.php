<?php
/**
 * WordPress Dark Mode Theme for Sociálne Inovácie
 * A cyberpunk-inspired dark theme with neon accents
 * Version: 1.0
 * Template: Twenty Twenty-Four Child
 */

// Theme setup
function socialneinovacie_dark_setup() {
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
        'script'
    ));
    add_theme_support('custom-logo', array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ));
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
    
    // Register navigation menus
    register_nav_menus(array(
        'main' => esc_html__('Hlavné menu', 'socialneinovacie-dark'),
        'footer' => esc_html__('Footer menu', 'socialneinovacie-dark'),
    ));
}
add_action('after_setup_theme', 'socialneinovacie_dark_setup');

// Enqueue styles and scripts
function socialneinovacie_dark_scripts() {
    // Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Fira+Code:wght@400;500;600&display=swap', array(), null);
    
    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
    
    // Theme stylesheet
    wp_enqueue_style('socialneinovacie-dark-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));
    
    // Theme scripts
    wp_enqueue_script('socialneinovacie-dark-main', get_template_directory_uri() . '/js/main.js', array('jquery'), wp_get_theme()->get('Version'), true);
    wp_enqueue_script('socialneinovacie-dark-accessibility', get_template_directory_uri() . '/js/accessibility.js', array(), wp_get_theme()->get('Version'), true);
    
    // Localize script for AJAX
    wp_localize_script('socialneinovacie-dark-main', 'socialneinovacie_ajax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('socialneinovacie_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'socialneinovacie_dark_scripts');

// Custom post types
function socialneinovacie_dark_post_types() {
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
            'not_found' => 'Nenašli sa žiadne aktuality',
            'not_found_in_trash' => 'V koši nie su žiadne aktuality'
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-admin-post',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'author', 'comments'),
        'show_in_rest' => true,
        'menu_position' => 5
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
            'not_found' => 'Nenašli sa žiadne výzvy',
            'not_found_in_trash' => 'V koši nie su žiadne výzvy'
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-megaphone',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'author'),
        'show_in_rest' => true,
        'menu_position' => 6
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
            'not_found' => 'Nenašli sa žiadne podujatia',
            'not_found_in_trash' => 'V koši nie su žiadne podujatia'
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-calendar-alt',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'author'),
        'show_in_rest' => true,
        'menu_position' => 7
    ));
}
add_action('init', 'socialneinovacie_dark_post_types');

// Custom meta boxes
function socialneinovacie_dark_meta_boxes() {
    // Meta box for Výzvy
    add_meta_box(
        'vyzvy_details',
        'Detaily výzvy',
        'vyzvy_meta_box_callback',
        'vyzvy',
        'normal',
        'high'
    );
    
    // Meta box for Podujatia
    add_meta_box(
        'podujatia_details',
        'Detaily podujatia',
        'podujatia_meta_box_callback',
        'podujatia',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'socialneinovacie_dark_meta_boxes');

function vyzvy_meta_box_callback($post) {
    wp_nonce_field('save_vyzvy_meta', 'vyzvy_meta_nonce');
    
    $deadline = get_post_meta($post->ID, '_vyzvy_deadline', true);
    $budget = get_post_meta($post->ID, '_vyzvy_budget', true);
    $status = get_post_meta($post->ID, '_vyzvy_status', true);
    
    echo '<table class="form-table">';
    echo '<tr><th><label for="vyzvy_deadline">Deadline:</label></th>';
    echo '<td><input type="date" id="vyzvy_deadline" name="vyzvy_deadline" value="' . esc_attr($deadline) . '" /></td></tr>';
    echo '<tr><th><label for="vyzvy_budget">Rozpočet:</label></th>';
    echo '<td><input type="text" id="vyzvy_budget" name="vyzvy_budget" value="' . esc_attr($budget) . '" /></td></tr>';
    echo '<tr><th><label for="vyzvy_status">Status:</label></th>';
    echo '<td><select id="vyzvy_status" name="vyzvy_status">';
    echo '<option value="otvorena"' . selected($status, 'otvorena', false) . '>Otvorená</option>';
    echo '<option value="zatvorena"' . selected($status, 'zatvorena', false) . '>Zatvorená</option>';
    echo '<option value="pripravuje"' . selected($status, 'pripravuje', false) . '>Pripravuje sa</option>';
    echo '</select></td></tr>';
    echo '</table>';
}

function podujatia_meta_box_callback($post) {
    wp_nonce_field('save_podujatia_meta', 'podujatia_meta_nonce');
    
    $date = get_post_meta($post->ID, '_podujatia_date', true);
    $location = get_post_meta($post->ID, '_podujatia_location', true);
    $capacity = get_post_meta($post->ID, '_podujatia_capacity', true);
    
    echo '<table class="form-table">';
    echo '<tr><th><label for="podujatia_date">Dátum podujatia:</label></th>';
    echo '<td><input type="datetime-local" id="podujatia_date" name="podujatia_date" value="' . esc_attr($date) . '" /></td></tr>';
    echo '<tr><th><label for="podujatia_location">Miesto:</label></th>';
    echo '<td><input type="text" id="podujatia_location" name="podujatia_location" value="' . esc_attr($location) . '" /></td></tr>';
    echo '<tr><th><label for="podujatia_capacity">Kapacita:</label></th>';
    echo '<td><input type="number" id="podujatia_capacity" name="podujatia_capacity" value="' . esc_attr($capacity) . '" /></td></tr>';
    echo '</table>';
}

// Save meta box data
function save_vyzvy_meta($post_id) {
    if (!isset($_POST['vyzvy_meta_nonce']) || !wp_verify_nonce($_POST['vyzvy_meta_nonce'], 'save_vyzvy_meta')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (isset($_POST['vyzvy_deadline'])) {
        update_post_meta($post_id, '_vyzvy_deadline', sanitize_text_field($_POST['vyzvy_deadline']));
    }
    
    if (isset($_POST['vyzvy_budget'])) {
        update_post_meta($post_id, '_vyzvy_budget', sanitize_text_field($_POST['vyzvy_budget']));
    }
    
    if (isset($_POST['vyzvy_status'])) {
        update_post_meta($post_id, '_vyzvy_status', sanitize_text_field($_POST['vyzvy_status']));
    }
}
add_action('save_post', 'save_vyzvy_meta');

function save_podujatia_meta($post_id) {
    if (!isset($_POST['podujatia_meta_nonce']) || !wp_verify_nonce($_POST['podujatia_meta_nonce'], 'save_podujatia_meta')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (isset($_POST['podujatia_date'])) {
        update_post_meta($post_id, '_podujatia_date', sanitize_text_field($_POST['podujatia_date']));
    }
    
    if (isset($_POST['podujatia_location'])) {
        update_post_meta($post_id, '_podujatia_location', sanitize_text_field($_POST['podujatia_location']));
    }
    
    if (isset($_POST['podujatia_capacity'])) {
        update_post_meta($post_id, '_podujatia_capacity', sanitize_text_field($_POST['podujatia_capacity']));
    }
}
add_action('save_post', 'save_podujatia_meta');

// Widget areas
function socialneinovacie_dark_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'socialneinovacie-dark'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'socialneinovacie-dark'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('Footer Area 1', 'socialneinovacie-dark'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add widgets here to appear in your footer.', 'socialneinovacie-dark'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('Footer Area 2', 'socialneinovacie-dark'),
        'id'            => 'footer-2',
        'description'   => esc_html__('Add widgets here to appear in your footer.', 'socialneinovacie-dark'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('Footer Area 3', 'socialneinovacie-dark'),
        'id'            => 'footer-3',
        'description'   => esc_html__('Add widgets here to appear in your footer.', 'socialneinovacie-dark'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'socialneinovacie_dark_widgets_init');

// Customizer settings
function socialneinovacie_dark_customize_register($wp_customize) {
    // Theme options section
    $wp_customize->add_section('socialneinovacie_dark_options', array(
        'title'    => __('Dark Theme Options', 'socialneinovacie-dark'),
        'priority' => 130,
    ));
    
    // Glow intensity setting
    $wp_customize->add_setting('glow_intensity', array(
        'default'           => '0.5',
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('glow_intensity', array(
        'label'    => __('Glow Effect Intensity', 'socialneinovacie-dark'),
        'section'  => 'socialneinovacie_dark_options',
        'type'     => 'range',
        'input_attrs' => array(
            'min'  => 0.1,
            'max'  => 1,
            'step' => 0.1,
        ),
    ));
    
    // Animation speed setting
    $wp_customize->add_setting('animation_speed', array(
        'default'           => 'normal',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('animation_speed', array(
        'label'   => __('Animation Speed', 'socialneinovacie-dark'),
        'section' => 'socialneinovacie_dark_options',
        'type'    => 'select',
        'choices' => array(
            'slow'   => __('Slow', 'socialneinovacie-dark'),
            'normal' => __('Normal', 'socialneinovacie-dark'),
            'fast'   => __('Fast', 'socialneinovacie-dark'),
        ),
    ));
    
    // Cyberpunk mode setting
    $wp_customize->add_setting('cyberpunk_mode', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    
    $wp_customize->add_control('cyberpunk_mode', array(
        'label'   => __('Enhanced Cyberpunk Mode', 'socialneinovacie-dark'),
        'section' => 'socialneinovacie_dark_options',
        'type'    => 'checkbox',
    ));
}
add_action('customize_register', 'socialneinovacie_dark_customize_register');

// NASES accessibility features
function socialneinovacie_dark_accessibility() {
    // Skip to content link
    echo '<a class="screen-reader-text" href="#main">' . esc_html__('Preskočiť na hlavný obsah', 'socialneinovacie-dark') . '</a>';
}
add_action('wp_body_open', 'socialneinovacie_dark_accessibility');

// Custom body classes
function socialneinovacie_dark_body_classes($classes) {
    // Add dark mode class
    $classes[] = 'dark-mode';
    
    // Add cyberpunk mode if enabled
    if (get_theme_mod('cyberpunk_mode', false)) {
        $classes[] = 'cyberpunk-enhanced';
    }
    
    // Add animation speed class
    $animation_speed = get_theme_mod('animation_speed', 'normal');
    $classes[] = 'animations-' . $animation_speed;
    
    return $classes;
}
add_filter('body_class', 'socialneinovacie_dark_body_classes');

// Custom excerpt length
function socialneinovacie_dark_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'socialneinovacie_dark_excerpt_length', 999);

// Custom excerpt more
function socialneinovacie_dark_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'socialneinovacie_dark_excerpt_more');

// Helper function to get post type icon
function get_post_type_icon($post_type) {
    $icons = array(
        'aktuality' => 'fas fa-newspaper',
        'vyzvy' => 'fas fa-bullhorn',
        'podujatia' => 'fas fa-calendar-check',
        'post' => 'fas fa-file-alt',
        'page' => 'fas fa-file'
    );
    
    return isset($icons[$post_type]) ? $icons[$post_type] : 'fas fa-file';
}

// Helper function to get post type color
function get_post_type_color($post_type) {
    $colors = array(
        'aktuality' => 'var(--gradient-primary)',
        'vyzvy' => 'var(--gradient-warning)',
        'podujatia' => 'var(--gradient-success)',
        'post' => 'var(--gradient-accent)',
        'page' => 'var(--gradient-primary)'
    );
    
    return isset($colors[$post_type]) ? $colors[$post_type] : 'var(--gradient-accent)';
}

// Add theme customizer CSS
function socialneinovacie_dark_customizer_css() {
    $glow_intensity = get_theme_mod('glow_intensity', 0.5);
    $cyberpunk_mode = get_theme_mod('cyberpunk_mode', false);
    
    ?>
    <style type="text/css">
        :root {
            --glow-intensity: <?php echo esc_attr($glow_intensity); ?>;
        }
        
        <?php if ($cyberpunk_mode) : ?>
        .cyberpunk-enhanced {
            --accent: #00ff41;
            --accent-dark: #00cc33;
            --gradient-accent: linear-gradient(135deg, #00ff41 0%, #00cc33 100%);
        }
        
        .cyberpunk-enhanced .site-title {
            animation: cyberpunk-glow 2s ease-in-out infinite alternate;
        }
        
        @keyframes cyberpunk-glow {
            from { text-shadow: 0 0 20px #00ff41, 0 0 30px #00ff41, 0 0 40px #00ff41; }
            to { text-shadow: 0 0 30px #00ff41, 0 0 40px #00ff41, 0 0 50px #00ff41; }
        }
        <?php endif; ?>
    </style>
    <?php
}
add_action('wp_head', 'socialneinovacie_dark_customizer_css');

// Security headers
function socialneinovacie_dark_security_headers() {
    if (!headers_sent()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
        header('Referrer-Policy: strict-origin-when-cross-origin');
    }
}
add_action('send_headers', 'socialneinovacie_dark_security_headers');

// Load text domain
function socialneinovacie_dark_load_textdomain() {
    load_theme_textdomain('socialneinovacie-dark', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'socialneinovacie_dark_load_textdomain');

// Disable WordPress emoji scripts (performance optimization)
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

// Remove WordPress generator meta tag (security)
remove_action('wp_head', 'wp_generator');

?>
