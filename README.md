# TOLONG DILIHAT DAN DIPAKAI

nanti tolong kalo udah di pull tolong di install

```
php composer update
php artisan ui bootstrap
npm install
npm run watch
```

kalau misalkan di npm run dev ada masalah
```
npm install
```

jangan lupa buat migrate refresh data dan ditaro di database\seeds\DatabaseSeeder.php
```
php artisan migrate:fresh --seed
```

# Update List
- sudah ada buat check hotel berdasarkan provinsi
- sudah ada buat check untuk liat room
- sudah bisa rent room
- sudah bisa check history
- penambahan history di header
