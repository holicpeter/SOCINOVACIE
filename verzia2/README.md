# Verzia 2: React/TypeScript aplikácia

Moderná Single Page Application (SPA) postavená na React 18 s TypeScript, Vite a Tailwind CSS.

## 🛠️ Tech Stack

- **React 18** - Moderný React s hooks a concurrent features
- **TypeScript** - Type safety a lepší developer experience  
- **Vite** - Rýchly build tool a dev server
- **Tailwind CSS** - Utility-first CSS framework
- **Framer Motion** - Animácie a transitions
- **React Router DOM** - Client-side routing
- **Headless UI** - Unstyled UI komponenty

## 🚀 Rýchly štart

```bash
# Navigácia do priečinka
cd verzia2

# Inštalácia závislostí
npm install

# Spustenie dev servera
npm run dev

# Otvorte http://localhost:3000
```

## 📦 Dostupné skripty

```bash
# Development server
npm run dev

# Production build
npm run build

# Preview production buildu
npm run preview

# Linting
npm run lint

# Type checking
npm run type-check
```

## 📁 Štruktúra projektu

```
verzia2/
├── src/
│   ├── components/          # React komponenty
│   │   ├── Header.tsx
│   │   ├── Navigation.tsx
│   │   ├── Hero.tsx
│   │   ├── AboutSection.tsx
│   │   ├── InnovationAreas.tsx
│   │   ├── NewsSection.tsx
│   │   ├── Footer.tsx
│   │   ├── SkipLink.tsx
│   │   └── LoadingSpinner.tsx
│   ├── hooks/               # Custom React hooks
│   ├── utils/               # Utility funkcie
│   ├── types/               # TypeScript definície
│   ├── App.tsx             # Hlavný App komponent
│   ├── main.tsx            # Entry point
│   └── index.css           # Tailwind CSS
├── public/                 # Statické súbory
├── index.html             # HTML template
├── vite.config.ts         # Vite konfigurácia
├── tailwind.config.js     # Tailwind konfigurácia
├── tsconfig.json          # TypeScript konfigurácia
└── package.json           # NPM konfigurácia
```

## 🎨 Dizajn systém

### Tailwind konfigurácia
```javascript
// tailwind.config.js
module.exports = {
  theme: {
    extend: {
      colors: {
        primary: {
          50: '#eff6ff',
          500: '#3b82f6',
          600: '#0052CC',
          700: '#1d4ed8',
        }
      },
      fontFamily: {
        sans: ['Inter', 'ui-sans-serif', 'system-ui'],
      }
    }
  }
}
```

### Komponenty
- Všetky komponenty sú TypeScript
- Props interfaces pre type safety
- Kompozícia cez React hooks
- Accessibility best practices

## ⚡ Performance optimalizácie

### Code splitting
```typescript
// Lazy loading komponentov
const AdminPanel = lazy(() => import('./components/AdminPanel'))

// Route-based code splitting
const routes = [
  {
    path: '/admin',
    component: lazy(() => import('./pages/AdminPage'))
  }
]
```

### Bundle optimalizácia
```javascript
// vite.config.ts
export default defineConfig({
  build: {
    rollupOptions: {
      output: {
        manualChunks: {
          vendor: ['react', 'react-dom'],
          router: ['react-router-dom'],
          ui: ['@headlessui/react', '@heroicons/react']
        }
      }
    }
  }
})
```

## ♿ Accessibility implementácia

### React špecifické riešenia
```typescript
// Screen reader announcements
const announceToScreenReader = (message: string) => {
  const announcement = document.createElement('div')
  announcement.setAttribute('aria-live', 'polite')
  announcement.setAttribute('aria-atomic', 'true')
  announcement.className = 'sr-only'
  announcement.textContent = message
  
  document.body.appendChild(announcement)
  setTimeout(() => document.body.removeChild(announcement), 1000)
}

// Focus management
const focusManagement = () => {
  const focusableElements = document.querySelectorAll(
    'a[href], button, textarea, input[type="text"], input[type="radio"], input[type="checkbox"], select'
  )
  
  focusableElements.forEach(element => {
    element.addEventListener('focus', () => {
      element.scrollIntoView({ behavior: 'smooth', block: 'nearest' })
    })
  })
}
```

### Custom hooks pre accessibility
```typescript
// hooks/useAnnouncement.ts
export const useAnnouncement = () => {
  const [announcement, setAnnouncement] = useState('')
  
  const announce = useCallback((message: string) => {
    setAnnouncement(message)
    setTimeout(() => setAnnouncement(''), 1000)
  }, [])
  
  return { announcement, announce }
}

// hooks/useKeyboardNavigation.ts
export const useKeyboardNavigation = () => {
  useEffect(() => {
    const handleKeyDown = (e: KeyboardEvent) => {
      if (e.altKey && e.key === '1') {
        const mainContent = document.getElementById('main-content')
        mainContent?.focus()
      }
    }
    
    document.addEventListener('keydown', handleKeyDown)
    return () => document.removeEventListener('keydown', handleKeyDown)
  }, [])
}
```

## 🧪 Testing

### Unit testy (React Testing Library)
```typescript
// __tests__/Header.test.tsx
import { render, screen } from '@testing-library/react'
import { Header } from '../components/Header'

test('renders navigation links', () => {
  render(<Header />)
  expect(screen.getByRole('navigation')).toBeInTheDocument()
  expect(screen.getByLabelText('Hlavná navigácia')).toBeInTheDocument()
})
```

### Accessibility testy
```typescript
// __tests__/accessibility.test.tsx
import { axe, toHaveNoViolations } from 'jest-axe'

expect.extend(toHaveNoViolations)

test('should not have accessibility violations', async () => {
  const { container } = render(<App />)
  const results = await axe(container)
  expect(results).toHaveNoViolations()
})
```

## 🔄 State management

### React Context pre globálny state
```typescript
// contexts/AppContext.tsx
interface AppContextType {
  language: 'sk' | 'en'
  setLanguage: (lang: 'sk' | 'en') => void
  theme: 'light' | 'dark'
  setTheme: (theme: 'light' | 'dark') => void
}

export const AppContext = createContext<AppContextType>()
```

### Custom hooks pre state
```typescript
// hooks/useLanguage.ts
export const useLanguage = () => {
  const context = useContext(AppContext)
  if (!context) {
    throw new Error('useLanguage must be used within AppProvider')
  }
  return { language: context.language, setLanguage: context.setLanguage }
}
```

## 🌐 Internationalization (i18n)

### Jazykové súbory
```typescript
// locales/sk.ts
export const sk = {
  nav: {
    home: 'Domov',
    about: 'O nás',
    projects: 'Projekty',
    news: 'Novinky',
    contact: 'Kontakt'
  },
  hero: {
    title: 'Sociálne inovácie',
    subtitle: 'Podporujeme a rozvíjame sociálne inovácie pre lepšiu budúcnosť Slovenska'
  }
}

// hooks/useTranslation.ts
export const useTranslation = () => {
  const { language } = useLanguage()
  const translations = language === 'sk' ? sk : en
  
  const t = (key: string) => {
    return key.split('.').reduce((obj, k) => obj?.[k], translations) || key
  }
  
  return { t }
}
```

## 🚀 Deployment

### Build pre production
```bash
# Vytvoriť production build
npm run build

# Výstup bude v ./dist priečinku
# Nahrať obsah dist/ priečinka na web server
```

### Environment premenné
```bash
# .env.production
VITE_API_BASE_URL=https://api.socialneinovacie.gov.sk
VITE_APP_VERSION=1.0.0
```

### Docker deployment
```dockerfile
# Dockerfile
FROM node:18-alpine as builder
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

FROM nginx:alpine
COPY --from=builder /app/dist /usr/share/nginx/html
COPY nginx.conf /etc/nginx/nginx.conf
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
```

## 📊 Bundle analýza

```bash
# Analyzovať veľkosť bundle
npm run build && npx vite-bundle-analyzer dist

# Výsledok:
# vendor.js: ~150KB (React, React DOM)
# main.js: ~50KB (aplikačný kód)
# styles.css: ~25KB (Tailwind CSS)
```

## 🔧 Konfigurácia IDE

### VS Code extensions
- ES7+ React/Redux/React-Native snippets
- TypeScript Importer
- Tailwind CSS IntelliSense
- Auto Rename Tag
- Bracket Pair Colorizer

### ESLint konfigurácia
```json
{
  "extends": [
    "@typescript-eslint/recommended",
    "plugin:react/recommended",
    "plugin:react-hooks/recommended",
    "plugin:jsx-a11y/recommended"
  ]
}
```

## 🐛 Troubleshooting

### Časté problémy:

1. **TypeScript errors po npm install**
   ```bash
   rm -rf node_modules package-lock.json
   npm install
   ```

2. **Tailwind styles sa neaplikujú**
   - Skontrolovať tailwind.config.js content paths
   - Reštartovať dev server

3. **Build fails**
   ```bash
   npm run type-check  # Skontrolovať TypeScript errors
   npm run lint        # Skontrolovať ESLint errors
   ```

## 📞 Podpora

Pre otázky k React verzii:
- Email: react-dev@socialneinovacie.gov.sk
- GitHub Issues: [Otvoriť issue](link)
