<template>
  <div class="min-h-screen flex flex-col">
    <!-- Skip Link pro accessibility -->
    <AppSkipLink />
    
    <!-- Live region pro screen reader oznámenia -->
    <div 
      :aria-live="announcement ? 'polite' : 'off'"
      aria-atomic="true" 
      class="sr-only"
      role="status"
    >
      {{ announcement }}
    </div>

    <!-- Loading overlay -->
    <AppLoadingOverlay v-if="isLoading" />

    <!-- Header -->
    <AppHeader />
    
    <!-- Main Navigation -->
    <AppNavigation />
    
    <!-- Hero Section -->
    <AppHero />
    
    <!-- Main Content -->
    <main id="main-content" class="flex-1">
      <div class="container mx-auto px-4 py-8">
        <!-- About Section -->
        <section id="o-nas" class="mb-16">
          <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-6 animate-fade-in">
              O sociálnych inováciách
            </h2>
            <p class="text-xl text-gray-600 leading-relaxed animate-slide-up animation-delay-200">
              Sociálne inovácie predstavujú nové riešenia (produkty, služby, modely, trhy, procesy atď.), 
              ktoré súčasne uspokojujú sociálne potreby a vytvárajú nové sociálne vzťahy alebo spoluprácu.
            </p>
          </div>
        </section>

        <!-- Innovation Areas -->
        <InnovationAreasSection @announce="announceToScreenReader" />
        
        <!-- News Section -->
        <NewsSection />
      </div>
    </main>
    
    <!-- Footer -->
    <AppFooter />
  </div>
</template>

<script setup lang="ts">
// Meta tags pre SEO a NASES compliance
useSeoMeta({
  title: 'Sociálne inovácie | Ministerstvo práce, sociálnych vecí a rodiny SR',
  ogTitle: 'Sociálne inovácie',
  description: 'Podporujeme a rozvíjame sociálne inovácie pre lepšiu budúcnosť Slovenska',
  ogDescription: 'Podporujeme sociálne inovácie na Slovensku',
  ogUrl: 'https://socialneinovacie.gov.sk/',
  ogType: 'website',
  ogImage: '/og-image.jpg',
  twitterCard: 'summary_large_image'
})

// JSON-LD structured data pre lepšie SEO
useJsonld({
  '@context': 'https://schema.org',
  '@type': 'GovernmentOrganization',
  name: 'Ministerstvo práce, sociálnych vecí a rodiny SR',
  url: 'https://socialneinovacie.gov.sk',
  description: 'Oficiálna stránka pre sociálne inovácie',
  address: {
    '@type': 'PostalAddress',
    streetAddress: 'Spitalska 4, 6, 8',
    addressLocality: 'Bratislava',
    postalCode: '816 43',
    addressCountry: 'SK'
  }
})

// Reactivity
const isLoading = ref(true)
const announcement = ref('')

// Loading simulation
onMounted(() => {
  setTimeout(() => {
    isLoading.value = false
    announceToScreenReader('Stránka bola úspešne načítaná')
  }, 1500)
})

// Screen reader announcements
const announceToScreenReader = (message: string) => {
  announcement.value = message
  setTimeout(() => {
    announcement.value = ''
  }, 1000)
}

// Accessibility improvements
onMounted(() => {
  // Add focus management
  const focusableElements = document.querySelectorAll(
    'a[href], button, textarea, input[type="text"], input[type="radio"], input[type="checkbox"], select'
  )
  
  focusableElements.forEach(element => {
    element.addEventListener('focus', () => {
      element.scrollIntoView({ 
        behavior: 'smooth', 
        block: 'nearest' 
      })
    })
  })
})

// Keyboard navigation
onMounted(() => {
  document.addEventListener('keydown', (e) => {
    // Alt + 1 = Hlavný obsah
    if (e.altKey && e.key === '1') {
      e.preventDefault()
      const mainContent = document.getElementById('main-content')
      if (mainContent) {
        mainContent.focus()
        mainContent.scrollIntoView({ behavior: 'smooth' })
      }
    }
    
    // Alt + 2 = Navigácia
    if (e.altKey && e.key === '2') {
      e.preventDefault()
      const nav = document.querySelector('nav')
      if (nav) {
        const firstLink = nav.querySelector('a')
        firstLink?.focus()
      }
    }
  })
})
</script>

<style>
/* CSS pre animácie a accessibility */
.animate-fade-in {
  animation: fadeIn 0.6s ease-out;
}

.animate-slide-up {
  animation: slideUp 0.6s ease-out;
}

.animation-delay-200 {
  animation-delay: 200ms;
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

@keyframes slideUp {
  from {
    transform: translateY(30px);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

/* Screen reader only class */
.sr-only {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  white-space: nowrap;
  border: 0;
}

/* Focus styles pre accessibility */
*:focus {
  outline: 2px solid #3B82F6;
  outline-offset: 2px;
}

/* High contrast mode support */
@media (prefers-contrast: high) {
  * {
    border-color: #000000 !important;
  }
  
  .text-gray-600 {
    color: #000000 !important;
  }
  
  .text-gray-900 {
    color: #000000 !important;
  }
}

/* Reduced motion support */
@media (prefers-reduced-motion: reduce) {
  .animate-fade-in,
  .animate-slide-up {
    animation: none;
  }
  
  * {
    transition: none !important;
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
  }
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
  body {
    background-color: #1F2937;
    color: #F9FAFB;
  }
  
  .text-gray-900 {
    color: #F9FAFB !important;
  }
  
  .text-gray-600 {
    color: #D1D5DB !important;
  }
}
</style>
