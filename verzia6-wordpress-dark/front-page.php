<?php get_header(); ?>

<main id="main" class="site-main" role="main">
    <div class="container">
        
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-content">
                <h1 class="hero-title">
                    <?php esc_html_e('Sociálne inovácie', 'socialneinovacie-dark'); ?>
                </h1>
                <p class="hero-description">
                    <?php esc_html_e('Digitálna transformácia a inovatívne riešenia pre lepšiu budúcnosť Slovenska', 'socialneinovacie-dark'); ?>
                </p>
                <div class="hero-actions">
                    <a href="#aktuality" class="btn btn-primary">
                        <i class="fas fa-rocket"></i>
                        <?php esc_html_e('Preskúmať', 'socialneinovacie-dark'); ?>
                    </a>
                    <a href="<?php echo esc_url(home_url('/vyzvy/')); ?>" class="btn btn-secondary">
                        <i class="fas fa-bullhorn"></i>
                        <?php esc_html_e('Aktívne výzvy', 'socialneinovacie-dark'); ?>
                    </a>
                </div>
            </div>
        </section>

        <!-- Content Cards Grid -->
        <div class="card-grid" id="aktuality">
            
            <!-- Aktuality Card -->
            <article class="content-card">
                <div class="card-header">
                    <h2 class="card-title">
                        <div class="card-icon aktuality">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <?php esc_html_e('Aktuality', 'socialneinovacie-dark'); ?>
                    </h2>
                </div>
                <div class="card-content">
                    <div class="card-meta">
                        <span class="card-date">
                            <i class="far fa-calendar-alt"></i>
                            <?php
                            $aktuality_count = wp_count_posts('aktuality');
                            echo esc_html($aktuality_count->publish . ' príspevkov');
                            ?>
                        </span>
                        <span class="card-status"><?php esc_html_e('Aktívne', 'socialneinovacie-dark'); ?></span>
                    </div>
                    <p class="card-description">
                        <?php esc_html_e('Najnovšie informácie o sociálnych inováciách, projektoch a iniciatívach. Sledujte aktuálne dianie v oblasti sociálneho podnikania a digitálnej transformácie.', 'socialneinovacie-dark'); ?>
                    </p>
                    
                    <!-- Recent Aktuality -->
                    <?php
                    $recent_aktuality = new WP_Query(array(
                        'post_type' => 'aktuality',
                        'posts_per_page' => 2,
                        'post_status' => 'publish'
                    ));
                    
                    if ($recent_aktuality->have_posts()) :
                        echo '<div class="recent-posts">';
                        while ($recent_aktuality->have_posts()) : $recent_aktuality->the_post();
                            echo '<div class="recent-post-item">';
                            echo '<h4><a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_title()) . '</a></h4>';
                            echo '<span class="post-date">' . esc_html(get_the_date()) . '</span>';
                            echo '</div>';
                        endwhile;
                        echo '</div>';
                        wp_reset_postdata();
                    endif;
                    ?>
                    
                    <a href="<?php echo esc_url(home_url('/aktuality/')); ?>" class="card-link">
                        <?php esc_html_e('Zobraziť všetky', 'socialneinovacie-dark'); ?>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </article>

            <!-- Výzvy Card -->
            <article class="content-card">
                <div class="card-header">
                    <h2 class="card-title">
                        <div class="card-icon vyzvy">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <?php esc_html_e('Výzvy', 'socialneinovacie-dark'); ?>
                    </h2>
                </div>
                <div class="card-content">
                    <div class="card-meta">
                        <span class="card-date">
                            <i class="far fa-clock"></i>
                            <?php
                            $active_vyzvy = new WP_Query(array(
                                'post_type' => 'vyzvy',
                                'meta_query' => array(
                                    array(
                                        'key' => '_vyzvy_status',
                                        'value' => 'otvorena',
                                        'compare' => '='
                                    )
                                )
                            ));
                            echo esc_html($active_vyzvy->found_posts . ' aktívnych');
                            wp_reset_postdata();
                            ?>
                        </span>
                        <span class="card-status"><?php esc_html_e('Otvorené', 'socialneinovacie-dark'); ?></span>
                    </div>
                    <p class="card-description">
                        <?php esc_html_e('Aktuálne otvorené výzvy na predkladanie projektových návrhov. Získajte finančnú podporu pre vaše inovatívne riešenia v oblasti digitalizácie.', 'socialneinovacie-dark'); ?>
                    </p>
                    
                    <!-- Recent Výzvy -->
                    <?php
                    $recent_vyzvy = new WP_Query(array(
                        'post_type' => 'vyzvy',
                        'posts_per_page' => 2,
                        'post_status' => 'publish',
                        'meta_query' => array(
                            array(
                                'key' => '_vyzvy_status',
                                'value' => 'otvorena',
                                'compare' => '='
                            )
                        )
                    ));
                    
                    if ($recent_vyzvy->have_posts()) :
                        echo '<div class="recent-posts">';
                        while ($recent_vyzvy->have_posts()) : $recent_vyzvy->the_post();
                            $deadline = get_post_meta(get_the_ID(), '_vyzvy_deadline', true);
                            echo '<div class="recent-post-item">';
                            echo '<h4><a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_title()) . '</a></h4>';
                            if ($deadline) {
                                echo '<span class="post-deadline">Deadline: ' . esc_html(date('d.m.Y', strtotime($deadline))) . '</span>';
                            }
                            echo '</div>';
                        endwhile;
                        echo '</div>';
                        wp_reset_postdata();
                    endif;
                    ?>
                    
                    <a href="<?php echo esc_url(home_url('/vyzvy/')); ?>" class="card-link">
                        <?php esc_html_e('Prezrieť výzvy', 'socialneinovacie-dark'); ?>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </article>

            <!-- Podujatia Card -->
            <article class="content-card">
                <div class="card-header">
                    <h2 class="card-title">
                        <div class="card-icon podujatia">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <?php esc_html_e('Podujatia', 'socialneinovacie-dark'); ?>
                    </h2>
                </div>
                <div class="card-content">
                    <div class="card-meta">
                        <span class="card-date">
                            <i class="far fa-calendar-alt"></i>
                            <?php
                            $upcoming_events = new WP_Query(array(
                                'post_type' => 'podujatia',
                                'meta_query' => array(
                                    array(
                                        'key' => '_podujatia_date',
                                        'value' => date('Y-m-d H:i:s'),
                                        'compare' => '>='
                                    )
                                )
                            ));
                            echo esc_html($upcoming_events->found_posts . ' nadchádzajúce');
                            wp_reset_postdata();
                            ?>
                        </span>
                        <span class="card-status"><?php esc_html_e('Registrácia', 'socialneinovacie-dark'); ?></span>
                    </div>
                    <p class="card-description">
                        <?php esc_html_e('Vzdelávacie workshopy, tech konferencie a networking podujatia. Rozvíjajte svoje znalosti v oblasti AI, blockchain a sociálnych inovácií.', 'socialneinovacie-dark'); ?>
                    </p>
                    
                    <!-- Recent Podujatia -->
                    <?php
                    $recent_podujatia = new WP_Query(array(
                        'post_type' => 'podujatia',
                        'posts_per_page' => 2,
                        'post_status' => 'publish',
                        'meta_query' => array(
                            array(
                                'key' => '_podujatia_date',
                                'value' => date('Y-m-d H:i:s'),
                                'compare' => '>='
                            )
                        ),
                        'meta_key' => '_podujatia_date',
                        'orderby' => 'meta_value',
                        'order' => 'ASC'
                    ));
                    
                    if ($recent_podujatia->have_posts()) :
                        echo '<div class="recent-posts">';
                        while ($recent_podujatia->have_posts()) : $recent_podujatia->the_post();
                            $event_date = get_post_meta(get_the_ID(), '_podujatia_date', true);
                            $location = get_post_meta(get_the_ID(), '_podujatia_location', true);
                            echo '<div class="recent-post-item">';
                            echo '<h4><a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_title()) . '</a></h4>';
                            if ($event_date) {
                                echo '<span class="post-date">' . esc_html(date('d.m.Y H:i', strtotime($event_date))) . '</span>';
                            }
                            if ($location) {
                                echo '<span class="post-location">' . esc_html($location) . '</span>';
                            }
                            echo '</div>';
                        endwhile;
                        echo '</div>';
                        wp_reset_postdata();
                    endif;
                    ?>
                    
                    <a href="<?php echo esc_url(home_url('/podujatia/')); ?>" class="card-link">
                        <?php esc_html_e('Prihlásiť sa', 'socialneinovacie-dark'); ?>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </article>
        </div>

        <!-- Features Section -->
        <section class="features-section">
            <h2 class="features-title"><?php esc_html_e('Dark Mode Features', 'socialneinovacie-dark'); ?></h2>
            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-moon"></i>
                    </div>
                    <h3 class="feature-title"><?php esc_html_e('Dark Theme', 'socialneinovacie-dark'); ?></h3>
                    <p class="feature-description">
                        <?php esc_html_e('Profesionálny dark mode dizajn s cyan neon akcentmi', 'socialneinovacie-dark'); ?>
                    </p>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-magic"></i>
                    </div>
                    <h3 class="feature-title"><?php esc_html_e('Glow Effects', 'socialneinovacie-dark'); ?></h3>
                    <p class="feature-description">
                        <?php esc_html_e('Cyberpunk štýl s glow efektmi a gradient pozadiami', 'socialneinovacie-dark'); ?>
                    </p>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3 class="feature-title"><?php esc_html_e('Eye Comfort', 'socialneinovacie-dark'); ?></h3>
                    <p class="feature-description">
                        <?php esc_html_e('Optimalizované pre dlhodobé používanie bez únavy očí', 'socialneinovacie-dark'); ?>
                    </p>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3 class="feature-title"><?php esc_html_e('Performance', 'socialneinovacie-dark'); ?></h3>
                    <p class="feature-description">
                        <?php esc_html_e('Hardware-accelerated animations a smooth transitions', 'socialneinovacie-dark'); ?>
                    </p>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <h3 class="feature-title"><?php esc_html_e('Developer Friendly', 'socialneinovacie-dark'); ?></h3>
                    <p class="feature-description">
                        <?php esc_html_e('Monospace fonts a syntax highlighting ready', 'socialneinovacie-dark'); ?>
                    </p>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-universal-access"></i>
                    </div>
                    <h3 class="feature-title"><?php esc_html_e('Accessibility', 'socialneinovacie-dark'); ?></h3>
                    <p class="feature-description">
                        <?php esc_html_e('WCAG 2.1 AA compliance aj v dark mode', 'socialneinovacie-dark'); ?>
                    </p>
                </div>
            </div>
        </section>

        <!-- Statistics Section -->
        <section class="stats-section">
            <h2 class="stats-title"><?php esc_html_e('Štatistiky platformy', 'socialneinovacie-dark'); ?></h2>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">
                        <?php echo esc_html(wp_count_posts('aktuality')->publish); ?>
                    </div>
                    <div class="stat-label"><?php esc_html_e('Aktuality', 'socialneinovacie-dark'); ?></div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-number">
                        <?php echo esc_html(wp_count_posts('vyzvy')->publish); ?>
                    </div>
                    <div class="stat-label"><?php esc_html_e('Výzvy', 'socialneinovacie-dark'); ?></div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-number">
                        <?php echo esc_html(wp_count_posts('podujatia')->publish); ?>
                    </div>
                    <div class="stat-label"><?php esc_html_e('Podujatia', 'socialneinovacie-dark'); ?></div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-number">100%</div>
                    <div class="stat-label"><?php esc_html_e('NASES Compliance', 'socialneinovacie-dark'); ?></div>
                </div>
            </div>
        </section>

    </div>
</main>

<!-- Additional Styles for Front Page -->
<style>
.hero-section {
    text-align: center;
    padding: var(--space-3xl) 0;
    background: var(--bg-card);
    border-radius: var(--border-radius-xl);
    margin-bottom: var(--space-3xl);
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: var(--gradient-accent);
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 900;
    background: var(--gradient-accent);
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: var(--space-lg);
    text-shadow: var(--shadow-glow);
}

.hero-description {
    font-size: 1.25rem;
    color: var(--text-secondary);
    margin-bottom: var(--space-2xl);
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.hero-actions {
    display: flex;
    gap: var(--space-lg);
    justify-content: center;
    flex-wrap: wrap;
}

.recent-posts {
    background: rgba(0, 245, 255, 0.02);
    border-radius: var(--border-radius);
    padding: var(--space-lg);
    margin: var(--space-lg) 0;
    border: 1px solid var(--border-color);
}

.recent-post-item {
    padding: var(--space-sm) 0;
    border-bottom: 1px solid var(--border-color);
}

.recent-post-item:last-child {
    border-bottom: none;
}

.recent-post-item h4 {
    font-size: 0.95rem;
    margin: 0 0 var(--space-xs) 0;
}

.recent-post-item h4 a {
    color: var(--text-primary);
    transition: all 0.2s ease;
}

.recent-post-item h4 a:hover {
    color: var(--accent);
}

.post-date, .post-deadline, .post-location {
    font-size: 0.8rem;
    color: var(--text-muted);
    font-family: var(--font-mono);
    display: block;
}

.post-deadline {
    color: var(--warning);
}

.stats-section {
    background: var(--bg-card);
    border-radius: var(--border-radius-xl);
    padding: var(--space-3xl);
    margin: var(--space-3xl) 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.stats-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: var(--gradient-accent);
}

.stats-title {
    margin-bottom: var(--space-2xl);
    color: var(--text-primary);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: var(--space-xl);
}

.stat-item {
    padding: var(--space-xl);
    background: rgba(0, 245, 255, 0.02);
    border-radius: var(--border-radius-lg);
    border: 1px solid var(--border-color);
    transition: all 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-4px);
    border-color: var(--accent);
    box-shadow: var(--shadow-glow);
}

.stat-number {
    font-size: 3rem;
    font-weight: 900;
    background: var(--gradient-accent);
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: var(--space-sm);
    font-family: var(--font-mono);
}

.stat-label {
    color: var(--text-secondary);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    font-size: 0.875rem;
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: var(--space-lg);
    }
    
    .stat-number {
        font-size: 2rem;
    }
}
</style>

<?php get_footer(); ?>
