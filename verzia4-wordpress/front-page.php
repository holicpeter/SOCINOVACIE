<?php
/**
 * Template Name: Hlavná stránka
 * 
 * Front page template for Sociálne inovácie
 */

get_header(); ?>

<main id="main-content" class="site-main" role="main">
    <div class="container">
        
        <!-- Hero Section -->
        <section class="hero-section" aria-labelledby="hero-heading">
            <div class="hero-content">
                <h1 id="hero-heading" class="hero-title">
                    <?php esc_html_e('Sociálne inovácie', 'socialne-inovacie'); ?>
                </h1>
                <p class="hero-subtitle">
                    <?php esc_html_e('Podporujeme inovatívne riešenia pre sociálne výzvy a zlepšovanie kvality života občanov Slovenskej republiky', 'socialne-inovacie'); ?>
                </p>
                <div class="hero-actions">
                    <a href="<?php echo esc_url(home_url('/vyzvy')); ?>" class="btn btn-primary">
                        <?php esc_html_e('Aktuálne výzvy', 'socialne-inovacie'); ?>
                    </a>
                    <a href="<?php echo esc_url(home_url('/o-nas')); ?>" class="btn btn-secondary">
                        <?php esc_html_e('Viac informácií', 'socialne-inovacie'); ?>
                    </a>
                </div>
            </div>
            <div class="hero-image">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/images/hero-social-innovation.jpg'); ?>" 
                     alt="<?php esc_attr_e('Sociálne inovácie - ilustračný obrázok', 'socialne-inovacie'); ?>"
                     width="600" height="400">
            </div>
        </section>

        <!-- Statistics Section -->
        <section class="stats-section" aria-labelledby="stats-heading">
            <h2 id="stats-heading" class="section-title">
                <?php esc_html_e('Naše výsledky', 'socialne-inovacie'); ?>
            </h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">150+</div>
                    <div class="stat-label"><?php esc_html_e('Podporených projektov', 'socialne-inovacie'); ?></div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">€2.5M</div>
                    <div class="stat-label"><?php esc_html_e('Celková podpora', 'socialne-inovacie'); ?></div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">50+</div>
                    <div class="stat-label"><?php esc_html_e('Partnerskích organizácií', 'socialne-inovacie'); ?></div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">25000+</div>
                    <div class="stat-label"><?php esc_html_e('Ovplyvnených životov', 'socialne-inovacie'); ?></div>
                </div>
            </div>
        </section>

        <!-- Latest News Section -->
        <section class="latest-news" aria-labelledby="aktuality-heading">
            <div class="section-header">
                <h2 id="aktuality-heading" class="section-title">
                    <i class="fas fa-newspaper" aria-hidden="true"></i>
                    <?php esc_html_e('AKTUALITY', 'socialne-inovacie'); ?>
                </h2>
                <a href="<?php echo esc_url(home_url('/aktuality')); ?>" class="section-link">
                    <?php esc_html_e('Všetky aktuality', 'socialne-inovacie'); ?> →
                </a>
            </div>

            <div class="card-grid">
                <?php
                $aktuality = new WP_Query(array(
                    'post_type' => 'aktuality',
                    'posts_per_page' => 3,
                    'meta_key' => '_thumbnail_id'
                ));

                if ($aktuality->have_posts()) :
                    while ($aktuality->have_posts()) : $aktuality->the_post();
                ?>
                <article class="content-card category-aktuality">
                    <div class="card-with-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'card-thumbnail')); ?>" 
                                 alt="<?php echo esc_attr(get_the_title()); ?>"
                                 class="card-image">
                        <?php else : ?>
                            <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=120&h=80&fit=crop&crop=faces" 
                                 alt="<?php echo esc_attr(get_the_title()); ?>"
                                 class="card-image">
                        <?php endif; ?>
                        
                        <div class="card-content">
                            <div class="card-meta">
                                <span class="card-badge"><?php esc_html_e('AKTUALITY', 'socialne-inovacie'); ?></span>
                                <div class="card-date">
                                    <i class="fas fa-calendar" aria-hidden="true"></i>
                                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                        <?php echo esc_html(get_the_date('j.n.Y')); ?>
                                    </time>
                                </div>
                            </div>
                            <h3 class="card-title-small">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <p class="card-description-small"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 15)); ?></p>
                        </div>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="card-link-small">
                        <?php esc_html_e('Čítať viac', 'socialne-inovacie'); ?>
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                <!-- Fallback content if no posts -->
                <article class="content-card category-aktuality">
                    <div class="card-with-image">
                        <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=120&h=80&fit=crop&crop=faces" 
                             alt="Ukážková aktualita" class="card-image">
                        <div class="card-content">
                            <div class="card-meta">
                                <span class="card-badge">AKTUALITY</span>
                                <div class="card-date">
                                    <i class="fas fa-calendar"></i>
                                    <?php echo esc_html(date('j.n.Y')); ?>
                                </div>
                            </div>
                            <h3 class="card-title-small">Spustenie novej výzvy na podporu sociálnych inovácií</h3>
                            <p class="card-description-small">Ministerstvo práce, sociálnych vecí a rodiny vyhlasuje novú výzvu zameranú na podporu inovatívnych projektov...</p>
                        </div>
                    </div>
                    <a href="#" class="card-link-small">
                        Čítať viac <i class="fas fa-arrow-right"></i>
                    </a>
                </article>
                <?php endif; ?>
            </div>
        </section>

        <!-- Active Calls Section -->
        <section class="active-calls" aria-labelledby="vyzvy-heading">
            <div class="section-header">
                <h2 id="vyzvy-heading" class="section-title">
                    <i class="fas fa-bullhorn" aria-hidden="true"></i>
                    <?php esc_html_e('VÝZVY', 'socialne-inovacie'); ?>
                </h2>
                <a href="<?php echo esc_url(home_url('/vyzvy')); ?>" class="section-link">
                    <?php esc_html_e('Všetky výzvy', 'socialne-inovacie'); ?> →
                </a>
            </div>

            <div class="card-grid">
                <?php
                $vyzvy = new WP_Query(array(
                    'post_type' => 'vyzvy',
                    'posts_per_page' => 3,
                    'meta_query' => array(
                        array(
                            'key' => '_vyzva_status',
                            'value' => 'Aktívna',
                            'compare' => '='
                        )
                    )
                ));

                if ($vyzvy->have_posts()) :
                    while ($vyzvy->have_posts()) : $vyzvy->the_post();
                        $amount = get_post_meta(get_the_ID(), '_vyzva_amount', true);
                        $status = get_post_meta(get_the_ID(), '_vyzva_status', true);
                        $deadline = get_post_meta(get_the_ID(), '_vyzva_deadline', true);
                ?>
                <article class="content-card category-vyzvy">
                    <div class="card-with-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'card-thumbnail')); ?>" 
                                 alt="<?php echo esc_attr(get_the_title()); ?>"
                                 class="card-image">
                        <?php else : ?>
                            <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=120&h=80&fit=crop" 
                                 alt="<?php echo esc_attr(get_the_title()); ?>"
                                 class="card-image">
                        <?php endif; ?>
                        
                        <div class="card-content">
                            <div class="card-meta">
                                <span class="card-badge"><?php esc_html_e('VÝZVY', 'socialne-inovacie'); ?></span>
                                <?php if ($deadline) : ?>
                                <div class="card-date">
                                    <i class="fas fa-calendar" aria-hidden="true"></i>
                                    <time datetime="<?php echo esc_attr($deadline); ?>">
                                        <?php echo esc_html(date('j.n.Y', strtotime($deadline))); ?>
                                    </time>
                                </div>
                                <?php endif; ?>
                            </div>
                            <h3 class="card-title-small">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <p class="card-description-small"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 15)); ?></p>
                        </div>
                    </div>
                    
                    <div style="display: flex; flex-wrap: wrap; gap: 1rem; font-size: 0.85rem; margin-bottom: 1rem;">
                        <?php if ($status) : ?>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-circle" style="color: var(--success-green); font-size: 0.6rem;" aria-hidden="true"></i>
                            <?php echo esc_html($status); ?>
                        </div>
                        <?php endif; ?>
                        <?php if ($amount) : ?>
                        <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-secondary);">
                            <i class="fas fa-euro-sign" aria-hidden="true"></i>
                            <?php echo esc_html($amount); ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <a href="<?php the_permalink(); ?>" class="card-link-small">
                        <?php esc_html_e('Zobraziť výzvu', 'socialne-inovacie'); ?>
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                <!-- Fallback content -->
                <article class="content-card category-vyzvy">
                    <div class="card-with-image">
                        <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=120&h=80&fit=crop" 
                             alt="Ukážková výzva" class="card-image">
                        <div class="card-content">
                            <div class="card-meta">
                                <span class="card-badge">VÝZVY</span>
                                <div class="card-date">
                                    <i class="fas fa-calendar"></i>
                                    <?php echo esc_html(date('j.n.Y', strtotime('+30 days'))); ?>
                                </div>
                            </div>
                            <h3 class="card-title-small">Podpora inovácií v sociálnych službách 2024</h3>
                            <p class="card-description-small">Výzva na predkladanie projektov zameraných na inovácie v oblasti sociálnych služieb pre seniorov...</p>
                        </div>
                    </div>
                    <div style="display: flex; flex-wrap: wrap; gap: 1rem; font-size: 0.85rem; margin-bottom: 1rem;">
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-circle" style="color: var(--success-green); font-size: 0.6rem;"></i>
                            Aktívna
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-secondary);">
                            <i class="fas fa-euro-sign"></i>
                            €500 000
                        </div>
                    </div>
                    <a href="#" class="card-link-small">
                        Zobraziť výzvu <i class="fas fa-arrow-right"></i>
                    </a>
                </article>
                <?php endif; ?>
            </div>
        </section>

        <!-- Upcoming Events Section -->
        <section class="upcoming-events" aria-labelledby="podujatia-heading">
            <div class="section-header">
                <h2 id="podujatia-heading" class="section-title">
                    <i class="fas fa-calendar-check" aria-hidden="true"></i>
                    <?php esc_html_e('PODUJATIA', 'socialne-inovacie'); ?>
                </h2>
                <a href="<?php echo esc_url(home_url('/podujatia')); ?>" class="section-link">
                    <?php esc_html_e('Všetky podujatia', 'socialne-inovacie'); ?> →
                </a>
            </div>

            <div class="card-grid">
                <?php
                $podujatia = new WP_Query(array(
                    'post_type' => 'podujatia',
                    'posts_per_page' => 3,
                    'meta_key' => '_podujatie_date',
                    'orderby' => 'meta_value',
                    'order' => 'ASC',
                    'meta_query' => array(
                        array(
                            'key' => '_podujatie_date',
                            'value' => date('Y-m-d'),
                            'compare' => '>='
                        )
                    )
                ));

                if ($podujatia->have_posts()) :
                    while ($podujatia->have_posts()) : $podujatia->the_post();
                        $location = get_post_meta(get_the_ID(), '_podujatie_location', true);
                        $event_date = get_post_meta(get_the_ID(), '_podujatie_date', true);
                        $time = get_post_meta(get_the_ID(), '_podujatie_time', true);
                ?>
                <article class="content-card category-podujatia">
                    <div class="card-with-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'card-thumbnail')); ?>" 
                                 alt="<?php echo esc_attr(get_the_title()); ?>"
                                 class="card-image">
                        <?php else : ?>
                            <img src="https://images.unsplash.com/photo-1531058020387-3be344556be6?w=120&h=80&fit=crop" 
                                 alt="<?php echo esc_attr(get_the_title()); ?>"
                                 class="card-image">
                        <?php endif; ?>
                        
                        <div class="card-content">
                            <div class="card-meta">
                                <span class="card-badge"><?php esc_html_e('PODUJATIA', 'socialne-inovacie'); ?></span>
                                <?php if ($event_date) : ?>
                                <div class="card-date">
                                    <i class="fas fa-calendar" aria-hidden="true"></i>
                                    <time datetime="<?php echo esc_attr($event_date); ?>">
                                        <?php echo esc_html(date('j.n.Y', strtotime($event_date))); ?>
                                    </time>
                                </div>
                                <?php endif; ?>
                            </div>
                            <h3 class="card-title-small">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <p class="card-description-small"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 15)); ?></p>
                        </div>
                    </div>
                    
                    <div style="display: flex; flex-wrap: wrap; gap: 1rem; font-size: 0.85rem; margin-bottom: 1rem;">
                        <?php if ($location) : ?>
                        <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-secondary);">
                            <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                            <?php echo esc_html($location); ?>
                        </div>
                        <?php endif; ?>
                        <?php if ($time) : ?>
                        <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-secondary);">
                            <i class="fas fa-clock" aria-hidden="true"></i>
                            <?php echo esc_html($time); ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <a href="<?php the_permalink(); ?>" class="card-link-small">
                        <?php esc_html_e('Viac o podujatí', 'socialne-inovacie'); ?>
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                <!-- Fallback content -->
                <article class="content-card category-podujatia">
                    <div class="card-with-image">
                        <img src="https://images.unsplash.com/photo-1531058020387-3be344556be6?w=120&h=80&fit=crop" 
                             alt="Ukážkové podujatie" class="card-image">
                        <div class="card-content">
                            <div class="card-meta">
                                <span class="card-badge">PODUJATIA</span>
                                <div class="card-date">
                                    <i class="fas fa-calendar"></i>
                                    <?php echo esc_html(date('j.n.Y', strtotime('+14 days'))); ?>
                                </div>
                            </div>
                            <h3 class="card-title-small">Workshop: Design thinking v sociálnych službách</h3>
                            <p class="card-description-small">Praktický workshop zameraný na využitie design thinking metodológie pri navrhovaní sociálnych služieb...</p>
                        </div>
                    </div>
                    <div style="display: flex; flex-wrap: wrap; gap: 1rem; font-size: 0.85rem; margin-bottom: 1rem;">
                        <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-secondary);">
                            <i class="fas fa-map-marker-alt"></i>
                            Bratislava
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-secondary);">
                            <i class="fas fa-clock"></i>
                            09:00
                        </div>
                    </div>
                    <a href="#" class="card-link-small">
                        Viac o podujatí <i class="fas fa-arrow-right"></i>
                    </a>
                </article>
                <?php endif; ?>
            </div>
        </section>

        <!-- Call to Action Section -->
        <section class="cta-section" aria-labelledby="cta-heading">
            <div class="cta-content">
                <h2 id="cta-heading"><?php esc_html_e('Máte nápad na sociálnu inováciu?', 'socialne-inovacie'); ?></h2>
                <p><?php esc_html_e('Podporíme vás pri realizácii vašich inovatívnych nápadov. Prečítajte si viac o možnostiach financovania a podporte.', 'socialne-inovacie'); ?></p>
                <div class="cta-actions">
                    <a href="<?php echo esc_url(home_url('/vyzvy')); ?>" class="btn btn-primary">
                        <?php esc_html_e('Pozrieť výzvy', 'socialne-inovacie'); ?>
                    </a>
                    <a href="<?php echo esc_url(home_url('/kontakt')); ?>" class="btn btn-secondary">
                        <?php esc_html_e('Kontaktovať nás', 'socialne-inovacie'); ?>
                    </a>
                </div>
            </div>
        </section>

    </div>
</main>

<?php get_footer(); ?>
