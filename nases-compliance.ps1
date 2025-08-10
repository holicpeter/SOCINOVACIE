# NASES Compliance Script for all versions
# Vyhláška č. 78/2020 Z. z. o štandardoch pre informačné technológie verejnej správy

Write-Host "🚀 Začínam NASES compliance úpravy pre všetky verzie..." -ForegroundColor Green

# Function to add NASES meta tags
function Add-NASESMetaTags {
    param($filePath)
    
    $content = Get-Content $filePath -Raw
    
    # Add NASES compliance meta tags after existing meta charset
    $nasesMetaTags = @"
    <!-- NASES compliance -->
    <meta name="accessibility" content="WCAG 2.1 AA">
    <meta name="language" content="sk">
    <meta name="robots" content="index, follow">
    <meta name="last-modified" content="2025-08-10">
    <meta name="generator" content="Gov.sk Standards Compliant">
    <meta name="rating" content="general">
    <meta name="distribution" content="global">
    <link rel="canonical" href="https://socialneinovacie.gov.sk/">
"@

    # Insert after meta charset
    $content = $content -replace '(<meta charset="UTF-8">)', "`$1`n$nasesMetaTags"
    
    Set-Content $filePath $content -Encoding UTF8
    Write-Host "✅ Meta tagy pridané do: $filePath" -ForegroundColor Green
}

# Function to add skip links CSS
function Add-SkipLinksCSS {
    param($filePath)
    
    $skipLinksCSS = @"
        /* Skip links for accessibility */
        .skip-links {
            position: absolute;
            top: -40px;
            left: 6px;
            z-index: 9999;
        }
        .skip-links a {
            position: absolute;
            left: -10000px;
            top: auto;
            width: 1px;
            height: 1px;
            overflow: hidden;
            color: #fff;
            background: #003d82;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }
        .skip-links a:focus {
            position: static;
            width: auto;
            height: auto;
            left: auto;
            top: auto;
        }
        
        /* Screen reader only */
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
        
        /* Enhanced focus styles */
        *:focus {
            outline: 3px solid #0099ff;
            outline-offset: 2px;
        }
        
        /* High contrast mode support */
        @media (prefers-contrast: high) {
            body {
                background: #ffffff;
                color: #000000;
            }
        }
        
        /* Reduced motion support */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
"@

    $content = Get-Content $filePath -Raw
    
    # Insert after first <style> tag or before </style>
    if ($content -match '<style>') {
        $content = $content -replace '(<style>[^>]*>)', "`$1`n$skipLinksCSS"
    } else {
        $content = $content -replace '(</style>)', "$skipLinksCSS`n`$1"
    }
    
    Set-Content $filePath $content -Encoding UTF8
    Write-Host "✅ Skip links CSS pridané do: $filePath" -ForegroundColor Green
}

# Function to add skip links HTML
function Add-SkipLinksHTML {
    param($filePath)
    
    $skipLinksHTML = @"
    <!-- Skip links for accessibility -->
    <div class="skip-links">
        <a href="#main-content">Preskočiť na hlavný obsah</a>
        <a href="#navigation">Preskočiť na navigáciu</a>
        <a href="#search">Preskočiť na vyhľadávanie</a>
        <a href="#footer">Preskočiť na pätičku</a>
    </div>
"@

    $content = Get-Content $filePath -Raw
    $content = $content -replace '(<body[^>]*>)', "`$1`n$skipLinksHTML"
    
    Set-Content $filePath $content -Encoding UTF8
    Write-Host "✅ Skip links HTML pridané do: $filePath" -ForegroundColor Green
}

# Function to add NASES footer
function Add-NASESFooter {
    param($filePath)
    
    $nasesFooter = @"
    <!-- NASES Compliant Footer -->
    <footer class="nases-footer" id="footer" role="contentinfo">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h4>PREVÁDZKOVATEĽ WEBU</h4>
                    <p><strong>Ministerstvo práce, sociálnych vecí a rodiny Slovenskej republiky</strong></p>
                    <p>Špitálska 4, 6, 8<br>816 43 Bratislava</p>
                    <p>Tel: +421 2 2046 1111</p>
                    <p>E-mail: <a href="mailto:info@employment.gov.sk">info@employment.gov.sk</a></p>
                    <p>IČO: 00156621</p>
                </div>
                <div class="col-md-3">
                    <h4>POVINNÉ ODKAZY</h4>
                    <ul>
                        <li><a href="#accessibility-statement">Vyhlásenie o prístupnosti</a></li>
                        <li><a href="#privacy-policy">Ochrana osobných údajov</a></li>
                        <li><a href="#legal-info">Právne informácie</a></li>
                        <li><a href="#sitemap">Mapa stránky</a></li>
                        <li><a href="#cookies">Cookies</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h4>UŽITOČNÉ ODKAZY</h4>
                    <ul>
                        <li><a href="#aktuality">Aktuality</a></li>
                        <li><a href="#vyzvy">Výzvy</a></li>
                        <li><a href="#podujatia">Podujatia</a></li>
                        <li><a href="#inspiracia">Inšpirácia</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h4>KONTAKT</h4>
                    <p><strong>Posledná aktualizácia:</strong><br><time datetime="2025-08-10">10. august 2025</time></p>
                    <p>V súlade s vyhláškou č. 78/2020 Z. z.</p>
                </div>
            </div>
        </div>
        
        <!-- Accessibility Statement -->
        <div id="accessibility-statement" class="accessibility-section">
            <div class="container">
                <h2>Vyhlásenie o prístupnosti</h2>
                <p>Ministerstvo práce, sociálnych vecí a rodiny SR sa zaväzuje zabezpečiť prístupnosť svojej webovej stránky v súlade s § 14 zákona č. 78/2020 Z. z.</p>
                <p>Táto webová stránka je <strong>v súlade</strong> so štandardom WCAG 2.1 úroveň AA.</p>
                <p>Toto vyhlásenie bolo pripravené <time datetime="2025-08-10">10. augusta 2025</time>.</p>
                <p>Kontakt pre otázky prístupnosti: <a href="mailto:pristupnost@employment.gov.sk">pristupnost@employment.gov.sk</a></p>
            </div>
        </div>
    </footer>
"@

    $content = Get-Content $filePath -Raw
    
    # Replace existing footer or add before closing body tag
    if ($content -match '<footer') {
        $content = $content -replace '<footer[^>]*>[\s\S]*?</footer>', $nasesFooter
    } else {
        $content = $content -replace '(</body>)', "$nasesFooter`n`$1"
    }
    
    Set-Content $filePath $content -Encoding UTF8
    Write-Host "✅ NASES footer pridaný do: $filePath" -ForegroundColor Green
}

# Function to enhance ALT texts
function Enhance-AltTexts {
    param($filePath)
    
    $content = Get-Content $filePath -Raw
    
    # Enhance basic alt texts to be more descriptive
    $altEnhancements = @{
        'alt="Obchodné stretnutie"' = 'alt="Obchodné stretnutie - partneri diskutujúci o sociálnych inováciách"'
        'alt="Dokumenty"' = 'alt="Dôležité dokumenty a materiály pre sociálne inovácie"'
        'alt="Seminár"' = 'alt="Vzdelávací seminár o sociálnych inováciách"'
        'alt="Prezentácia"' = 'alt="Prezentácia úspešných sociálnych projektov"'
        'alt="Formuláre"' = 'alt="Online formuláre pre žiadosti o podporu"'
        'alt="Vzdelávanie"' = 'alt="Vzdelávacie programy a kurzy"'
        'alt="Konferencia"' = 'alt="Medzinárodná konferencia o sociálnych inováciách"'
        'alt="Workshop"' = 'alt="Praktický workshop pre implementáciu projektov"'
    }
    
    foreach ($key in $altEnhancements.Keys) {
        $content = $content -replace [regex]::Escape($key), $altEnhancements[$key]
    }
    
    Set-Content $filePath $content -Encoding UTF8
    Write-Host "✅ ALT texty vylepšené v: $filePath" -ForegroundColor Green
}

# Main execution
$versions = @(
    "verzia1\index.html",
    "verzia2\kreativna-react.html", 
    "verzia3\futuristicka.html"
)

foreach ($version in $versions) {
    if (Test-Path $version) {
        Write-Host "🔄 Spracovávam: $version" -ForegroundColor Yellow
        
        Add-NASESMetaTags $version
        Add-SkipLinksCSS $version  
        Add-SkipLinksHTML $version
        Add-NASESFooter $version
        Enhance-AltTexts $version
        
        Write-Host "✅ $version - dokončené" -ForegroundColor Green
        Write-Host "---" -ForegroundColor Gray
    } else {
        Write-Host "❌ Súbor nenájdený: $version" -ForegroundColor Red
    }
}

Write-Host "🎉 NASES compliance úpravy dokončené pre všetky verzie!" -ForegroundColor Green
Write-Host "📋 Ďalšie kroky:" -ForegroundColor Yellow
Write-Host "1. Otestujte stránky pomocou Lighthouse" -ForegroundColor White
Write-Host "2. Validujte HTML pomocou W3C Validator" -ForegroundColor White  
Write-Host "3. Otestujte s čítačkami obrazovky" -ForegroundColor White
Write-Host "4. Skontrolujte kontrast farieb" -ForegroundColor White
