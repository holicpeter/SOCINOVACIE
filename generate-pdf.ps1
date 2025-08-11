# PDF Generation Script pre Verziu 1
# Vyžaduje Microsoft Edge alebo Chrome

$url = "https://bejewelled-heliotrope-63b544.netlify.app/verzia1/"
$outputPath = "c:\Users\holic\OneDrive\Documents\GitHub\SOCINOVACIE\verzia1-socialne-inovacie.pdf"

# Použitie Chrome headless
if (Get-Command chrome -ErrorAction SilentlyContinue) {
    Write-Host "Generujem PDF pomocou Chrome..."
    & chrome --headless --disable-gpu --print-to-pdf="$outputPath" "$url"
} 
# Použitie Edge headless
elseif (Get-Command msedge -ErrorAction SilentlyContinue) {
    Write-Host "Generujem PDF pomocou Edge..."
    & msedge --headless --disable-gpu --print-to-pdf="$outputPath" "$url"
}
else {
    Write-Host "ERROR: Chrome alebo Edge nie je nainštalovaný."
    Write-Host "Použite manuálny spôsob: Ctrl+P -> Save as PDF"
}

if (Test-Path $outputPath) {
    Write-Host "✅ PDF úspešne vytvorené: $outputPath"
    Start-Process $outputPath
} else {
    Write-Host "❌ PDF sa nepodarilo vytvoriť"
}
