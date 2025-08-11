<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta name="keywords" content="sociálne inovácie, ministerstvo práce, gov.sk, Slovenská republika">
    <meta name="author" content="Ministerstvo práce, sociálnych vecí a rodiny SR">
    
    <!-- Open Graph meta tags -->
    <meta property="og:title" content="<?php wp_title('|', true, 'right'); bloginfo('name'); ?>">
    <meta property="og:description" content="<?php bloginfo('description'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo home_url(); ?>">
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/og-image.jpg">
    
    <!-- Government standards compliance -->
    <meta name="gov.sk" content="true">
    <meta name="department" content="Ministerstvo práce, sociálnych vecí a rodiny SR">
    <meta name="classification" content="verejná správa">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Skip links for accessibility -->
<div class="skip-links">
    <a href="#main-content" class="skip-link"><?php _e('Preskočiť na hlavný obsah', 'socialne-inovacie-v8'); ?></a>
    <a href="#navigation" class="skip-link"><?php _e('Preskočiť na navigáciu', 'socialne-inovacie-v8'); ?></a>
    <a href="#footer" class="skip-link"><?php _e('Preskočiť na pätičku', 'socialne-inovacie-v8'); ?></a>
</div>

<!-- Government Header -->
<header class="gov-header" role="banner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="gov-logo">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <i class="fas fa-shield-alt" aria-hidden="true"></i>
                    <?php endif; ?>
                    <div class="logo-text">
                        <h1><?php _e('Ministerstvo práce, sociálnych vecí a rodiny SR', 'socialne-inovacie-v8'); ?></h1>
                        <div class="tagline">gov.sk</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <a href="https://socialneinovacie.gov.sk/" 
                   class="btn btn-outline-light btn-sm" 
                   target="_blank" 
                   rel="noopener noreferrer">
                    <i class="fas fa-external-link-alt me-1" aria-hidden="true"></i>
                    <?php _e('Oficiálna stránka', 'socialne-inovacie-v8'); ?>
                </a>
            </div>
        </div>
    </div>
</header>

<!-- Main Navigation -->
<nav class="main-nav" id="navigation" role="navigation" aria-label="<?php _e('Hlavná navigácia', 'socialne-inovacie-v8'); ?>">
    <div class="container">
        <div class="navbar navbar-expand-lg navbar-light p-0">
            <button class="navbar-toggler" 
                    type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" 
                    aria-expanded="false" 
                    aria-label="<?php _e('Prepnúť navigáciu', 'socialne-inovacie-v8'); ?>">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class' => 'navbar-nav me-auto',
                    'container' => false,
                    'depth' => 2,
                    'fallback_cb' => 'socialne_inovacie_v8_default_menu',
                    'walker' => new WP_Bootstrap_Navwalker(),
                ));
                ?>
                
                <!-- Quick links -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo get_post_type_archive_link('aktuality'); ?>">
                            <i class="fas fa-newspaper me-1" aria-hidden="true"></i>
                            <?php _e('Aktuality', 'socialne-inovacie-v8'); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo get_post_type_archive_link('vyzvy'); ?>">
                            <i class="fas fa-flag me-1" aria-hidden="true"></i>
                            <?php _e('Výzvy', 'socialne-inovacie-v8'); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo get_post_type_archive_link('podujatia'); ?>">
                            <i class="fas fa-calendar me-1" aria-hidden="true"></i>
                            <?php _e('Podujatia', 'socialne-inovacie-v8'); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo get_post_type_archive_link('inspiracia'); ?>">
                            <i class="fas fa-lightbulb me-1" aria-hidden="true"></i>
                            <?php _e('Inšpirácia', 'socialne-inovacie-v8'); ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<?php
// Default menu fallback
function socialne_inovacie_v8_default_menu() {
    echo '<ul class="navbar-nav me-auto">';
    echo '<li class="nav-item"><a class="nav-link" href="' . home_url() . '">' . __('Domov', 'socialne-inovacie-v8') . '</a></li>';
    wp_list_pages(array(
        'title_li' => '',
        'before' => '<li class="nav-item"><a class="nav-link" href="',
        'after' => '</a></li>',
        'link_before' => '',
        'link_after' => '">',
    ));
    echo '</ul>';
}

// Bootstrap NavWalker (simplified version)
class WP_Bootstrap_Navwalker extends Walker_Nav_Menu {
    public function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class=\"dropdown-menu\">\n";
    }

    public function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</div>\n";
    }

    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        
        if ($depth === 0) {
            $class_names = $class_names ? ' class="nav-item ' . esc_attr($class_names) . '"' : ' class="nav-item"';
            $output .= $indent . '<li' . $class_names .'>';
            
            $link_class = 'nav-link';
            if (in_array('current-menu-item', $classes)) {
                $link_class .= ' active';
            }
        } else {
            $class_names = $class_names ? ' class="dropdown-item ' . esc_attr($class_names) . '"' : ' class="dropdown-item"';
        }
        
        $attributes = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
        $attributes .= ! empty($item->target) ? ' target="' . esc_attr($item->target) .'"' : '';
        $attributes .= ! empty($item->xfn) ? ' rel="'    . esc_attr($item->xfn) .'"' : '';
        $attributes .= ! empty($item->url) ? ' href="'   . esc_attr($item->url) .'"' : '';
        
        if ($depth === 0) {
            $attributes .= ' class="' . $link_class . '"';
        } else {
            $attributes .= $class_names;
        }
        
        $item_output = $args->before ?? '';
        $item_output .= '<a' . $attributes .'>';
        $item_output .= ($args->link_before ?? '') . apply_filters('the_title', $item->title, $item->ID) . ($args->link_after ?? '');
        $item_output .= '</a>';
        $item_output .= $args->after ?? '';
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    public function end_el(&$output, $item, $depth = 0, $args = array()) {
        if ($depth === 0) {
            $output .= "</li>\n";
        }
    }
}
?>
