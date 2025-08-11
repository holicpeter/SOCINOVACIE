<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <div class="search-form-wrapper">
        <label for="search-input-<?php echo uniqid(); ?>" class="search-label visually-hidden">
            <?php _e('Vyhľadať na stránke', 'socialne-inovacie-v8'); ?>
        </label>
        <div class="input-group">
            <input type="search" 
                   id="search-input-<?php echo uniqid(); ?>"
                   class="form-control search-field" 
                   placeholder="<?php _e('Zadajte vyhľadávaný výraz...', 'socialne-inovacie-v8'); ?>" 
                   value="<?php echo get_search_query(); ?>" 
                   name="s" 
                   autocomplete="off"
                   aria-describedby="search-button-<?php echo uniqid(); ?>"
                   required>
            <button type="submit" 
                    id="search-button-<?php echo uniqid(); ?>"
                    class="btn btn-primary search-submit" 
                    aria-label="<?php _e('Spustiť vyhľadávanie', 'socialne-inovacie-v8'); ?>">
                <i class="fas fa-search" aria-hidden="true"></i>
                <span class="button-text d-none d-md-inline"><?php _e('Hľadať', 'socialne-inovacie-v8'); ?></span>
            </button>
        </div>
        
        <!-- Search suggestions (optional) -->
        <div class="search-suggestions" id="search-suggestions" role="listbox" aria-hidden="true">
            <!-- Suggestions will be populated by JavaScript -->
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced search functionality
    const searchInputs = document.querySelectorAll('.search-field');
    
    searchInputs.forEach(function(searchInput) {
        let timeout;
        
        // Real-time search suggestions (optional)
        searchInput.addEventListener('input', function() {
            clearTimeout(timeout);
            const query = this.value.trim();
            
            if (query.length >= 3) {
                timeout = setTimeout(function() {
                    // Here you could implement AJAX search suggestions
                    // fetchSearchSuggestions(query);
                }, 300);
            } else {
                hideSuggestions();
            }
        });
        
        // Keyboard navigation for accessibility
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.closest('form').submit();
            }
        });
        
        // Clear search on Escape
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                this.value = '';
                hideSuggestions();
            }
        });
    });
    
    function hideSuggestions() {
        document.querySelectorAll('.search-suggestions').forEach(function(suggestions) {
            suggestions.setAttribute('aria-hidden', 'true');
            suggestions.innerHTML = '';
        });
    }
    
    // Optional: AJAX search suggestions
    function fetchSearchSuggestions(query) {
        // Implementation for search suggestions
        // This would make an AJAX call to a custom endpoint
        fetch(`${window.location.origin}/wp-json/socialne-inovacie/v1/search-suggestions?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                displaySuggestions(data.suggestions);
            })
            .catch(error => {
                console.log('Search suggestions unavailable:', error);
            });
    }
    
    function displaySuggestions(suggestions) {
        const suggestionsContainer = document.querySelector('.search-suggestions');
        
        if (suggestions && suggestions.length > 0) {
            suggestionsContainer.innerHTML = suggestions.map((suggestion, index) => 
                `<div class="suggestion-item" role="option" tabindex="-1" data-index="${index}">
                    <i class="fas fa-search me-2" aria-hidden="true"></i>
                    ${suggestion.title}
                    <small class="text-muted ms-2">${suggestion.type}</small>
                </div>`
            ).join('');
            
            suggestionsContainer.setAttribute('aria-hidden', 'false');
            
            // Add click handlers for suggestions
            suggestionsContainer.querySelectorAll('.suggestion-item').forEach(function(item) {
                item.addEventListener('click', function() {
                    const searchInput = this.closest('.search-form-wrapper').querySelector('.search-field');
                    searchInput.value = this.textContent.trim();
                    searchInput.closest('form').submit();
                });
            });
        } else {
            hideSuggestions();
        }
    }
});
</script>
