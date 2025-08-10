export default defineNuxtConfig({
  devtools: { enabled: true },
  
  modules: [
    '@nuxtjs/tailwindcss',
    '@pinia/nuxt',
    '@vueuse/nuxt',
    '@nuxt/ui',
    '@nuxtjs/google-fonts'
  ],

  css: ['~/assets/css/main.css'],

  googleFonts: {
    families: {
      Inter: [400, 500, 600, 700]
    },
    display: 'swap',
    preload: true
  },

  app: {
    head: {
      charset: 'utf-8',
      viewport: 'width=device-width, initial-scale=1',
      title: 'Sociálne inovácie | Ministerstvo práce, sociálnych vecí a rodiny SR',
      meta: [
        { name: 'description', content: 'Sociálne inovácie - oficiálna stránka Ministerstva práce, sociálnych vecí a rodiny SR' },
        { name: 'keywords', content: 'sociálne inovácie, ministerstvo práce, sociálne veci, rodina, SR' },
        { name: 'author', content: 'Ministerstvo práce, sociálnych vecí a rodiny SR' },
        { property: 'og:title', content: 'Sociálne inovácie' },
        { property: 'og:description', content: 'Podporujeme sociálne inovácie na Slovensku' },
        { property: 'og:type', content: 'website' },
        { property: 'og:url', content: 'https://socialneinovacie.gov.sk/' }
      ],
      htmlAttrs: {
        lang: 'sk'
      }
    }
  },

  runtimeConfig: {
    public: {
      apiBase: process.env.API_BASE_URL || 'https://api.socialneinovacie.gov.sk'
    }
  },

  nitro: {
    prerender: {
      routes: ['/']
    }
  },

  // NASES compliance features
  ssr: true,
  
  // SEO and accessibility optimizations
  experimental: {
    payloadExtraction: false
  },

  router: {
    options: {
      scrollBehaviorType: 'smooth'
    }
  }
})
