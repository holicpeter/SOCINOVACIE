<?php get_header(); ?>

<main id="main-content" class="main-content" role="main" tabindex="-1">
    <div class="container">
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="page-title">
                        <?php
                        if (is_post_type_archive()) {
                            $post_type_object = get_post_type_object(get_post_type());
                            echo esc_html($post_type_object->labels->name);
                        } elseif (is_category()) {
                            single_cat_title();
                        } elseif (is_tag()) {
                            single_tag_title();
                        } elseif (is_author()) {
                            printf(__('Autor: %s', 'socialne-inovacie-v8'), get_the_author());
                        } elseif (is_date()) {
                            if (is_year()) {
                                printf(__('Rok: %s', 'socialne-inovacie-v8'), get_the_date('Y'));
                            } elseif (is_month()) {
                                printf(__('Mesiac: %s', 'socialne-inovacie-v8'), get_the_date('F Y'));
                            } elseif (is_day()) {
                                printf(__('Deň: %s', 'socialne-inovacie-v8'), get_the_date());
                            }
                        } else {
                            _e('Archív', 'socialne-inovacie-v8');
                        }
                        ?>
                    </h1>
                    
                    <?php if (is_post_type_archive() && get_post_type_object(get_post_type())->description) : ?>
                        <p class="page-description">
                            <?php echo esc_html(get_post_type_object(get_post_type())->description); ?>
                        </p>
                    <?php endif; ?>
                    
                    <?php if (category_description() || tag_description()) : ?>
                        <div class="archive-description">
                            <?php echo category_description() . tag_description(); ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="col-md-4 text-md-end">
                    <div class="archive-meta">
                        <span class="results-count">
                            <?php
                            global $wp_query;
                            printf(
                                __('Nájdených: %d príspevkov', 'socialne-inovacie-v8'),
                                $wp_query->found_posts
                            );
                            ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Breadcrumb Navigation -->
        <nav aria-label="<?php _e('Navigačná cesta', 'socialne-inovacie-v8'); ?>" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo home_url(); ?>">
                        <i class="fas fa-home me-1" aria-hidden="true"></i>
                        <?php _e('Domov', 'socialne-inovacie-v8'); ?>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php
                    if (is_post_type_archive()) {
                        echo esc_html(get_post_type_object(get_post_type())->labels->name);
                    } elseif (is_category()) {
                        single_cat_title();
                    } elseif (is_tag()) {
                        single_tag_title();
                    } else {
                        _e('Archív', 'socialne-inovacie-v8');
                    }
                    ?>
                </li>
            </ol>
        </nav>

        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                
                <!-- Filtering and Sorting -->
                <div class="archive-controls">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <!-- Filter Form -->
                            <form method="get" class="filter-form">
                                <div class="input-group">
                                    <input type="search" 
                                           name="s" 
                                           class="form-control" 
                                           placeholder="<?php _e('Vyhľadať...', 'socialne-inovacie-v8'); ?>"
                                           value="<?php echo get_search_query(); ?>"
                                           aria-label="<?php _e('Vyhľadávanie', 'socialne-inovacie-v8'); ?>">
                                    <?php if (is_post_type_archive()) : ?>
                                        <input type="hidden" name="post_type" value="<?php echo get_post_type(); ?>">
                                    <?php endif; ?>
                                    <button class="btn btn-outline-primary" type="submit">
                                        <i class="fas fa-search" aria-hidden="true"></i>
                                        <span class="sr-only"><?php _e('Vyhľadať', 'socialne-inovacie-v8'); ?></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        <div class="col-md-6 text-md-end">
                            <!-- Sort Options -->
                            <div class="sort-options">
                                <label for="sort-select" class="form-label visually-hidden">
                                    <?php _e('Zoradiť podľa', 'socialne-inovacie-v8'); ?>
                                </label>
                                <select id="sort-select" class="form-select form-select-sm" onchange="sortPosts(this.value)">
                                    <option value="date-desc" <?php selected(get_query_var('orderby'), 'date'); ?>>
                                        <?php _e('Najnovšie prvé', 'socialne-inovacie-v8'); ?>
                                    </option>
                                    <option value="date-asc">
                                        <?php _e('Najstaršie prvé', 'socialne-inovacie-v8'); ?>
                                    </option>
                                    <option value="title-asc">
                                        <?php _e('Názov A-Z', 'socialne-inovacie-v8'); ?>
                                    </option>
                                    <option value="title-desc">
                                        <?php _e('Názov Z-A', 'socialne-inovacie-v8'); ?>
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Posts Grid -->
                <?php if (have_posts()) : ?>
                    <div class="posts-grid" role="main">
                        <?php while (have_posts()) : the_post(); ?>
                            
                            <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?> role="article">
                                <div class="card h-100">
                                    
                                    <!-- Featured Image -->
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="card-img-wrapper">
                                            <a href="<?php the_permalink(); ?>" class="post-thumbnail-link">
                                                <?php 
                                                the_post_thumbnail('medium', array(
                                                    'class' => 'card-img-top',
                                                    'alt' => get_the_title()
                                                )); 
                                                ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                    <div class="card-body d-flex flex-column">
                                        
                                        <!-- Post Meta -->
                                        <div class="post-meta mb-2">
                                            <small class="text-muted">
                                                <i class="fas fa-calendar-alt me-1" aria-hidden="true"></i>
                                                <time datetime="<?php echo get_the_date('c'); ?>">
                                                    <?php echo get_the_date(); ?>
                                                </time>
                                                
                                                <?php if (get_post_type() === 'aktuality' || get_post_type() === 'inspiracia') : ?>
                                                    <span class="mx-2">|</span>
                                                    <i class="fas fa-user me-1" aria-hidden="true"></i>
                                                    <?php the_author(); ?>
                                                <?php endif; ?>
                                            </small>
                                        </div>

                                        <!-- Post Title -->
                                        <h3 class="card-title">
                                            <a href="<?php the_permalink(); ?>" class="post-title-link">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>

                                        <!-- Post Excerpt -->
                                        <div class="card-text flex-grow-1">
                                            <?php 
                                            if (has_excerpt()) {
                                                the_excerpt();
                                            } else {
                                                echo wp_trim_words(get_the_content(), 20, '...');
                                            }
                                            ?>
                                        </div>

                                        <!-- Custom Meta Fields -->
                                        <?php
                                        $post_type = get_post_type();
                                        
                                        if ($post_type === 'vyzvy') :
                                            $deadline = get_post_meta(get_the_ID(), '_deadline', true);
                                            $budget = get_post_meta(get_the_ID(), '_budget', true);
                                            if ($deadline || $budget) :
                                        ?>
                                            <div class="custom-meta">
                                                <?php if ($deadline) : ?>
                                                    <div class="meta-item">
                                                        <small class="text-danger">
                                                            <i class="fas fa-clock me-1" aria-hidden="true"></i>
                                                            <strong><?php _e('Deadline:', 'socialne-inovacie-v8'); ?></strong> 
                                                            <?php echo esc_html($deadline); ?>
                                                        </small>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($budget) : ?>
                                                    <div class="meta-item">
                                                        <small class="text-primary">
                                                            <i class="fas fa-euro-sign me-1" aria-hidden="true"></i>
                                                            <?php echo esc_html($budget); ?>
                                                        </small>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php elseif ($post_type === 'podujatia') :
                                            $event_date = get_post_meta(get_the_ID(), '_event_date', true);
                                            $location = get_post_meta(get_the_ID(), '_location', true);
                                            if ($event_date || $location) :
                                        ?>
                                            <div class="custom-meta">
                                                <?php if ($event_date) : ?>
                                                    <div class="meta-item">
                                                        <small class="text-success">
                                                            <i class="fas fa-calendar-check me-1" aria-hidden="true"></i>
                                                            <?php echo esc_html($event_date); ?>
                                                        </small>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($location) : ?>
                                                    <div class="meta-item">
                                                        <small class="text-info">
                                                            <i class="fas fa-map-marker-alt me-1" aria-hidden="true"></i>
                                                            <?php echo esc_html($location); ?>
                                                        </small>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php elseif ($post_type === 'inspiracia') :
                                            $status = get_post_meta(get_the_ID(), '_status', true);
                                            if ($status) :
                                        ?>
                                            <div class="custom-meta">
                                                <div class="meta-item">
                                                    <span class="badge bg-primary"><?php echo esc_html($status); ?></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php endif; ?>

                                        <!-- Read More Button -->
                                        <div class="card-footer bg-transparent border-0 px-0 pb-0 mt-auto">
                                            <a href="<?php the_permalink(); ?>" 
                                               class="btn btn-outline-primary btn-sm"
                                               aria-label="<?php printf(__('Čítať viac o %s', 'socialne-inovacie-v8'), get_the_title()); ?>">
                                                <?php _e('Čítať viac', 'socialne-inovacie-v8'); ?>
                                                <i class="fas fa-arrow-right ms-1" aria-hidden="true"></i>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </article>

                        <?php endwhile; ?>
                    </div>

                    <!-- Pagination -->
                    <nav class="pagination-nav" aria-label="<?php _e('Stránkovanie', 'socialne-inovacie-v8'); ?>">
                        <?php
                        echo paginate_links(array(
                            'prev_text' => '<i class="fas fa-chevron-left me-1" aria-hidden="true"></i>' . __('Predchádzajúca', 'socialne-inovacie-v8'),
                            'next_text' => __('Nasledujúca', 'socialne-inovacie-v8') . '<i class="fas fa-chevron-right ms-1" aria-hidden="true"></i>',
                            'before_page_number' => '<span class="screen-reader-text">' . __('Stránka', 'socialne-inovacie-v8') . ' </span>',
                            'class' => 'pagination justify-content-center'
                        ));
                        ?>
                    </nav>

                <?php else : ?>
                    
                    <!-- No Posts Found -->
                    <div class="no-posts-found text-center">
                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-info-circle me-2" aria-hidden="true"></i>
                            <h4 class="alert-heading"><?php _e('Žiadne príspevky neboli nájdené', 'socialne-inovacie-v8'); ?></h4>
                            <p><?php _e('Skúste upraviť vyhľadávacie kritériá alebo sa vráťte na hlavnú stránku.', 'socialne-inovacie-v8'); ?></p>
                            <hr>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <a href="<?php echo home_url(); ?>" class="btn btn-primary">
                                    <i class="fas fa-home me-1" aria-hidden="true"></i>
                                    <?php _e('Späť na domov', 'socialne-inovacie-v8'); ?>
                                </a>
                                <a href="<?php echo get_post_type_archive_link(get_post_type()); ?>" class="btn btn-outline-primary">
                                    <?php _e('Všetky príspevky', 'socialne-inovacie-v8'); ?>
                                </a>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>

            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <aside class="sidebar" role="complementary">
                    
                    <!-- Search Widget -->
                    <?php if (is_active_sidebar('sidebar-archive')) : ?>
                        <?php dynamic_sidebar('sidebar-archive'); ?>
                    <?php else : ?>
                        
                        <div class="widget search-widget">
                            <h6 class="widget-title"><?php _e('Vyhľadávanie', 'socialne-inovacie-v8'); ?></h6>
                            <?php get_search_form(); ?>
                        </div>

                        <!-- Categories -->
                        <?php if (get_post_type() === 'post' && wp_list_categories(array('echo' => false))) : ?>
                            <div class="widget categories-widget">
                                <h6 class="widget-title"><?php _e('Kategórie', 'socialne-inovacie-v8'); ?></h6>
                                <ul class="category-list">
                                    <?php wp_list_categories(array('title_li' => '')); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- Recent Posts -->
                        <div class="widget recent-posts-widget">
                            <h6 class="widget-title">
                                <?php 
                                if (is_post_type_archive()) {
                                    printf(__('Najnovšie %s', 'socialne-inovacie-v8'), 
                                           get_post_type_object(get_post_type())->labels->name);
                                } else {
                                    _e('Najnovšie príspevky', 'socialne-inovacie-v8');
                                }
                                ?>
                            </h6>
                            <?php
                            $recent_args = array(
                                'post_type' => is_post_type_archive() ? get_post_type() : 'post',
                                'posts_per_page' => 5,
                                'post_status' => 'publish'
                            );
                            
                            $recent_posts = new WP_Query($recent_args);
                            
                            if ($recent_posts->have_posts()) :
                            ?>
                                <ul class="recent-posts-list">
                                    <?php while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
                                        <li class="recent-post-item">
                                            <a href="<?php the_permalink(); ?>" class="recent-post-link">
                                                <h6 class="recent-post-title"><?php the_title(); ?></h6>
                                                <small class="recent-post-date"><?php echo get_the_date(); ?></small>
                                            </a>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php
                            endif;
                            wp_reset_postdata();
                            ?>
                        </div>

                        <!-- Quick Links -->
                        <div class="widget quick-links-widget">
                            <h6 class="widget-title"><?php _e('Rýchle odkazy', 'socialne-inovacie-v8'); ?></h6>
                            <ul class="quick-links-list">
                                <li><a href="<?php echo get_post_type_archive_link('aktuality'); ?>"><?php _e('Aktuality', 'socialne-inovacie-v8'); ?></a></li>
                                <li><a href="<?php echo get_post_type_archive_link('vyzvy'); ?>"><?php _e('Výzvy', 'socialne-inovacie-v8'); ?></a></li>
                                <li><a href="<?php echo get_post_type_archive_link('podujatia'); ?>"><?php _e('Podujatia', 'socialne-inovacie-v8'); ?></a></li>
                                <li><a href="<?php echo get_post_type_archive_link('inspiracia'); ?>"><?php _e('Inšpirácia', 'socialne-inovacie-v8'); ?></a></li>
                                <li><a href="https://socialneinovacie.gov.sk/" target="_blank" rel="noopener noreferrer"><?php _e('Oficiálna stránka', 'socialne-inovacie-v8'); ?></a></li>
                            </ul>
                        </div>

                    <?php endif; ?>

                </aside>
            </div>
        </div>

    </div>
</main>

<script>
function sortPosts(sortValue) {
    const url = new URL(window.location);
    const [orderby, order] = sortValue.split('-');
    
    url.searchParams.set('orderby', orderby);
    url.searchParams.set('order', order);
    
    window.location.href = url.toString();
}

// Initialize sort select based on URL parameters
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const orderby = urlParams.get('orderby') || 'date';
    const order = urlParams.get('order') || 'desc';
    const sortValue = orderby + '-' + order;
    
    const sortSelect = document.getElementById('sort-select');
    if (sortSelect) {
        sortSelect.value = sortValue;
    }
});
</script>

<?php get_footer(); ?>
