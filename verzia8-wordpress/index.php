<?php
/**
 * Main template file - Sociálne Inovácie v8
 * Based on version 1 light mode design
 */

get_header(); ?>

<!-- Hero Section -->
<section class="hero" aria-labelledby="hero-title">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h1 id="hero-title" class="display-4 fw-bold mb-4">
                    <?php echo get_theme_mod('hero_title', 'SOCIÁLNE INOVÁCIE'); ?>
                </h1>
                <p class="lead mb-4">
                    <?php echo get_theme_mod('hero_subtitle', 'Podporujeme inovačné riešenia pre lepšiu budúcnosť Slovenska'); ?>
                </p>
                <div class="definition-boxes">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">
                                        <i class="fas fa-lightbulb me-2" aria-hidden="true"></i>
                                        Čo sú sociálne inovácie
                                    </h5>
                                    <p class="card-text">Sociálne inovácie sú nové riešenia (produkty, služby, modely, trhy, procesy a pod.), ktoré súčasne napĺňajú sociálne potreby a vytvárajú nové sociálne vzťahy alebo spoluprácu.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">
                                        <i class="fas fa-users me-2" aria-hidden="true"></i>
                                        Naša misia
                                    </h5>
                                    <p class="card-text">Národné kompetenčné centrum pre sociálne inovácie spája odborníkov, akademickú obec, neziskové a miestne organizácie s cieľom zlepšenia podpory projektov.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<main id="main-content" role="main">
    <div class="container">
        <div class="row">
            <!-- Main content area -->
            <div class="col-lg-8">
                
                <!-- About Section -->
                <section class="mb-5" aria-labelledby="about-title">
                    <h2 id="about-title" class="h3 mb-4 text-primary">
                        <i class="fas fa-info-circle me-2" aria-hidden="true"></i>
                        Oblasti inovácií
                    </h2>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card innovation-card">
                                <div class="card-header">
                                    <i class="fas fa-heart text-danger me-2" aria-hidden="true"></i>
                                    Zdravotníctvo
                                </div>
                                <div class="card-body">
                                    <p class="card-text">Inovačné riešenia v oblasti zdravotnej starostlivosti a podpory pacientov.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card innovation-card">
                                <div class="card-header">
                                    <i class="fas fa-graduation-cap text-success me-2" aria-hidden="true"></i>
                                    Vzdelávanie
                                </div>
                                <div class="card-body">
                                    <p class="card-text">Moderné prístupy k vzdelávaniu a rozvoju ľudských zdrojov.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card innovation-card">
                                <div class="card-header">
                                    <i class="fas fa-home text-warning me-2" aria-hidden="true"></i>
                                    Sociálne bývanie
                                </div>
                                <div class="card-body">
                                    <p class="card-text">Riešenia pre dostupné a kvalitné bývanie pre všetkých.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card innovation-card">
                                <div class="card-header">
                                    <i class="fas fa-leaf text-success me-2" aria-hidden="true"></i>
                                    Udržateľnosť
                                </div>
                                <div class="card-body">
                                    <p class="card-text">Environmentálne a sociálne udržateľné inovačné projekty.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Aktuality Section -->
                <section class="mb-5" aria-labelledby="news-title">
                    <h2 id="news-title" class="h3 mb-4 text-primary">
                        <i class="fas fa-newspaper me-2" aria-hidden="true"></i>
                        Aktuality
                    </h2>
                    <div class="row g-4">
                        <?php
                        $aktuality = new WP_Query(array(
                            'post_type' => 'aktuality',
                            'posts_per_page' => 4,
                            'post_status' => 'publish'
                        ));
                        
                        if ($aktuality->have_posts()) :
                            while ($aktuality->have_posts()) : $aktuality->the_post();
                                $external_link = get_post_meta(get_the_ID(), '_external_link', true);
                                $source = get_post_meta(get_the_ID(), '_source', true);
                        ?>
                            <div class="col-md-6">
                                <article class="news-item">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('news-thumbnail', array('alt' => get_the_title())); ?>
                                    <?php else : ?>
                                        <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?w=80&h=60&fit=crop" 
                                             alt="<?php the_title(); ?>" class="default-thumbnail">
                                    <?php endif; ?>
                                    <div class="news-content">
                                        <h5>
                                            <?php if ($external_link) : ?>
                                                <a href="<?php echo esc_url($external_link); ?>" target="_blank" rel="noopener noreferrer">
                                                    <?php the_title(); ?>
                                                    <i class="fas fa-external-link-alt ms-1" aria-hidden="true"></i>
                                                </a>
                                            <?php else : ?>
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            <?php endif; ?>
                                        </h5>
                                        <div class="news-date">
                                            <i class="fas fa-calendar me-1" aria-hidden="true"></i>
                                            <?php echo get_the_date('j. n. Y'); ?>
                                            <?php if ($source) : ?>
                                                <span class="ms-2">| <?php echo esc_html($source); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <p class="mt-2"><?php echo si_v8_truncate_text(get_the_excerpt(), 80); ?></p>
                                    </div>
                                </article>
                            </div>
                        <?php 
                            endwhile;
                            wp_reset_postdata();
                        else :
                        ?>
                            <div class="col-12">
                                <p class="text-muted">Momentálne nie sú k dispozícii žiadne aktuality.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="text-center mt-4">
                        <a href="<?php echo get_post_type_archive_link('aktuality'); ?>" class="btn btn-outline-primary">
                            Zobraziť všetky aktuality
                            <i class="fas fa-arrow-right ms-1" aria-hidden="true"></i>
                        </a>
                    </div>
                </section>

                <!-- Inšpirácia Section -->
                <section class="mb-5" aria-labelledby="inspiration-title">
                    <h2 id="inspiration-title" class="h3 mb-4 text-primary">
                        <i class="fas fa-lightbulb me-2" aria-hidden="true"></i>
                        Inšpirácia
                    </h2>
                    <div class="row g-4">
                        <?php
                        $inspiracia = new WP_Query(array(
                            'post_type' => 'inspiracia',
                            'posts_per_page' => 3,
                            'post_status' => 'publish'
                        ));
                        
                        if ($inspiracia->have_posts()) :
                            while ($inspiracia->have_posts()) : $inspiracia->the_post();
                        ?>
                            <div class="col-lg-4">
                                <div class="card inspiration-card h-100">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('inspiration-thumbnail', array('class' => 'card-img-top', 'alt' => get_the_title())); ?>
                                        </a>
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                                <?php the_title(); ?>
                                            </a>
                                        </h5>
                                        <p class="card-text"><?php echo si_v8_truncate_text(get_the_excerpt(), 100); ?></p>
                                        <div class="mt-auto">
                                            <small class="text-muted">
                                                <i class="fas fa-calendar me-1" aria-hidden="true"></i>
                                                <?php echo get_the_date('j. n. Y'); ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php 
                            endwhile;
                            wp_reset_postdata();
                        else :
                        ?>
                            <div class="col-12">
                                <p class="text-muted">Momentálne nie sú k dispozícii žiadne projekty inšpirácie.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="text-center mt-4">
                        <a href="<?php echo get_post_type_archive_link('inspiracia'); ?>" class="btn btn-outline-primary">
                            Zobraziť všetky projekty
                            <i class="fas fa-arrow-right ms-1" aria-hidden="true"></i>
                        </a>
                    </div>
                </section>

                <!-- Podujatia Section -->
                <section class="mb-5" aria-labelledby="events-title">
                    <h2 id="events-title" class="h3 mb-4 text-primary">
                        <i class="fas fa-calendar me-2" aria-hidden="true"></i>
                        Nadchádzajúce podujatia
                    </h2>
                    <div class="row g-4">
                        <?php
                        $podujatia = new WP_Query(array(
                            'post_type' => 'podujatia',
                            'posts_per_page' => 2,
                            'post_status' => 'publish',
                            'meta_query' => array(
                                array(
                                    'key' => '_event_date',
                                    'value' => date('Y-m-d'),
                                    'compare' => '>='
                                )
                            ),
                            'meta_key' => '_event_date',
                            'orderby' => 'meta_value',
                            'order' => 'ASC'
                        ));
                        
                        if ($podujatia->have_posts()) :
                            while ($podujatia->have_posts()) : $podujatia->the_post();
                                $event_date = get_post_meta(get_the_ID(), '_event_date', true);
                                $event_location = get_post_meta(get_the_ID(), '_event_location', true);
                                $registration_link = get_post_meta(get_the_ID(), '_registration_link', true);
                        ?>
                            <div class="col-md-6">
                                <div class="card post-card h-100">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('medium', array('class' => 'card-img-top', 'alt' => get_the_title())); ?>
                                        </a>
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                                <?php the_title(); ?>
                                            </a>
                                        </h5>
                                        <div class="custom-post-meta mb-3">
                                            <?php if ($event_date) : ?>
                                                <div class="mb-1">
                                                    <i class="fas fa-calendar text-primary me-1" aria-hidden="true"></i>
                                                    <strong>Dátum:</strong> <?php echo si_v8_format_date($event_date, 'j. n. Y H:i'); ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($event_location) : ?>
                                                <div class="mb-1">
                                                    <i class="fas fa-map-marker-alt text-primary me-1" aria-hidden="true"></i>
                                                    <strong>Miesto:</strong> <?php echo esc_html($event_location); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <p class="card-text"><?php echo si_v8_truncate_text(get_the_excerpt(), 80); ?></p>
                                        <?php if ($registration_link) : ?>
                                            <a href="<?php echo esc_url($registration_link); ?>" class="btn btn-primary btn-sm" target="_blank" rel="noopener noreferrer">
                                                <i class="fas fa-user-plus me-1" aria-hidden="true"></i>
                                                Registrovať sa
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php 
                            endwhile;
                            wp_reset_postdata();
                        else :
                        ?>
                            <div class="col-12">
                                <p class="text-muted">Momentálne nie sú naplánované žiadne podujatia.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="text-center mt-4">
                        <a href="<?php echo get_post_type_archive_link('podujatia'); ?>" class="btn btn-outline-primary">
                            Zobraziť všetky podujatia
                            <i class="fas fa-arrow-right ms-1" aria-hidden="true"></i>
                        </a>
                    </div>
                </section>

            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <aside class="sidebar" role="complementary" aria-label="Bočná navigácia">
                    
                    <!-- Search -->
                    <div class="widget card mb-4">
                        <div class="card-header">
                            <h3 class="card-title mb-0 h5">
                                <i class="fas fa-search me-2" aria-hidden="true"></i>
                                Vyhľadávanie
                            </h3>
                        </div>
                        <div class="card-body">
                            <?php echo socialne_inovacie_v8_search_form(); ?>
                        </div>
                    </div>

                    <!-- Aktuálne výzvy -->
                    <div class="widget card mb-4">
                        <div class="card-header">
                            <h3 class="card-title mb-0 h5">
                                <i class="fas fa-flag me-2" aria-hidden="true"></i>
                                Aktuálne výzvy
                            </h3>
                        </div>
                        <div class="card-body">
                            <?php
                            $vyzvy = new WP_Query(array(
                                'post_type' => 'vyzvy',
                                'posts_per_page' => 3,
                                'post_status' => 'publish',
                                'meta_query' => array(
                                    array(
                                        'key' => '_deadline',
                                        'value' => date('Y-m-d'),
                                        'compare' => '>='
                                    )
                                )
                            ));
                            
                            if ($vyzvy->have_posts()) :
                                while ($vyzvy->have_posts()) : $vyzvy->the_post();
                                    $deadline = get_post_meta(get_the_ID(), '_deadline', true);
                                    $budget = get_post_meta(get_the_ID(), '_budget', true);
                            ?>
                                <div class="mb-3 pb-3 border-bottom">
                                    <h6>
                                        <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                            <?php the_title(); ?>
                                        </a>
                                    </h6>
                                    <?php if ($deadline) : ?>
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1" aria-hidden="true"></i>
                                            Termín: <?php echo si_v8_format_date($deadline); ?>
                                        </small>
                                    <?php endif; ?>
                                    <?php if ($budget) : ?>
                                        <br><small class="text-success">
                                            <i class="fas fa-euro-sign me-1" aria-hidden="true"></i>
                                            <?php echo esc_html($budget); ?>
                                        </small>
                                    <?php endif; ?>
                                </div>
                            <?php 
                                endwhile;
                                wp_reset_postdata();
                            else :
                            ?>
                                <p class="text-muted">Momentálne nie sú k dispozícii žiadne výzvy.</p>
                            <?php endif; ?>
                            <div class="text-center">
                                <a href="<?php echo get_post_type_archive_link('vyzvy'); ?>" class="btn btn-outline-primary btn-sm">
                                    Všetky výzvy
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Widget area -->
                    <?php if (is_active_sidebar('sidebar-vyzvy')) : ?>
                        <?php dynamic_sidebar('sidebar-vyzvy'); ?>
                    <?php endif; ?>

                </aside>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
