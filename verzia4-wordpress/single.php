<?php
/**
 * Single post template
 */

get_header(); ?>

<main id="main-content" class="site-main" role="main">
    <div class="container">
        
        <?php while (have_posts()) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
                
                <!-- Post Header -->
                <header class="entry-header">
                    <div class="entry-meta">
                        <span class="posted-on">
                            <i class="fas fa-calendar" aria-hidden="true"></i>
                            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                <?php echo esc_html(get_the_date('j. F Y')); ?>
                            </time>
                        </span>
                        
                        <span class="byline">
                            <i class="fas fa-user" aria-hidden="true"></i>
                            <span class="author vcard">
                                <a class="url fn n" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                    <?php echo esc_html(get_the_author()); ?>
                                </a>
                            </span>
                        </span>
                        
                        <?php
                        $categories = get_the_category();
                        if (!empty($categories)) :
                        ?>
                            <span class="cat-links">
                                <i class="fas fa-folder" aria-hidden="true"></i>
                                <?php foreach ($categories as $category) : ?>
                                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                                        <?php echo esc_html($category->name); ?>
                                    </a>
                                <?php endforeach; ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    
                    <?php if (has_excerpt()) : ?>
                        <div class="entry-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                    <?php endif; ?>
                </header>

                <!-- Featured Image -->
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('large'); ?>
                        <?php if (get_the_post_thumbnail_caption()) : ?>
                            <figcaption class="wp-caption-text">
                                <?php echo esc_html(get_the_post_thumbnail_caption()); ?>
                            </figcaption>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- Post Content -->
                <div class="entry-content">
                    <?php
                    the_content();
                    
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Stránky:', 'socialne-inovacie'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <!-- Custom Meta Fields for different post types -->
                <?php if (get_post_type() === 'vyzvy') : ?>
                    <div class="vyzva-details">
                        <h3><?php esc_html_e('Detaily výzvy', 'socialne-inovacie'); ?></h3>
                        <?php
                        $amount = get_post_meta(get_the_ID(), '_vyzva_amount', true);
                        $status = get_post_meta(get_the_ID(), '_vyzva_status', true);
                        $deadline = get_post_meta(get_the_ID(), '_vyzva_deadline', true);
                        ?>
                        <div class="meta-grid">
                            <?php if ($amount) : ?>
                                <div class="meta-item">
                                    <strong><?php esc_html_e('Výška podpory:', 'socialne-inovacie'); ?></strong>
                                    <span><?php echo esc_html($amount); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ($status) : ?>
                                <div class="meta-item">
                                    <strong><?php esc_html_e('Status:', 'socialne-inovacie'); ?></strong>
                                    <span class="status-badge status-<?php echo esc_attr(strtolower($status)); ?>">
                                        <?php echo esc_html($status); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                            <?php if ($deadline) : ?>
                                <div class="meta-item">
                                    <strong><?php esc_html_e('Termín podania:', 'socialne-inovacie'); ?></strong>
                                    <time datetime="<?php echo esc_attr($deadline); ?>">
                                        <?php echo esc_html(date('j. F Y', strtotime($deadline))); ?>
                                    </time>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (get_post_type() === 'podujatia') : ?>
                    <div class="podujatie-details">
                        <h3><?php esc_html_e('Detaily podujatia', 'socialne-inovacie'); ?></h3>
                        <?php
                        $location = get_post_meta(get_the_ID(), '_podujatie_location', true);
                        $event_date = get_post_meta(get_the_ID(), '_podujatie_date', true);
                        $time = get_post_meta(get_the_ID(), '_podujatie_time', true);
                        $capacity = get_post_meta(get_the_ID(), '_podujatie_capacity', true);
                        ?>
                        <div class="meta-grid">
                            <?php if ($event_date) : ?>
                                <div class="meta-item">
                                    <strong><?php esc_html_e('Dátum:', 'socialne-inovacie'); ?></strong>
                                    <time datetime="<?php echo esc_attr($event_date); ?>">
                                        <?php echo esc_html(date('j. F Y', strtotime($event_date))); ?>
                                    </time>
                                </div>
                            <?php endif; ?>
                            <?php if ($time) : ?>
                                <div class="meta-item">
                                    <strong><?php esc_html_e('Čas:', 'socialne-inovacie'); ?></strong>
                                    <span><?php echo esc_html($time); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ($location) : ?>
                                <div class="meta-item">
                                    <strong><?php esc_html_e('Miesto:', 'socialne-inovacie'); ?></strong>
                                    <span><?php echo esc_html($location); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ($capacity) : ?>
                                <div class="meta-item">
                                    <strong><?php esc_html_e('Kapacita:', 'socialne-inovacie'); ?></strong>
                                    <span><?php echo esc_html($capacity . ' ' . __('účastníkov', 'socialne-inovacie')); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Post Footer -->
                <footer class="entry-footer">
                    <?php
                    $tags = get_the_tags();
                    if ($tags) :
                    ?>
                        <div class="tag-links">
                            <strong><?php esc_html_e('Značky:', 'socialne-inovacie'); ?></strong>
                            <?php foreach ($tags as $tag) : ?>
                                <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="tag">
                                    <?php echo esc_html($tag->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Social Share Buttons -->
                    <div class="social-share">
                        <strong><?php esc_html_e('Zdieľať:', 'socialne-inovacie'); ?></strong>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_permalink()); ?>" 
                           target="_blank" rel="noopener noreferrer" 
                           aria-label="<?php esc_attr_e('Zdieľať na Facebooku', 'socialne-inovacie'); ?>">
                            <i class="fab fa-facebook-f" aria-hidden="true"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo esc_url(get_permalink()); ?>&text=<?php echo esc_attr(get_the_title()); ?>" 
                           target="_blank" rel="noopener noreferrer"
                           aria-label="<?php esc_attr_e('Zdieľať na Twitteri', 'socialne-inovacie'); ?>">
                            <i class="fab fa-twitter" aria-hidden="true"></i>
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo esc_url(get_permalink()); ?>" 
                           target="_blank" rel="noopener noreferrer"
                           aria-label="<?php esc_attr_e('Zdieľať na LinkedIn', 'socialne-inovacie'); ?>">
                            <i class="fab fa-linkedin-in" aria-hidden="true"></i>
                        </a>
                        <a href="mailto:?subject=<?php echo esc_attr(get_the_title()); ?>&body=<?php echo esc_url(get_permalink()); ?>"
                           aria-label="<?php esc_attr_e('Zdieľať emailom', 'socialne-inovacie'); ?>">
                            <i class="fas fa-envelope" aria-hidden="true"></i>
                        </a>
                    </div>
                </footer>

            </article>

            <!-- Post Navigation -->
            <nav class="post-navigation" aria-label="<?php esc_attr_e('Navigácia medzi príspevkami', 'socialne-inovacie'); ?>">
                <div class="nav-links">
                    <?php
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();
                    ?>
                    
                    <?php if ($prev_post) : ?>
                        <div class="nav-previous">
                            <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" rel="prev">
                                <span class="nav-subtitle"><?php esc_html_e('Predchádzajúci:', 'socialne-inovacie'); ?></span>
                                <span class="nav-title"><?php echo esc_html(get_the_title($prev_post)); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($next_post) : ?>
                        <div class="nav-next">
                            <a href="<?php echo esc_url(get_permalink($next_post)); ?>" rel="next">
                                <span class="nav-subtitle"><?php esc_html_e('Ďalší:', 'socialne-inovacie'); ?></span>
                                <span class="nav-title"><?php echo esc_html(get_the_title($next_post)); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </nav>

            <!-- Related Posts -->
            <?php
            $related_posts = new WP_Query(array(
                'post_type' => get_post_type(),
                'posts_per_page' => 3,
                'post__not_in' => array(get_the_ID()),
                'orderby' => 'rand'
            ));
            
            if ($related_posts->have_posts()) :
            ?>
                <section class="related-posts" aria-labelledby="related-heading">
                    <h2 id="related-heading"><?php esc_html_e('Súvisiace príspevky', 'socialne-inovacie'); ?></h2>
                    <div class="card-grid">
                        <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                            <article class="content-card">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="card-image">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('medium'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <div class="card-content">
                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 20)); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="read-more">
                                        <?php esc_html_e('Čítať viac', 'socialne-inovacie'); ?> →
                                    </a>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>
                </section>
            <?php
                wp_reset_postdata();
            endif;
            ?>

        <?php endwhile; ?>

    </div>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
