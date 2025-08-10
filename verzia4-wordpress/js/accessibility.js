/**
 * Accessibility-specific JavaScript
 * Enhanced NASES compliance features
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        initScreenReaderSupport();
        initKeyboardNavigation();
        initFocusManagement();
        initAriaEnhancements();
        initTextSizeControls();
    });

    /**
     * Screen reader support enhancements
     */
    function initScreenReaderSupport() {
        // Add screen reader announcements for dynamic content
        const $liveRegion = $('<div>').attr({
            'id': 'live-announcements',
            'aria-live': 'polite',
            'aria-atomic': 'false',
            'class': 'screen-reader-text'
        });
        $('body').append($liveRegion);

        // Announce form validation errors
        $(document).on('invalid', 'input, select, textarea', function() {
            const fieldName = $(this).attr('name') || $(this).attr('id') || 'pole';
            const message = `Chyba v poli ${fieldName}. Prosím, skontrolujte zadané údaje.`;
            announceToScreenReader(message);
        });

        // Announce successful form submissions
        $('.contact-form, .search-form').on('submit', function() {
            announceToScreenReader('Formulár bol odoslaný. Spracovávame vaše údaje.');
        });
    }

    /**
     * Enhanced keyboard navigation
     */
    function initKeyboardNavigation() {
        let currentFocusIndex = -1;
        const focusableElements = 'a[href], button, textarea, input[type="text"], input[type="radio"], input[type="checkbox"], select, [tabindex]:not([tabindex="-1"])';

        // Tab navigation enhancement
        $(document).on('keydown', function(e) {
            const $focusable = $(focusableElements).filter(':visible');
            
            switch(e.keyCode) {
                case 9: // Tab
                    handleTabNavigation(e, $focusable);
                    break;
                case 27: // Escape
                    handleEscapeKey();
                    break;
                case 32: // Space
                    handleSpaceKey(e);
                    break;
                case 13: // Enter
                    handleEnterKey(e);
                    break;
            }
        });

        // Arrow key navigation for menus
        $('.main-navigation').on('keydown', 'a', function(e) {
            const $menuItems = $('.main-navigation a');
            const currentIndex = $menuItems.index(this);
            
            switch(e.keyCode) {
                case 37: // Left arrow
                    e.preventDefault();
                    navigateMenu($menuItems, currentIndex, -1);
                    break;
                case 39: // Right arrow
                    e.preventDefault();
                    navigateMenu($menuItems, currentIndex, 1);
                    break;
                case 40: // Down arrow
                    e.preventDefault();
                    openSubmenu($(this));
                    break;
                case 38: // Up arrow
                    e.preventDefault();
                    closeSubmenu($(this));
                    break;
            }
        });
    }

    /**
     * Focus management
     */
    function initFocusManagement() {
        // Store focus before page interactions
        let lastFocusedElement = null;

        $(document).on('focusin', function(e) {
            lastFocusedElement = e.target;
        });

        // Focus management for mobile menu
        $('.menu-toggle').on('click', function() {
            const isExpanded = $(this).attr('aria-expanded') === 'true';
            
            if (isExpanded) {
                // Menu is closing, return focus to toggle
                $(this).focus();
            } else {
                // Menu is opening, focus first menu item
                setTimeout(() => {
                    $('#primary-menu a').first().focus();
                }, 100);
            }
        });

        // Skip link functionality
        $('.skip-links a').on('click', function(e) {
            e.preventDefault();
            const target = $(this).attr('href');
            const $target = $(target);
            
            if ($target.length) {
                // Make target focusable if it's not already
                if (!$target.attr('tabindex')) {
                    $target.attr('tabindex', '-1');
                }
                $target.focus();
                
                // Remove tabindex after focus
                setTimeout(() => {
                    $target.removeAttr('tabindex');
                }, 100);
            }
        });

        // Focus visible elements
        $('.content-card').on('focus', function() {
            $(this).addClass('focus-visible');
        }).on('blur', function() {
            $(this).removeClass('focus-visible');
        });
    }

    /**
     * ARIA enhancements
     */
    function initAriaEnhancements() {
        // Dynamic ARIA attributes for expanding content
        $('.expandable-content').each(function() {
            const $trigger = $(this).find('.expand-trigger');
            const $content = $(this).find('.expand-content');
            const id = 'expandable-' + Math.random().toString(36).substr(2, 9);
            
            $content.attr('id', id);
            $trigger.attr({
                'aria-controls': id,
                'aria-expanded': 'false'
            });
            
            $trigger.on('click', function() {
                const isExpanded = $(this).attr('aria-expanded') === 'true';
                $(this).attr('aria-expanded', !isExpanded);
                $content.toggle();
                
                announceToScreenReader(isExpanded ? 'Obsah bol skrytý' : 'Obsah bol zobrazený');
            });
        });

        // ARIA labels for form fields without labels
        $('input, select, textarea').each(function() {
            const $field = $(this);
            const $label = $('label[for="' + $field.attr('id') + '"]');
            
            if ($label.length === 0 && !$field.attr('aria-label') && !$field.attr('aria-labelledby')) {
                const placeholder = $field.attr('placeholder');
                const name = $field.attr('name');
                
                if (placeholder) {
                    $field.attr('aria-label', placeholder);
                } else if (name) {
                    $field.attr('aria-label', name.replace(/[_-]/g, ' '));
                }
            }
        });

        // ARIA live regions for dynamic content updates
        $('.search-results, .filter-results').attr('aria-live', 'polite');
        $('.error-messages, .success-messages').attr('aria-live', 'assertive');
    }

    /**
     * Text size controls for accessibility
     */
    function initTextSizeControls() {
        const defaultFontSize = parseInt($('html').css('font-size'));
        let currentFontSize = localStorage.getItem('fontSize') || defaultFontSize;
        
        // Apply saved font size
        $('html').css('font-size', currentFontSize + 'px');
        
        // Text size controls
        const $textControls = $(`
            <div class="text-size-controls" role="group" aria-label="Ovládanie veľkosti textu">
                <button class="text-size-btn" data-action="decrease" aria-label="Zmenšiť text">A-</button>
                <button class="text-size-btn" data-action="reset" aria-label="Resetovať veľkosť textu">A</button>
                <button class="text-size-btn" data-action="increase" aria-label="Zväčšiť text">A+</button>
            </div>
        `);
        
        $('.site-header .container').append($textControls);
        
        $('.text-size-btn').on('click', function() {
            const action = $(this).data('action');
            let newSize = parseInt(currentFontSize);
            
            switch(action) {
                case 'increase':
                    newSize = Math.min(newSize + 2, defaultFontSize + 8);
                    break;
                case 'decrease':
                    newSize = Math.max(newSize - 2, defaultFontSize - 4);
                    break;
                case 'reset':
                    newSize = defaultFontSize;
                    break;
            }
            
            currentFontSize = newSize;
            $('html').css('font-size', newSize + 'px');
            localStorage.setItem('fontSize', newSize);
            
            announceToScreenReader(`Veľkosť textu bola zmenená na ${newSize} pixelov`);
        });
    }

    /**
     * Utility functions
     */
    function announceToScreenReader(message) {
        const $liveRegion = $('#live-announcements');
        $liveRegion.text(message);
        
        // Clear after announcement
        setTimeout(() => {
            $liveRegion.text('');
        }, 1000);
    }

    function handleTabNavigation(e, $focusable) {
        const currentIndex = $focusable.index($(document.activeElement));
        
        // Trap focus within modals or mobile menu
        if ($('body').hasClass('mobile-menu-open')) {
            const $menuItems = $('.main-navigation a, .menu-toggle');
            const menuIndex = $menuItems.index($(document.activeElement));
            
            if (e.shiftKey) {
                // Shift + Tab
                if (menuIndex === 0) {
                    e.preventDefault();
                    $menuItems.last().focus();
                }
            } else {
                // Tab
                if (menuIndex === $menuItems.length - 1) {
                    e.preventDefault();
                    $menuItems.first().focus();
                }
            }
        }
    }

    function handleEscapeKey() {
        // Close any open modals or menus
        if ($('body').hasClass('mobile-menu-open')) {
            $('.menu-toggle').click();
        }
        
        // Close any expanded content
        $('.expandable-content .expand-trigger[aria-expanded="true"]').click();
    }

    function handleSpaceKey(e) {
        const $target = $(e.target);
        
        // Space should activate buttons and checkboxes
        if ($target.is('button') || $target.attr('role') === 'button') {
            e.preventDefault();
            $target.click();
        }
    }

    function handleEnterKey(e) {
        const $target = $(e.target);
        
        // Enter should activate buttons and links
        if ($target.attr('role') === 'button') {
            e.preventDefault();
            $target.click();
        }
    }

    function navigateMenu($menuItems, currentIndex, direction) {
        let newIndex = currentIndex + direction;
        
        if (newIndex < 0) {
            newIndex = $menuItems.length - 1;
        } else if (newIndex >= $menuItems.length) {
            newIndex = 0;
        }
        
        $menuItems.eq(newIndex).focus();
    }

    function openSubmenu($menuItem) {
        const $submenu = $menuItem.siblings('.sub-menu');
        if ($submenu.length > 0) {
            $submenu.addClass('show');
            $submenu.find('a').first().focus();
        }
    }

    function closeSubmenu($menuItem) {
        const $submenu = $menuItem.closest('.sub-menu');
        if ($submenu.length > 0) {
            $submenu.removeClass('show');
            $submenu.siblings('a').focus();
        }
    }

    /**
     * High contrast mode toggle
     */
    function initHighContrastMode() {
        const $contrastToggle = $(`
            <button class="contrast-toggle" aria-label="Prepnúť vysoký kontrast">
                <i class="fas fa-adjust" aria-hidden="true"></i>
            </button>
        `);
        
        $('.text-size-controls').append($contrastToggle);
        
        // Apply saved contrast preference
        if (localStorage.getItem('highContrast') === 'true') {
            $('body').addClass('high-contrast');
        }
        
        $contrastToggle.on('click', function() {
            const isHighContrast = $('body').hasClass('high-contrast');
            $('body').toggleClass('high-contrast');
            localStorage.setItem('highContrast', !isHighContrast);
            
            announceToScreenReader(isHighContrast ? 
                'Vysoký kontrast bol vypnutý' : 
                'Vysoký kontrast bol zapnutý'
            );
        });
    }

    // Initialize high contrast mode
    initHighContrastMode();

    /**
     * Form accessibility enhancements
     */
    $(document).on('blur', 'input[required], select[required], textarea[required]', function() {
        const $field = $(this);
        const isEmpty = $field.val().trim() === '';
        
        if (isEmpty) {
            $field.attr('aria-invalid', 'true');
            
            // Add error message if not exists
            if ($field.siblings('.error-message').length === 0) {
                const fieldName = $field.attr('name') || 'toto pole';
                const $error = $(`<span class="error-message" role="alert">
                    ${fieldName} je povinné pole
                </span>`);
                $field.after($error);
            }
        } else {
            $field.attr('aria-invalid', 'false');
            $field.siblings('.error-message').remove();
        }
    });

})(jQuery);
