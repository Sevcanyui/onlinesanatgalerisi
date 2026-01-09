# onlinesanatgalerisi

Bu proje, PHP ve MySQL kullanılarak geliştirilmiş bir **Online Sanat Galerisi** uygulamasıdır.  
Kullanıcılar sanat eserlerini görüntüleyebilir, eser yükleyebilir ve bildirim alabilir.  
Yönetici (admin) paneli sayesinde eser onaylama ve kullanıcı yönetimi yapılabilir.

---

##  Özellikler

- Sanat eserlerini listeleme
- Eser detay sayfası
- Kullanıcı kayıt & giriş sistemi
- Bildirim sistemi
- Sanatçı profili bağlantısı
- Admin paneli
  - Eser onaylama
  - Kullanıcı yönetimi
-  Modern ve estetik tasarım (CSS)

---

## Kullanılan Teknolojiler

- PHP 
- MySQL (phpMyAdmin)
- HTML5
- CSS3
- JavaScript 
- Font Awesome

---

## Veritabanı Kurulumu

1. phpMyAdmin’e giriş yapın
2. `art_gallery` adlı bir veritabanı oluşturun
3. Bu repodaki **SQL dosyasını** içe aktarın  
   (Tablolar otomatik oluşacaktır)

---

## 🔐 Veritabanı Bağlantısı

1. `db_connect.example.php` dosyasını  
   `db_connect.php` olarak **yeniden adlandırın**
2. Kendi veritabanı bilgilerinizi girin:

```php
$host = "localhost";
$dbname = "art_gallery";
$username = "root";
$password = "";
