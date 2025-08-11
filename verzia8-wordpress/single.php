<?php get_header(); ?>

<main id="main-content" class="main-content" role="main" tabindex="-1">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            
            <!-- Breadcrumb Navigation -->
            <nav aria-label="<?php _e('Navigačná cesta', 'socialne-inovacie-v8'); ?>" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo home_url(); ?>">
                            <i class="fas fa-home me-1" aria-hidden="true"></i>
                            <?php _e('Domov', 'socialne-inovacie-v8'); ?>
                        </a>
                    </li>
                    <?php
                    $post_type = get_post_type();
                    $post_type_object = get_post_type_object($post_type);
                    if ($post_type_object) :
                    ?>
                        <li class="breadcrumb-item">
                            <a href="<?php echo get_post_type_archive_link($post_type); ?>">
                                <?php echo esc_html($post_type_object->labels->name); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="breadcrumb-item active" aria-current="page">
                        <?php the_title(); ?>
                    </li>
                </ol>
            </nav>

            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?> role="article">
                        
                        <!-- Post Header -->
                        <header class="post-header">
                            <h1 class="post-title"><?php the_title(); ?></h1>
                            
                            <div class="post-meta">
                                <div class="meta-item">
                                    <i class="fas fa-calendar-alt me-1" aria-hidden="true"></i>
                                    <time datetime="<?php echo get_the_date('c'); ?>" class="published">
                                        <?php echo get_the_date(); ?>
                                    </time>
                                </div>
                                
                                <?php if (get_post_type() === 'aktuality' || get_post_type() === 'inspiracia') : ?>
                                    <div class="meta-item">
                                        <i class="fas fa-user me-1" aria-hidden="true"></i>
                                        <span class="author">
                                            <?php the_author(); ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                                
                                <?php
                                // Custom meta fields based on post type
                                $post_type = get_post_type();
                                
                                if ($post_type === 'vyzvy') :
                                    $deadline = get_post_meta(get_the_ID(), '_deadline', true);
                                    $budget = get_post_meta(get_the_ID(), '_budget', true);
                                    if ($deadline) :
                                ?>
                                    <div class="meta-item deadline">
                                        <i class="fas fa-clock me-1" aria-hidden="true"></i>
                                        <span class="text-danger">
                                            <strong><?php _e('Deadline:', 'socialne-inovacie-v8'); ?></strong> 
                                            <?php echo esc_html($deadline); ?>
                                        </span>
                                    </div>
                                <?php 
                                    endif;
                                    if ($budget) :
                                ?>
                                    <div class="meta-item budget">
                                        <i class="fas fa-euro-sign me-1" aria-hidden="true"></i>
                                        <strong><?php _e('Rozpočet:', 'socialne-inovacie-v8'); ?></strong> 
                                        <?php echo esc_html($budget); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php elseif ($post_type === 'podujatia') :
                                    $event_date = get_post_meta(get_the_ID(), '_event_date', true);
                                    $location = get_post_meta(get_the_ID(), '_location', true);
                                    if ($event_date) :
                                ?>
                                    <div class="meta-item event-date">
                                        <i class="fas fa-calendar-check me-1" aria-hidden="true"></i>
                                        <strong><?php _e('Dátum podujatia:', 'socialne-inovacie-v8'); ?></strong> 
                                        <?php echo esc_html($event_date); ?>
                                    </div>
                                <?php 
                                    endif;
                                    if ($location) :
                                ?>
                                    <div class="meta-item location">
                                        <i class="fas fa-map-marker-alt me-1" aria-hidden="true"></i>
                                        <strong><?php _e('Miesto:', 'socialne-inovacie-v8'); ?></strong> 
                                        <?php echo esc_html($location); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php elseif ($post_type === 'inspiracia') :
                                    $website = get_post_meta(get_the_ID(), '_website', true);
                                    $status = get_post_meta(get_the_ID(), '_status', true);
                                    if ($website) :
                                ?>
                                    <div class="meta-item website">
                                        <i class="fas fa-globe me-1" aria-hidden="true"></i>
                                        <a href="<?php echo esc_url($website); ?>" target="_blank" rel="noopener noreferrer">
                                            <?php _e('Webová stránka projektu', 'socialne-inovacie-v8'); ?>
                                            <i class="fas fa-external-link-alt ms-1" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                <?php 
                                    endif;
                                    if ($status) :
                                ?>
                                    <div class="meta-item status">
                                        <i class="fas fa-info-circle me-1" aria-hidden="true"></i>
                                        <span class="badge bg-primary"><?php echo esc_html($status); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </header>

                        <!-- Featured Image -->
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <?php 
                                the_post_thumbnail('large', array(
                                    'class' => 'img-fluid rounded',
                                    'alt' => get_the_title()
                                )); 
                                ?>
                            </div>
                        <?php endif; ?>

                        <!-- Post Content -->
                        <div class="post-content">
                            <?php the_content(); ?>
                            
                            <?php
                            wp_link_pages(array(
                                'before' => '<div class="page-links"><span class="page-links-title">' . __('Stránky:', 'socialne-inovacie-v8') . '</span>',
                                'after'  => '</div>',
                                'link_before' => '<span>',
                                'link_after'  => '</span>',
                            ));
                            ?>
                        </div>

                        <!-- Tags and Categories -->
                        <?php if (has_tag() || has_category()) : ?>
                            <div class="post-taxonomies">
                                <?php if (has_category()) : ?>
                                    <div class="post-categories">
                                        <strong><?php _e('Kategórie:', 'socialne-inovacie-v8'); ?></strong>
                                        <?php the_category(', '); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if (has_tag()) : ?>
                                    <div class="post-tags">
                                        <strong><?php _e('Značky:', 'socialne-inovacie-v8'); ?></strong>
                                        <?php the_tags('', ', ', ''); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Share Buttons -->
                        <div class="post-share">
                            <h6><?php _e('Zdieľať:', 'socialne-inovacie-v8'); ?></h6>
                            <div class="share-buttons">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                                   target="_blank" 
                                   rel="noopener noreferrer" 
                                   class="btn btn-outline-primary btn-sm"
                                   aria-label="<?php _e('Zdieľať na Facebooku', 'socialne-inovacie-v8'); ?>">
                                    <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" 
                                   target="_blank" 
                                   rel="noopener noreferrer" 
                                   class="btn btn-outline-info btn-sm"
                                   aria-label="<?php _e('Zdieľať na Twitteri', 'socialne-inovacie-v8'); ?>">
                                    <i class="fab fa-twitter" aria-hidden="true"></i>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>" 
                                   target="_blank" 
                                   rel="noopener noreferrer" 
                                   class="btn btn-outline-primary btn-sm"
                                   aria-label="<?php _e('Zdieľať na LinkedIne', 'socialne-inovacie-v8'); ?>">
                                    <i class="fab fa-linkedin-in" aria-hidden="true"></i>
                                </a>
                                <button onclick="copyToClipboard('<?php echo get_permalink(); ?>')" 
                                        class="btn btn-outline-secondary btn-sm"
                                        aria-label="<?php _e('Kopírovať odkaz', 'socialne-inovacie-v8'); ?>">
                                    <i class="fas fa-link" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>

                    </article>

                    <!-- Post Navigation -->
                    <nav class="post-navigation" aria-label="<?php _e('Navigácia medzi príspevkami', 'socialne-inovacie-v8'); ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <?php
                                $prev_post = get_previous_post();
                                if ($prev_post) :
                                ?>
                                    <a href="<?php echo get_permalink($prev_post); ?>" class="nav-link prev-post">
                                        <i class="fas fa-chevron-left me-2" aria-hidden="true"></i>
                                        <div>
                                            <small><?php _e('Predchádzajúci', 'socialne-inovacie-v8'); ?></small>
                                            <div class="nav-title"><?php echo get_the_title($prev_post); ?></div>
                                        </div>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <?php
                                $next_post = get_next_post();
                                if ($next_post) :
                                ?>
                                    <a href="<?php echo get_permalink($next_post); ?>" class="nav-link next-post">
                                        <div>
                                            <small><?php _e('Nasledujúci', 'socialne-inovacie-v8'); ?></small>
                                            <div class="nav-title"><?php echo get_the_title($next_post); ?></div>
                                        </div>
                                        <i class="fas fa-chevron-right ms-2" aria-hidden="true"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </nav>

                    <!-- Comments Section -->
                    <?php
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    ?>

                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <aside class="sidebar" role="complementary">
                        
                        <!-- Back to Archive -->
                        <div class="widget">
                            <a href="<?php echo get_post_type_archive_link(get_post_type()); ?>" class="btn btn-outline-primary w-100">
                                <i class="fas fa-arrow-left me-2" aria-hidden="true"></i>
                                <?php 
                                $post_type_object = get_post_type_object(get_post_type());
                                printf(__('Späť na %s', 'socialne-inovacie-v8'), $post_type_object->labels->name);
                                ?>
                            </a>
                        </div>

                        <!-- Search Widget -->
                        <?php if (is_active_sidebar('sidebar-main')) : ?>
                            <?php dynamic_sidebar('sidebar-main'); ?>
                        <?php else : ?>
                            <div class="widget search-widget">
                                <h6 class="widget-title"><?php _e('Vyhľadávanie', 'socialne-inovacie-v8'); ?></h6>
                                <?php get_search_form(); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Related Posts -->
                        <?php
                        $related_args = array(
                            'post_type' => get_post_type(),
                            'posts_per_page' => 5,
                            'post__not_in' => array(get_the_ID()),
                            'orderby' => 'date',
                            'order' => 'DESC'
                        );
                        
                        $related_posts = new WP_Query($related_args);
                        
                        if ($related_posts->have_posts()) :
                        ?>
                            <div class="widget related-posts">
                                <h6 class="widget-title">
                                    <?php 
                                    $post_type_object = get_post_type_object(get_post_type());
                                    printf(__('Podobné %s', 'socialne-inovacie-v8'), $post_type_object->labels->name);
                                    ?>
                                </h6>
                                <ul class="related-posts-list">
                                    <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                                        <li class="related-post-item">
                                            <a href="<?php the_permalink(); ?>" class="related-post-link">
                                                <?php if (has_post_thumbnail()) : ?>
                                                    <div class="related-post-thumbnail">
                                                        <?php the_post_thumbnail('thumbnail', array('alt' => get_the_title())); ?>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="related-post-content">
                                                    <h6 class="related-post-title"><?php the_title(); ?></h6>
                                                    <small class="related-post-date"><?php echo get_the_date(); ?></small>
                                                </div>
                                            </a>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                        <?php
                        endif;
                        wp_reset_postdata();
                        ?>

                        <!-- Contact Widget -->
                        <div class="widget contact-widget">
                            <h6 class="widget-title"><?php _e('Kontakt', 'socialne-inovacie-v8'); ?></h6>
                            <p><?php _e('Máte otázky? Kontaktujte nás!', 'socialne-inovacie-v8'); ?></p>
                            <a href="mailto:info@employment.gov.sk" class="btn btn-primary btn-sm">
                                <i class="fas fa-envelope me-1" aria-hidden="true"></i>
                                <?php _e('Napísať e-mail', 'socialne-inovacie-v8'); ?>
                            </a>
                        </div>

                    </aside>
                </div>
            </div>

        <?php endwhile; ?>
    </div>
</main>

<script>
function copyToClipboard(url) {
    navigator.clipboard.writeText(url).then(function() {
        // Show success message
        const button = event.target.closest('button');
        const originalHTML = button.innerHTML;
        button.innerHTML = '<i class="fas fa-check" aria-hidden="true"></i>';
        button.classList.remove('btn-outline-secondary');
        button.classList.add('btn-success');
        
        setTimeout(function() {
            button.innerHTML = originalHTML;
            button.classList.remove('btn-success');
            button.classList.add('btn-outline-secondary');
        }, 2000);
    });
}
</script>

<?php get_footer(); ?>
