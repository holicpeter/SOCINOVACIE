<template>
  <header class="gov-header bg-primary-600 text-white">
    <div class="container mx-auto px-4">
      <nav class="flex items-center justify-between py-4">
        <NuxtLink 
          to="/" 
          class="navbar-brand flex items-center text-white text-xl font-bold hover:opacity-80 transition-opacity"
          aria-label="Domovská stránka"
        >
          <Icon name="heroicons:building-library" class="w-6 h-6 mr-2" />
          gov.sk
        </NuxtLink>
        
        <div class="hidden md:flex items-center space-x-6">
          <NuxtLink 
            to="/kontakt" 
            class="nav-link flex items-center text-white hover:opacity-80 transition-opacity"
            aria-label="Kontaktné informácie"
          >
            <Icon name="heroicons:envelope" class="w-4 h-4 mr-2" />
            Kontakt
          </NuxtLink>
          <NuxtLink 
            to="/mapa-stranky" 
            class="nav-link flex items-center text-white hover:opacity-80 transition-opacity"
            aria-label="Mapa stránky"
          >
            <Icon name="heroicons:map" class="w-4 h-4 mr-2" />
            Mapa stránky
          </NuxtLink>
          <button 
            @click="toggleLanguage"
            class="nav-link flex items-center text-white hover:opacity-80 transition-opacity"
            :aria-label="currentLanguage === 'sk' ? 'Switch to English' : 'Prepnúť na slovenčinu'"
          >
            <Icon name="heroicons:language" class="w-4 h-4 mr-2" />
            {{ currentLanguage === 'sk' ? 'EN' : 'SK' }}
          </button>
        </div>
        
        <!-- Mobile menu button -->
        <button 
          @click="toggleMobileMenu"
          class="md:hidden text-white p-2"
          :aria-expanded="isMobileMenuOpen"
          aria-label="Otvoriť menu"
        >
          <Icon :name="isMobileMenuOpen ? 'heroicons:x-mark' : 'heroicons:bars-3'" class="w-6 h-6" />
        </button>
      </nav>
      
      <!-- Mobile menu -->
      <Transition
        enter-active-class="transition ease-out duration-200"
        enter-from-class="opacity-0 scale-95"
        enter-to-class="opacity-100 scale-100"
        leave-active-class="transition ease-in duration-150"
        leave-from-class="opacity-100 scale-100"
        leave-to-class="opacity-0 scale-95"
      >
        <div v-if="isMobileMenuOpen" class="md:hidden mt-4 pb-4">
          <div class="flex flex-col space-y-3">
            <NuxtLink 
              to="/kontakt" 
              class="nav-link flex items-center text-white hover:opacity-80 transition-opacity"
              @click="closeMobileMenu"
            >
              <Icon name="heroicons:envelope" class="w-4 h-4 mr-2" />
              Kontakt
            </NuxtLink>
            <NuxtLink 
              to="/mapa-stranky" 
              class="nav-link flex items-center text-white hover:opacity-80 transition-opacity"
              @click="closeMobileMenu"
            >
              <Icon name="heroicons:map" class="w-4 h-4 mr-2" />
              Mapa stránky
            </NuxtLink>
            <button 
              @click="toggleLanguage"
              class="nav-link flex items-center text-white hover:opacity-80 transition-opacity text-left"
            >
              <Icon name="heroicons:language" class="w-4 h-4 mr-2" />
              {{ currentLanguage === 'sk' ? 'English' : 'Slovenčina' }}
            </button>
          </div>
        </div>
      </Transition>
    </div>
  </header>
</template>

<script setup lang="ts">
// Reactivity
const isMobileMenuOpen = ref(false)
const currentLanguage = ref('sk')

// Methods
const toggleMobileMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value
}

const closeMobileMenu = () => {
  isMobileMenuOpen.value = false
}

const toggleLanguage = () => {
  currentLanguage.value = currentLanguage.value === 'sk' ? 'en' : 'sk'
  // Tu by sa implementovala zmena jazyka
  console.log('Language switched to:', currentLanguage.value)
}

// Close mobile menu on route change
const route = useRoute()
watch(() => route.path, () => {
  closeMobileMenu()
})

// Close mobile menu on escape key
onMounted(() => {
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && isMobileMenuOpen.value) {
      closeMobileMenu()
    }
  })
})
</script>

<style scoped>
.gov-header {
  border-bottom: 3px solid #1E40AF;
}

.nav-link:focus {
  outline: 2px solid #FFA500;
  outline-offset: 2px;
}
</style>
