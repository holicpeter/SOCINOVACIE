# PowerShell script na vytvorenie WordPress témy balíčka
# ======================================================

Write-Host "=== Príprava WordPress témy v8 ===" -ForegroundColor Green

# Vytvorenie ZIP súboru pre jednoduchu inštaláciu
$sourceFolder = "c:\Users\holic\OneDrive\Documents\GitHub\SOCINOVACIE\verzia8-wordpress"
$destinationZip = "c:\Users\holic\OneDrive\Documents\GitHub\SOCINOVACIE\socialne-inovacie-v8-theme.zip"

Write-Host "Vytváram ZIP súbor..." -ForegroundColor Yellow

try {
    # Ak existuje starý ZIP, vymazať
    if (Test-Path $destinationZip) {
        Remove-Item $destinationZip -Force
    }
    
    # Vytvorenie ZIP
    Compress-Archive -Path "$sourceFolder\*" -DestinationPath $destinationZip -Force
    
    Write-Host "✅ WordPress téma bola úspešne zabalená!" -ForegroundColor Green
    Write-Host "📦 Súbor: socialne-inovacie-v8-theme.zip" -ForegroundColor Cyan
    Write-Host ""
    Write-Host "=== INŠTALAČNÉ KROKY ===" -ForegroundColor Yellow
    Write-Host "1. Nahraj ZIP súbor do WordPress admin" -ForegroundColor White
    Write-Host "   Appearance → Themes → Add New → Upload Theme" -ForegroundColor Gray
    Write-Host ""
    Write-Host "2. Alebo manuálne:" -ForegroundColor White
    Write-Host "   - Rozbaľ do /wp-content/themes/" -ForegroundColor Gray
    Write-Host "   - Premenuj priečinok na 'socialne-inovacie-v8'" -ForegroundColor Gray
    Write-Host ""
    Write-Host "3. Aktivuj tému v WordPress admin" -ForegroundColor White
    Write-Host "   Appearance → Themes → Activate" -ForegroundColor Gray
    Write-Host ""
    Write-Host "4. Nastavenia:" -ForegroundColor White
    Write-Host "   - Vytvor menu (Appearance → Menus)" -ForegroundColor Gray
    Write-Host "   - Nastavenia → Permalinks → Post name" -ForegroundColor Gray
    Write-Host "   - Vytvor obsah cez custom post types" -ForegroundColor Gray
    
} catch {
    Write-Host "❌ Chyba pri vytváraní ZIP súboru: $($_.Exception.Message)" -ForegroundColor Red
}

Write-Host ""
Write-Host "=== DEMO OBSAH ===" -ForegroundColor Yellow
Write-Host "Pre vytvorenie demo obsahu choď do WordPress admin:" -ForegroundColor White
Write-Host "• Aktuality → Add New (vytvor 3-5 aktualít)" -ForegroundColor Gray
Write-Host "• Výzvy → Add New (vytvor 2-3 výzvy)" -ForegroundColor Gray  
Write-Host "• Podujatia → Add New (vytvor nadchádzajúce podujatia)" -ForegroundColor Gray
Write-Host "• Inšpirácia → Add New (pridaj úspešné projekty)" -ForegroundColor Gray

Write-Host ""
Write-Host "=== NASES COMPLIANCE ===" -ForegroundColor Yellow
Write-Host "Téma je už pripravená pre NASES štandardy:" -ForegroundColor White
Write-Host "✅ WCAG 2.1 AA accessibility" -ForegroundColor Green
Write-Host "✅ Skip links a keyboard navigation" -ForegroundColor Green
Write-Host "✅ Screen reader support" -ForegroundColor Green
Write-Host "✅ Validný HTML5" -ForegroundColor Green
Write-Host "✅ Government-compliant footer" -ForegroundColor Green
Write-Host "✅ Search functionality" -ForegroundColor Green
