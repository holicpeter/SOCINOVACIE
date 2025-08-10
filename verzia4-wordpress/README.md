# WordPress Téma pre socialneinovacie.gov.sk

## Popis
Oficiálna WordPress téma pre portál sociálnych inovácií Ministerstva práce, sociálnych vecí a rodiny SR. Téma je plne kompatibilná s požiadavkami NASES a spĺňa štandardy Vyhlášky č. 78/2020 o štandardoch pre ISVS.

## Funkcie

### 🔒 NASES Compliance
- ✅ WCAG 2.1 úroveň AA
- ✅ Európska norma EN 301 549
- ✅ Vyhláška č. 78/2020 (§14-§25)
- ✅ Skip links pre prístupnosť
- ✅ Správne ARIA značky
- ✅ Klávesová navigácia
- ✅ Screen reader podpora
- ✅ Vysoký kontrast
- ✅ Podpora zmenšenej animácie

### 🎨 Design
- ✅ Oficiálne gov.sk farby
- ✅ Responzívny dizajn
- ✅ Light mode optimalizácia
- ✅ Mini obrázky v kartách
- ✅ Moderné card layouts
- ✅ Typography scale
- ✅ Accessibility controls

### 📝 Content Management
- ✅ Custom post types (Aktuality, Výzvy, Podujatia)
- ✅ Meta fields pre dodatočné informácie
- ✅ Kategórie a tagy
- ✅ Featured images
- ✅ SEO optimalizácia
- ✅ Social sharing
- ✅ RSS feeds

### 🌐 Multijazyčnosť
- ✅ Slovenčina (primárny jazyk)
- ✅ Angličtina (sekundárny jazyk)
- ✅ WPML kompatibilita
- ✅ Proper hreflang značky

## Inštalácia

1. **Nahrajte tému do WordPress**
   ```
   wp-content/themes/socialne-inovacie/
   ```

2. **Aktivujte tému**
   - Prejdite do WP Admin → Vzhľad → Témy
   - Aktivujte "Sociálne inovácie Gov.sk"

3. **Importujte ukážkový obsah**
   - Aktuality, Výzvy, Podujatia sa automaticky registrujú
   - Vytvorte menu v Vzhľad → Menu

4. **Nastavte widgety**
   - Footer 1, 2, 3 pre footer sekcie
   - Sidebar pre bočný panel

## Štruktúra súborov

```
socialne-inovacie/
├── style.css                 # Hlavný stylesheet s NASES compliance
├── functions.php             # WordPress funkcie a registrácie
├── header.php               # Header template
├── footer.php               # Footer template
├── index.php                # Hlavný template
├── front-page.php           # Template pre hlavnú stránku
├── single.php               # Template pre jednotlivé príspevky
├── archive-aktuality.php    # Archív aktualít
├── archive-vyzvy.php        # Archív výziev
├── archive-podujatia.php    # Archív podujatí
├── sidebar.php              # Sidebar template
├── searchform.php           # Vyhľadávací formulár
├── 404.php                  # Error 404 stránka
├── js/
│   ├── main.js              # Hlavný JavaScript
│   └── accessibility.js     # Accessibility funkcie
├── images/                  # Obrázky témy
├── languages/               # Jazykové súbory
└── README.md               # Tento súbor
```

## Custom Post Types

### Aktuality (`aktuality`)
- Novinky a oznamy
- Featured image
- Excerpt
- Kategórie
- Publish date

### Výzvy (`vyzvy`)
- Calls for proposals
- Meta fields:
  - `_vyzva_amount` - Výška podpory
  - `_vyzva_status` - Status (Aktívna/Neaktívna/Ukončená)
  - `_vyzva_deadline` - Termín podania

### Podujatia (`podujatia`)
- Events a workshopy
- Meta fields:
  - `_podujatie_location` - Miesto konania
  - `_podujatie_date` - Dátum
  - `_podujatie_time` - Čas
  - `_podujatie_capacity` - Kapacita

## Customizer Nastavenia

### Site Identity
- Logo nahrávania
- Site title a subtitle
- Site icon (favicon)

### Farby
- Primary color (štandardne #003d82)
- Secondary colors
- Custom color picker

### Footer
- Footer text
- Copyright informácie
- Contact details

### Typography
- Font selections
- Size controls
- Line height options

## JavaScript Funkcie

### main.js
- Navigation functionality
- Mobile menu
- Back to top button
- Search enhancements
- Card animations
- Social sharing

### accessibility.js
- NASES compliance features
- Keyboard navigation
- Focus management
- Screen reader support
- Text size controls
- High contrast mode
- ARIA enhancements

## CSS Triedy

### Layout
- `.container` - Main container (max-width: 1200px)
- `.card-grid` - Grid layout pre karty
- `.content-card` - Základná karta
- `.hero-section` - Hero sekcia

### Accessibility
- `.skip-links` - Skip navigation
- `.screen-reader-text` - Screen reader only text
- `.focus-visible` - Focus indicators
- `.high-contrast` - High contrast mode

### Content Cards
- `.card-with-image` - Karta s obrázkom
- `.card-image` - Obrázok karty (120×80px)
- `.card-content` - Obsah karty
- `.card-meta` - Meta informácie
- `.card-badge` - Kategória badge
- `.card-title-small` - Malý nadpis
- `.card-description-small` - Malý popis

### Category Colors
- `.category-aktuality` - Modrá (#003d82)
- `.category-vyzvy` - Oranžová (#ff6b35)
- `.category-podujatia` - Zelená (#28a745)
- `.category-inspiracia` - Svetlo modrá (#4a90e2)

## Prístupnosť Features

### WCAG 2.1 AA Compliance
- Contrast ratio 4.5:1 pre normálny text
- Contrast ratio 3:1 pre veľký text
- Focus indicators na všetkých interaktívnych prvkoch
- Alt texty pre všetky obrázky
- Proper heading hierarchy (h1-h6)

### Keyboard Navigation
- Tab order navigation
- Arrow key menu navigation
- Escape key handling
- Space/Enter activation
- Skip links functionality

### Screen Reader Support
- Semantic HTML5 elements
- ARIA labels a roles
- Live regions pre dynamic content
- Proper form labeling
- Descriptive link text

### Responsive Design
- Mobile-first approach
- Breakpoints: 768px, 480px
- Touch-friendly interface
- Readable font sizes
- Adequate spacing

## SEO Optimalizácia

### Meta Tags
- Dublin Core metadata
- Open Graph tags
- Twitter Card data
- Canonical URLs
- Hreflang attributes

### Structured Data
- Organization schema
- Article schema
- Event schema
- BreadcrumbList schema

### Performance
- Optimized images
- Minified CSS/JS
- Critical CSS inlining
- Lazy loading images

## Security Features

### Headers
- X-Content-Type-Options
- X-Frame-Options
- X-XSS-Protection
- Referrer-Policy

### Data Sanitization
- Input sanitization
- Output escaping
- Nonce verification
- SQL injection protection

## Browser Support

- Chrome 70+
- Firefox 65+
- Safari 12+
- Edge 79+
- Internet Explorer 11 (basic support)

## Testovanie

### Accessibility Testing
- WAVE Web Accessibility Evaluation Tool
- axe DevTools
- Screen reader testing (NVDA, JAWS)
- Keyboard-only navigation
- High contrast mode

### Performance Testing
- Google PageSpeed Insights
- GTmetrix
- WebPageTest
- Lighthouse audit

### Cross-browser Testing
- BrowserStack
- Manual testing
- Responsive design testing

## Podpora

Pre technickú podporu a otázky kontaktujte:
- Email: info@employment.gov.sk
- Web: https://www.employment.gov.sk
- GitHub: Issues v tomto repository

## Licencia

GPL v2 or later

## Changelog

### v1.0.0 (2024)
- Prvé vydanie
- NASES compliance
- Custom post types
- Responsive design
- Accessibility features
- Gov.sk color scheme
- Mini images v kartách

---

© 2024 Ministerstvo práce, sociálnych vecí a rodiny Slovenskej republiky
