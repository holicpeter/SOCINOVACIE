<?php
/**
 * Main index template
 */

get_header(); ?>

<main id="main-content" class="site-main" role="main">
    <div class="container">
        
        <?php if (have_posts()) : ?>
            
            <header class="page-header">
                <?php if (is_home() && !is_front_page()) : ?>
                    <h1 class="page-title"><?php esc_html_e('Najnovšie príspevky', 'socialne-inovacie'); ?></h1>
                <?php elseif (is_archive()) : ?>
                    <h1 class="page-title"><?php the_archive_title(); ?></h1>
                    <?php the_archive_description('<div class="archive-description">', '</div>'); ?>
                <?php elseif (is_search()) : ?>
                    <h1 class="page-title">
                        <?php
                        printf(
                            esc_html__('Výsledky vyhľadávania pre: %s', 'socialne-inovacie'),
                            '<span>' . get_search_query() . '</span>'
                        );
                        ?>
                    </h1>
                <?php endif; ?>
            </header>

            <div class="posts-container">
                <?php while (have_posts()) : the_post(); ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class('content-card'); ?>>
                        
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                                    <?php the_post_thumbnail('medium', array('alt' => get_the_title())); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="post-content">
                            <header class="entry-header">
                                <div class="entry-meta">
                                    <span class="posted-on">
                                        <i class="fas fa-calendar" aria-hidden="true"></i>
                                        <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                            <?php echo esc_html(get_the_date('j.n.Y')); ?>
                                        </time>
                                    </span>
                                    
                                    <?php if (get_post_type() !== 'post') : ?>
                                        <span class="post-type-badge">
                                            <?php echo esc_html(get_post_type_object(get_post_type())->labels->singular_name); ?>
                                        </span>
                                    <?php endif; ?>
                                    
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
                                
                                <?php if (is_singular()) : ?>
                                    <h1 class="entry-title"><?php the_title(); ?></h1>
                                <?php else : ?>
                                    <h2 class="entry-title">
                                        <a href="<?php the_permalink(); ?>" rel="bookmark">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>
                                <?php endif; ?>
                            </header>

                            <div class="entry-content">
                                <?php
                                if (is_singular()) {
                                    the_content();
                                } else {
                                    echo '<p>' . esc_html(wp_trim_words(get_the_excerpt(), 30)) . '</p>';
                                    echo '<a href="' . esc_url(get_permalink()) . '" class="read-more">' . esc_html__('Čítať viac', 'socialne-inovacie') . ' →</a>';
                                }
                                ?>
                            </div>

                            <?php if (is_singular()) : ?>
                                <footer class="entry-footer">
                                    <?php
                                    $tags = get_the_tags();
                                    if ($tags) :
                                    ?>
                                        <div class="tag-links">
                                            <i class="fas fa-tags" aria-hidden="true"></i>
                                            <?php foreach ($tags as $tag) : ?>
                                                <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="tag">
                                                    <?php echo esc_html($tag->name); ?>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </footer>
                            <?php endif; ?>
                        </div>
                    </article>

                <?php endwhile; ?>
                
                <!-- Pagination -->
                <nav class="pagination-nav" aria-label="<?php esc_attr_e('Stránkovanie príspevkov', 'socialne-inovacie'); ?>">
                    <?php
                    the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => '<i class="fas fa-chevron-left" aria-hidden="true"></i> ' . esc_html__('Predchádzajúce', 'socialne-inovacie'),
                        'next_text' => esc_html__('Ďalšie', 'socialne-inovacie') . ' <i class="fas fa-chevron-right" aria-hidden="true"></i>',
                    ));
                    ?>
                </nav>

            </div>

        <?php else : ?>
            
            <section class="no-results not-found">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e('Nič sa nenašlo', 'socialne-inovacie'); ?></h1>
                </header>

                <div class="page-content">
                    <?php if (is_home() && current_user_can('publish_posts')) : ?>
                        <p>
                            <?php
                            printf(
                                wp_kses(
                                    __('Pripravený na publikovanie vášho prvého príspevku? <a href="%1$s">Začnite tu</a>.', 'socialne-inovacie'),
                                    array('a' => array('href' => array()))
                                ),
                                esc_url(admin_url('post-new.php'))
                            );
                            ?>
                        </p>
                    <?php elseif (is_search()) : ?>
                        <p><?php esc_html_e('Ľutujeme, ale nič nezodpovedá vašim kritériám vyhľadávania. Skúste to znovu s inými kľúčovými slovami.', 'socialne-inovacie'); ?></p>
                        <?php get_search_form(); ?>
                    <?php else : ?>
                        <p><?php esc_html_e('Zdá sa, že tu nemôžeme nájsť to, čo hľadáte. Možno vám pomôže vyhľadávanie.', 'socialne-inovacie'); ?></p>
                        <?php get_search_form(); ?>
                    <?php endif; ?>
                </div>
            </section>

        <?php endif; ?>

    </div>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
