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

kalo belom install font awesome, install dulu yakk
```
npm install --save @fortawesome/fontawesome-free
```

# Update List
- sudah ada home yang menggunakan ajax
- sudah bisa check history
- penambahan history di header

# TODO
- admin dashboard dan admin login
- admin auth
