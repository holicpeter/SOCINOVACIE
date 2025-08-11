# WordPress Installation Guide for Sociálne Inovácie v8 Theme
# =============================================================

## KROK 1: Stiahnutie WordPress
# 1. Choď na https://wordpress.org/download/
# 2. Stiahni najnovšiu verziu WordPress
# 3. Rozbaľ do web server priečinka (napr. htdocs, www, public_html)

## KROK 2: Vytvorenie databázy
# 1. Vytvor MySQL/MariaDB databázu
# 2. Vytvor databázového užívateľa s plnými právami
# 3. Poznač si: názov DB, užívateľ, heslo, host

## KROK 3: Konfigurácia wp-config.php
# 1. Skopíruj wp-config-sample.php na wp-config.php
# 2. Vyplň databázové údaje:

# define('DB_NAME', 'database_name_here');
# define('DB_USER', 'username_here');
# define('DB_PASSWORD', 'password_here');
# define('DB_HOST', 'localhost');

## KROK 4: Inštalácia WordPress témy v8
# 1. Skopíruj priečinok 'verzia8-wordpress' do /wp-content/themes/
# 2. Premenuj na 'socialne-inovacie-v8'

## KROK 5: Aktivácia témy
# 1. Choď do WordPress admin (yoursite.com/wp-admin)
# 2. Appearance → Themes
# 3. Aktivuj "Sociálne Inovácie v8 - Light Mode"

## KROK 6: Konfigurácia obsahu
# 1. Nastavenia → Permalinks → Post name
# 2. Vytvor menu: Appearance → Menus
# 3. Nastavenia → Reading → Static page (ak chceš)

## KROK 7: Import demo obsahu (voliteľné)
# 1. Tools → Import
# 2. Importuj demo obsah alebo vytvor ručne

## KROK 8: NASES compliance check
# 1. Skontroluj všetky accessibility funkcie
# 2. Validuj HTML na validator.w3.org
# 3. Otestuj keyboard navigation
# 4. Skontroluj color contrast

# =============================================================
# Pre lokálne testovanie môžeš použiť:
# - XAMPP (Windows)
# - MAMP (Mac)
# - Local by Flywheel
# - Docker WordPress
# =============================================================
