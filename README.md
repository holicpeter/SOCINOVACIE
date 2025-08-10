# Sociálne inovácie - Oficiálna webová stránka

Tento repozitár obsahuje tri rôzne verzie webovej stránky pre socialneinovacie.gov.sk, ktoré spĺňajú požiadavky NASES a Vyhlášky č. 78/2020 o štandardoch pre ISVS.

## 📁 Štruktúra projektu

### Verzia 1: Klasická HTML/CSS/Bootstrap verzia
- **Technológie**: HTML5, CSS3, Bootstrap 5, Vanilla JavaScript
- **Charakteristika**: Tradičný prístup, rýchle načítanie, maximálna kompatibilita
- **Umiestnenie**: `./verzia1/`

### Verzia 2: Moderná React aplikácia
- **Technológie**: React 18, TypeScript, Vite, Tailwind CSS, Framer Motion
- **Charakteristika**: Moderný používateľský zážitok, komponenty, SPA
- **Umiestnenie**: `./verzia2/`

### Verzia 3: Vue.js/Nuxt.js aplikácia
- **Technológie**: Vue 3, Nuxt 3, TypeScript, Tailwind CSS, Pinia
- **Charakteristika**: SSR/SSG, SEO optimalizácia, progresívna webová aplikácia
- **Umiestnenie**: `./verzia3/`

## 🏛️ NASES Compliance

Všetky tri verzie spĺňajú požiadavky Vyhlášky č. 78/2020, konkrétne §14 – §25:

### ✅ Požiadavky na dizajn a použiteľnosť (§14-§16)
- Responzívny dizajn pre všetky zariadenia
- Konzistentná navigácia a rozloženie
- Zrozumiteľná štruktúra informácií
- Optimalizácia pre rôzne rozlíšenia obrazoviek

### ✅ Accessibility (§17-§19)
- **WCAG 2.1 AA compliance**:
  - Skip links pre navigáciu klávesnicou
  - ARIA labels a live regions
  - Alternatívny text pre obrázky
  - Dostatočný farebný kontrast (4.5:1)
  - Podpora screen readerov
  - Keyboard navigation
  - Focus management

### ✅ Technické štandardy (§20-§22)
- Validný HTML5 a sémantické značky
- Progresívne vylepšovanie (Progressive Enhancement)
- Optimalizácia výkonu a rýchlosti načítania
- Cross-browser compatibility
- Secure HTTPS komunikácia
- Optimalizované obrázky a assety

### ✅ SEO a metadáta (§23-§25)
- Open Graph protokol
- Twitter Cards
- JSON-LD structured data
- Správne HTML meta tagy
- Sitemap.xml a robots.txt
- Canonical URLs

## 🚀 Spustenie projektov

### Verzia 1 (HTML/Bootstrap)
```bash
cd verzia1
# Otvorte index.html v prehliadači alebo použite live server
```

### Verzia 2 (React/Vite)
```bash
cd verzia2
npm install
npm run dev
# Otvorte http://localhost:3000
```

### Verzia 3 (Vue/Nuxt)
```bash
cd verzia3
npm install
npm run dev
# Otvorte http://localhost:3000
```

## 🔧 Build a deployment

### Verzia 1
Žiadny build proces nie je potrebný. Jednoducho uploadujte súbory na web server.

### Verzia 2
```bash
npm run build
# Výstup v ./dist/ priečinku
```

### Verzia 3
```bash
npm run generate  # Pre statické generovanie
npm run build     # Pre SSR deployment
```

## 📱 Funkcionalita

### Spoločné funkcie všetkých verzií:
- **Responzívny dizajn** - funguje na mobiloch, tabletoch a desktopoch
- **Accessibility features** - screen reader podpora, keyboard navigation
- **Dark mode podpora** - automatická detekcia preferencií používateľa
- **High contrast mode** - podpora pre používateľov s poruchami zraku
- **Multilingual podpora** - SK/EN jazykové verzie
- **SEO optimalizácia** - meta tagy, structured data
- **Performance optimization** - rýchle načítanie, lazy loading

### Sekcie stránky:
1. **Header s vládnou navigáciou** - gov.sk branding
2. **Hlavná navigácia** - prístupné menu
3. **Hero sekcia** - úvodný banner s call-to-action
4. **O sociálnych inováciách** - informačná sekcia
5. **Oblasti inovácií** - karty s rôznymi oblasťami
6. **Aktuality** - sekcia s novinkami a udalosťami
7. **Footer** - kontaktné informácie a odkazy

## 🔍 Testovanie accessibility

### Nástroje na testovanie:
- **WAVE Web Accessibility Evaluator**
- **axe DevTools**
- **Lighthouse Accessibility Audit**
- **Screen reader testing** (NVDA, JAWS)
- **Keyboard navigation testing**

### Checklist:
- [ ] Všetky interaktívne elementy sú prístupné klávesnicou
- [ ] Focus je viditeľný na všetkých elementoch
- [ ] ARIA labels sú správne implementované
- [ ] Farebný kontrast spĺňa WCAG štandardy
- [ ] Obrázky majú alt texty
- [ ] Formuláre majú správne labels
- [ ] Headings majú logickú hierarchiu

## 📊 Performance metriky

### Cieľové hodnoty:
- **First Contentful Paint**: < 1.5s
- **Largest Contentful Paint**: < 2.5s
- **Cumulative Layout Shift**: < 0.1
- **Time to Interactive**: < 3.5s
- **Lighthouse Score**: > 90

## 🔒 Bezpečnosť

### Implementované bezpečnostné opatrenia:
- Content Security Policy (CSP)
- HTTPS komunikácia
- Secure cookies
- XSS protection
- CSRF protection (pre formuláre)
- Input validation a sanitization

## 📞 Kontakt a podpora

Pre technické otázky a podporu kontaktujte:
- **Email**: info@socialneinovacie.gov.sk
- **Telefón**: +421 2 xxxx xxxx

## 📄 Licencia

Tento projekt je majetkom Ministerstva práce, sociálnych vecí a rodiny SR.
Všetky práva vyhradené © 2025.

---

*Verzia dokumentácie: 1.0*  
*Posledná aktualizácia: 2. august 2025*