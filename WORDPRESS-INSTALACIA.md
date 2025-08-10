# WordPress Inštalácia pre Sociálne inovácie

## Rýchla inštalácia s XAMPP

### 1. Stiahnite XAMPP
- Prejdite na: https://www.apachefriends.org/
- Stiahnite PHP 8.0+ verziu pre Windows
- Nainštalujte (zaškrtnite Apache, MySQL, PHP)

### 2. Spustite servery
- Otvorte XAMPP Control Panel
- Spustite Apache a MySQL

### 3. Stiahnite WordPress
- Prejdite na: https://wordpress.org/download/
- Stiahnite najnovšiu verziu
- Rozbaľte do `C:\xampp\htdocs\socinovacie\`

### 4. Vytvorte databázu
- Otvorte: http://localhost/phpmyadmin
- Vytvorte novú databázu: `socinovacie`

### 5. Nainštalujte WordPress
- Otvorte: http://localhost/socinovacie
- Postupujte podľa inštalačného sprievodcu

### 6. Nahrajte tému
- Skopírujte obsah `verzia4-wordpress/` do:
  `C:\xampp\htdocs\socinovacie\wp-content\themes\socialne-inovacie\`

### 7. Aktivujte tému
- WP Admin → Vzhľad → Témy
- Aktivujte "Sociálne inovácie Gov.sk"

## Alternatívne riešenia

### Local by Flywheel
- Stiahnite: https://localwp.com/
- Jednoklikové WordPress prostredie
- Automatická SSL podpora

### Docker (pre pokročilých)
```bash
docker run --name socinovacie-wp -p 8080:80 -d wordpress
```

### Online demo
- WordPress.com
- InfinityFree.net
- 000webhost.com

## Po inštalácii
1. Nahrajte demo obsah (Aktuality, Výzvy, Podujatia)
2. Nastavte menu v Vzhľad → Menu
3. Nakonfigurujte widgety
4. Otestujte accessibility features

---
**Výsledok:** http://localhost/socinovacie
