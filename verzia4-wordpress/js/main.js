/**
 * Main JavaScript for Sociálne inovácie WordPress Theme
 * NASES compliant accessibility features
 */

(function($) {
    'use strict';
    
    // Initialize when DOM is ready
    $(document).ready(function() {
        initAccessibility();
        initNavigation();
        initBackToTop();
        initSearchFunctionality();
        initCardAnimations();
    });

    /**
     * NASES Accessibility Features
     */
    function initAccessibility() {
        // Skip links functionality
        $('.skip-links a').on('focus', function() {
            $(this).addClass('skip-link-focused');
        }).on('blur', function() {
            $(this).removeClass('skip-link-focused');
        });

        // Focus management for modals and dropdowns
        $(document).on('keydown', function(e) {
            // ESC key closes modals
            if (e.keyCode === 27) {
                $('.mobile-menu-open').removeClass('mobile-menu-open');
                $('.menu-toggle').attr('aria-expanded', 'false').focus();
            }
        });

        // Announce page changes for screen readers
        if (window.history && window.history.pushState) {
            $(window).on('popstate', function() {
                announcePageChange();
            });
        }

        // High contrast mode detection
        if (window.matchMedia && window.matchMedia('(prefers-contrast: high)').matches) {
            $('body').addClass('high-contrast-mode');
        }

        // Reduced motion support
        if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            $('body').addClass('reduced-motion');
        }
    }

    /**
     * Navigation functionality
     */
    function initNavigation() {
        const $menuToggle = $('.menu-toggle');
        const $primaryMenu = $('#primary-menu');
        const $navigation = $('.main-navigation');

        // Mobile menu toggle
        $menuToggle.on('click', function(e) {
            e.preventDefault();
            const isExpanded = $(this).attr('aria-expanded') === 'true';
            
            $(this).attr('aria-expanded', !isExpanded);
            $('body').toggleClass('mobile-menu-open');
            
            if (!isExpanded) {
                // Focus first menu item when opening
                setTimeout(() => {
                    $primaryMenu.find('a').first().focus();
                }, 100);
            }
        });

        // Submenu keyboard navigation
        $primaryMenu.find('a').on('keydown', function(e) {
            const $this = $(this);
            const $parent = $this.parent('li');
            const $submenu = $parent.find('.sub-menu').first();
            
            switch(e.keyCode) {
                case 13: // Enter
                case 32: // Space
                    if ($submenu.length > 0) {
                        e.preventDefault();
                        $submenu.toggleClass('show');
                        $submenu.find('a').first().focus();
                    }
                    break;
                case 37: // Left arrow
                    e.preventDefault();
                    $parent.prev().find('a').first().focus();
                    break;
                case 39: // Right arrow
                    e.preventDefault();
                    $parent.next().find('a').first().focus();
                    break;
                case 40: // Down arrow
                    if ($submenu.length > 0) {
                        e.preventDefault();
                        $submenu.addClass('show');
                        $submenu.find('a').first().focus();
                    }
                    break;
                case 38: // Up arrow
                    if ($this.closest('.sub-menu').length > 0) {
                        e.preventDefault();
                        $this.closest('.sub-menu').removeClass('show');
                        $this.closest('li').find('> a').focus();
                    }
                    break;
            }
        });

        // Close submenus when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.main-navigation').length) {
                $('.sub-menu.show').removeClass('show');
            }
        });
    }

    /**
     * Back to top functionality
     */
    function initBackToTop() {
        const $backToTop = $('#back-to-top');
        
        // Show/hide based on scroll position
        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 300) {
                $backToTop.addClass('visible');
            } else {
                $backToTop.removeClass('visible');
            }
        });

        // Smooth scroll to top
        $backToTop.on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, 600, function() {
                // Focus management - return focus to skip link
                $('.skip-links a').first().focus();
            });
        });
    }

    /**
     * Search functionality
     */
    function initSearchFunctionality() {
        const $searchForm = $('.search-form');
        const $searchInput = $searchForm.find('input[type="search"]');

        // Live search suggestions (if implemented)
        $searchInput.on('input', debounce(function() {
            const query = $(this).val();
            if (query.length > 2) {
                // Implement live search suggestions here
                performLiveSearch(query);
            }
        }, 300));

        // Search form submission tracking
        $searchForm.on('submit', function() {
            const query = $searchInput.val();
            if (query.trim() === '') {
                return false;
            }
            
            // Analytics tracking
            if (typeof gtag !== 'undefined') {
                gtag('event', 'search', {
                    search_term: query
                });
            }
        });
    }

    /**
     * Card animations and interactions
     */
    function initCardAnimations() {
        // Intersection Observer for scroll animations
        if ('IntersectionObserver' in window) {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                    }
                });
            }, observerOptions);

            // Observe content cards
            $('.content-card, .stat-card').each(function() {
                observer.observe(this);
            });
        }

        // Card hover effects (respecting reduced motion)
        $('.content-card').on('mouseenter', function() {
            if (!$('body').hasClass('reduced-motion')) {
                $(this).addClass('hover-effect');
            }
        }).on('mouseleave', function() {
            $(this).removeClass('hover-effect');
        });
    }

    /**
     * Utility functions
     */
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    function performLiveSearch(query) {
        // Implement AJAX live search
        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'live_search',
                query: query,
                nonce: ajax_object.nonce
            },
            success: function(response) {
                // Display search suggestions
                displaySearchSuggestions(response);
            }
        });
    }

    function displaySearchSuggestions(results) {
        // Implementation for search suggestions display
        const $suggestions = $('.search-suggestions');
        if (results.length > 0) {
            $suggestions.html(results).show();
        } else {
            $suggestions.hide();
        }
    }

    function announcePageChange() {
        // Announce page changes for screen readers
        const announcement = 'Stránka bola aktualizovaná';
        const $announcer = $('<div>').attr({
            'aria-live': 'polite',
            'aria-atomic': 'true',
            'class': 'screen-reader-text'
        }).text(announcement);
        
        $('body').append($announcer);
        setTimeout(() => {
            $announcer.remove();
        }, 1000);
    }

    /**
     * WordPress specific functionality
     */
    
    // Comment form enhancements
    if ($('.comment-form').length > 0) {
        $('.comment-form').on('submit', function() {
            const $form = $(this);
            const $submitButton = $form.find('input[type="submit"]');
            
            $submitButton.prop('disabled', true).val('Odosielam...');
            
            // Re-enable after form processing
            setTimeout(() => {
                $submitButton.prop('disabled', false).val('Odoslať komentár');
            }, 2000);
        });
    }

    // Social share tracking
    $('.social-share a').on('click', function() {
        const platform = $(this).attr('aria-label');
        if (typeof gtag !== 'undefined') {
            gtag('event', 'share', {
                method: platform,
                content_type: 'article',
                item_id: $('article').attr('id')
            });
        }
    });

    // Print functionality
    $('.print-button').on('click', function(e) {
        e.preventDefault();
        window.print();
    });

    // Cookie consent (if needed for GDPR compliance)
    function initCookieConsent() {
        if (!localStorage.getItem('cookieConsent')) {
            const $consent = $(`
                <div class="cookie-consent" role="alert" aria-live="assertive">
                    <p>Táto stránka používa cookies pre zlepšenie vašej skúsenosti. 
                    <a href="/ochrana-osobnych-udajov">Viac informácií</a></p>
                    <button class="btn btn-primary accept-cookies">Súhlasím</button>
                </div>
            `);
            
            $('body').append($consent);
            
            $('.accept-cookies').on('click', function() {
                localStorage.setItem('cookieConsent', 'true');
                $consent.remove();
            });
        }
    }

    // Language switcher functionality
    $('.language-selector a').on('click', function(e) {
        const lang = $(this).attr('lang');
        if (lang) {
            // Store language preference
            localStorage.setItem('preferredLanguage', lang);
            
            // Analytics tracking
            if (typeof gtag !== 'undefined') {
                gtag('event', 'language_change', {
                    language: lang
                });
            }
        }
    });

    // Initialize cookie consent
    initCookieConsent();

})(jQuery);
