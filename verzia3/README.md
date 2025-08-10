# Verzia 3: Vue.js/Nuxt.js aplikácia

Pokročilá univerzálna aplikácia postavená na Vue 3 a Nuxt 3 s podporou SSR/SSG, optimalizovaná pre SEO a performance.

## 🛠️ Tech Stack

- **Vue 3** - Composition API, Script Setup syntax
- **Nuxt 3** - Full-stack framework s SSR/SSG
- **TypeScript** - Type safety a IntelliSense
- **Tailwind CSS** - Utility-first styling
- **Pinia** - State management pre Vue
- **VueUse** - Collection of Vue composition utilities
- **Headless UI Vue** - Unstyled UI komponenty

## 🚀 Rýchly štart

```bash
# Navigácia do priečinka
cd verzia3

# Inštalácia závislostí
npm install

# Development server
npm run dev

# Otvorte http://localhost:3000
```

## 📦 Dostupné skripty

```bash
# Development mode s hot reload
npm run dev

# Production build (SSR)
npm run build

# Statické generovanie (SSG)
npm run generate

# Preview production buildu
npm run preview

# Príprava TypeScript definícií
npm run postinstall

# Linting
npm run lint
npm run lint:fix

# Type checking
npm run type-check
```

## 📁 Štruktúra projektu

```
verzia3/
├── pages/                  # File-based routing
│   ├── index.vue          # Hlavná stránka (/)
│   ├── o-nas.vue          # O nás stránka (/o-nas)
│   └── kontakt.vue        # Kontakt (/kontakt)
├── components/            # Vue komponenty
│   ├── App/               # App-level komponenty
│   │   ├── Header.vue
│   │   ├── Navigation.vue
│   │   ├── Footer.vue
│   │   └── SkipLink.vue
│   ├── Innovation/        # Funkčné komponenty
│   │   ├── AreasSection.vue
│   │   └── Card.vue
│   └── News/              # News komponenty
│       ├── Section.vue
│       └── Item.vue
├── layouts/               # Layout komponenty
│   └── default.vue        # Základný layout
├── composables/           # Vue composables
│   ├── useAccessibility.ts
│   ├── useLanguage.ts
│   └── useTheme.ts
├── stores/                # Pinia stores
│   ├── language.ts
│   └── theme.ts
├── assets/                # Štýly a obrázky
│   └── css/
│       └── main.css
├── public/                # Statické súbory
├── nuxt.config.ts         # Nuxt konfigurácia
└── package.json           # NPM konfigurácia
```

## 🔧 Nuxt konfigurácia

```typescript
// nuxt.config.ts
export default defineNuxtConfig({
  modules: [
    '@nuxtjs/tailwindcss',  // Tailwind CSS
    '@pinia/nuxt',          // State management
    '@vueuse/nuxt',         // VueUse utilities
    '@nuxt/ui',             // UI komponenty
    '@nuxtjs/google-fonts'  // Web fonts
  ],
  
  // SSR/SSG konfigurácia
  ssr: true,
  nitro: {
    prerender: {
      routes: ['/']
    }
  },
  
  // SEO optimalizácia
  app: {
    head: {
      charset: 'utf-8',
      viewport: 'width=device-width, initial-scale=1',
      title: 'Sociálne inovácie | Ministerstvo práce, sociálnych vecí a rodiny SR'
    }
  }
})
```

## 🎨 Vue 3 Composition API

### Script Setup syntax
```vue
<!-- components/InnovationCard.vue -->
<template>
  <div class="card" :class="cardClasses">
    <div class="card-header">
      <Icon :name="icon" class="w-6 h-6" />
      <h3>{{ title }}</h3>
    </div>
    <div class="card-body">
      <p>{{ description }}</p>
      <button @click="handleClick" class="btn-primary">
        {{ $t('common.readMore') }}
      </button>
    </div>
  </div>
</template>

<script setup lang="ts">
interface Props {
  title: string
  description: string
  icon: string
  variant?: 'default' | 'highlighted'
}

interface Emits {
  click: [id: string]
}

// Props s default hodnotami
const props = withDefaults(defineProps<Props>(), {
  variant: 'default'
})

// Emits
const emit = defineEmits<Emits>()

// Computed properties
const cardClasses = computed(() => ({
  'card--highlighted': props.variant === 'highlighted',
  'card--default': props.variant === 'default'
}))

// Methods
const handleClick = () => {
  emit('click', props.title)
}
</script>
```

### Composables
```typescript
// composables/useAccessibility.ts
export const useAccessibility = () => {
  const announcement = ref('')
  
  const announceToScreenReader = (message: string) => {
    announcement.value = message
    setTimeout(() => {
      announcement.value = ''
    }, 1000)
  }
  
  const setupKeyboardNavigation = () => {
    const handleKeyDown = (e: KeyboardEvent) => {
      if (e.altKey && e.key === '1') {
        e.preventDefault()
        const mainContent = document.getElementById('main-content')
        if (mainContent) {
          mainContent.focus()
          mainContent.scrollIntoView({ behavior: 'smooth' })
        }
      }
    }
    
    onMounted(() => {
      document.addEventListener('keydown', handleKeyDown)
    })
    
    onUnmounted(() => {
      document.removeEventListener('keydown', handleKeyDown)
    })
  }
  
  return {
    announcement: readonly(announcement),
    announceToScreenReader,
    setupKeyboardNavigation
  }
}
```

## 🗂️ State Management s Pinia

```typescript
// stores/language.ts
export const useLanguageStore = defineStore('language', () => {
  const currentLanguage = ref<'sk' | 'en'>('sk')
  
  const setLanguage = (lang: 'sk' | 'en') => {
    currentLanguage.value = lang
    // Persist to localStorage
    if (process.client) {
      localStorage.setItem('preferred-language', lang)
    }
  }
  
  const initializeLanguage = () => {
    if (process.client) {
      const saved = localStorage.getItem('preferred-language') as 'sk' | 'en'
      if (saved) {
        currentLanguage.value = saved
      }
    }
  }
  
  return {
    currentLanguage: readonly(currentLanguage),
    setLanguage,
    initializeLanguage
  }
})
```

## 🌐 Internationalization

```typescript
// plugins/i18n.client.ts
export default defineNuxtPlugin(() => {
  const { currentLanguage } = useLanguageStore()
  
  const translations = {
    sk: {
      nav: {
        home: 'Domov',
        about: 'O nás',
        projects: 'Projekty'
      }
    },
    en: {
      nav: {
        home: 'Home',
        about: 'About',
        projects: 'Projects'
      }
    }
  }
  
  const $t = (key: string) => {
    const keys = key.split('.')
    const translation = keys.reduce((obj, k) => obj?.[k], translations[currentLanguage.value])
    return translation || key
  }
  
  return {
    provide: {
      t: $t
    }
  }
})
```

## 🔍 SEO a Meta tags

```vue
<!-- pages/index.vue -->
<script setup lang="ts">
// SEO Meta tags
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

// JSON-LD Structured Data
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
</script>
```

## ⚡ Performance optimalizácie

### Lazy loading komponentov
```vue
<template>
  <div>
    <!-- Lazy loaded komponent -->
    <LazyNewsSection v-if="showNews" />
    
    <!-- Conditional loading -->
    <ClientOnly>
      <HeavyComponent />
      <template #fallback>
        <div>Loading...</div>
      </template>
    </ClientOnly>
  </div>
</template>
```

### Image optimalizácia
```vue
<template>
  <NuxtImg
    src="/hero-image.jpg"
    alt="Sociálne inovácie"
    width="1200"
    height="600"
    loading="lazy"
    :modifiers="{ format: 'webp', quality: 80 }"
  />
</template>
```

## 🧪 Testing

### Unit testy s Vitest
```typescript
// tests/components/Header.test.ts
import { mount } from '@vue/test-utils'
import { describe, it, expect } from 'vitest'
import Header from '~/components/AppHeader.vue'

describe('Header', () => {
  it('renders navigation links', () => {
    const wrapper = mount(Header)
    expect(wrapper.find('[role="navigation"]').exists()).toBe(true)
    expect(wrapper.find('a[href="/"]').text()).toBe('gov.sk')
  })
  
  it('toggles mobile menu', async () => {
    const wrapper = mount(Header)
    const toggleButton = wrapper.find('[aria-label="Otvoriť menu"]')
    
    await toggleButton.trigger('click')
    expect(wrapper.vm.isMobileMenuOpen).toBe(true)
  })
})
```

### E2E testy s Playwright
```typescript
// tests/e2e/homepage.spec.ts
import { test, expect } from '@playwright/test'

test('homepage accessibility', async ({ page }) => {
  await page.goto('/')
  
  // Test keyboard navigation
  await page.keyboard.press('Tab')
  await expect(page.locator(':focus')).toHaveAttribute('href', '#main-content')
  
  // Test skip link
  await page.keyboard.press('Enter')
  await expect(page.locator('#main-content')).toBeFocused()
})
```

## 🚀 Deployment možnosti

### Statické generovanie (SSG)
```bash
# Vygenerovať statické súbory
npm run generate

# Výstup v .output/public/
# Nahrať na CDN alebo statický hosting
```

### Server-side rendering (SSR)
```bash
# Build pre Node.js server
npm run build

# Spustiť production server
npm run preview
```

### Docker deployment
```dockerfile
# Dockerfile
FROM node:18-alpine

WORKDIR /app
COPY package*.json ./
RUN npm ci

COPY . .
RUN npm run build

EXPOSE 3000
CMD ["npm", "run", "preview"]
```

### Netlify deployment
```toml
# netlify.toml
[build]
  command = "npm run generate"
  publish = ".output/public"

[[headers]]
  for = "/*"
  [headers.values]
    X-Frame-Options = "DENY"
    X-XSS-Protection = "1; mode=block"
```

## 📊 Performance monitoring

```typescript
// plugins/analytics.client.ts
export default defineNuxtPlugin(() => {
  if (process.client) {
    // Core Web Vitals monitoring
    import('web-vitals').then(({ getCLS, getFID, getFCP, getLCP, getTTFB }) => {
      getCLS(console.log)
      getFID(console.log)
      getFCP(console.log)
      getLCP(console.log)
      getTTFB(console.log)
    })
  }
})
```

## 🔧 VS Code setup

### Odporúčané extensions:
- Vetur alebo Volar (Vue 3 support)
- TypeScript Vue Plugin (Volar)
- Tailwind CSS IntelliSense
- Auto Rename Tag
- ESLint

### Workspace settings:
```json
{
  "typescript.preferences.includePackageJsonAutoImports": "on",
  "vue.complete.casing.props": "kebab",
  "vue.complete.casing.tags": "pascal"
}
```

## 🐛 Troubleshooting

### Časté problémy:

1. **Hydration mismatch**
   ```vue
   <!-- Použiť ClientOnly pre browser-specific obsah -->
   <ClientOnly>
     <div>{{ new Date().toLocaleString() }}</div>
   </ClientOnly>
   ```

2. **TypeScript errors**
   ```bash
   # Regenerovať typy
   rm -rf .nuxt
   npm run postinstall
   ```

3. **Build fails**
   ```bash
   # Vyčistiť cache
   rm -rf .nuxt .output node_modules
   npm install
   ```

## 📞 Podpora

Pre otázky k Vue/Nuxt verzii:
- Email: nuxt-dev@socialneinovacie.gov.sk
- GitHub Issues: [Otvoriť issue](link)
- Discord: Nuxt.js community
