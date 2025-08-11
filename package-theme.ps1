# WordPress Theme Package Creator
Write-Host "=== WordPress Theme v8 Package Creator ===" -ForegroundColor Green

$sourceFolder = "c:\Users\holic\OneDrive\Documents\GitHub\SOCINOVACIE\verzia8-wordpress"
$destinationZip = "c:\Users\holic\OneDrive\Documents\GitHub\SOCINOVACIE\socialne-inovacie-v8-theme.zip"

Write-Host "Creating ZIP package..." -ForegroundColor Yellow

if (Test-Path $destinationZip) {
    Remove-Item $destinationZip -Force
}

Compress-Archive -Path "$sourceFolder\*" -DestinationPath $destinationZip -Force

Write-Host "SUCCESS: WordPress theme packaged!" -ForegroundColor Green
Write-Host "File: socialne-inovacie-v8-theme.zip" -ForegroundColor Cyan
Write-Host ""
Write-Host "INSTALLATION STEPS:" -ForegroundColor Yellow
Write-Host "1. Upload ZIP to WordPress admin" -ForegroundColor White
Write-Host "   Appearance > Themes > Add New > Upload Theme" -ForegroundColor Gray
Write-Host "2. OR manually extract to /wp-content/themes/" -ForegroundColor White
Write-Host "3. Activate theme in WordPress admin" -ForegroundColor White
Write-Host "4. Create menus and content" -ForegroundColor White
