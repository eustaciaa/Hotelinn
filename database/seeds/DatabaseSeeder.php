<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new App\User;
        $user->email = "test@test.com";
        $user->fName = "tester";
        $user->lName = "account";
        $user->password = Hash::make("test");
        $user->birthdate = "2012-12-12";
        $user->gender = 'M';
        $user->save();

        $user = new App\Admin;
        $user->fName = "admin";
        $user->username = "admin";
        $user->email = "admin@test.com";
        $user->password = Hash::make("admin");
        $user->save();

        $provinsi = new App\provinsi;
        $provinsi->namaProvinsi = "DKI Jakarta";
        $provinsi->save();

        $kota = new App\kota;
        $kota->namaKota = "Jakarta";
        $provinsi->kota()->save($kota);

        $provinsi = new App\provinsi;
        $provinsi->namaProvinsi = "D.I Yogyakarta";
        $provinsi->save();

        $kota = new App\kota;
        $kota->namaKota = "Yogyakarta";
        $provinsi->kota()->save($kota);

        $provinsi = new App\Provinsi;
        $provinsi->namaProvinsi = "Banten";
        $provinsi->save();

        $kota = new App\kota;
        $kota->namaKota = "Tangerang";
        $provinsi->kota()->save($kota);

        $kota = new App\kota;
        $kota->namaKota = "Tangerang Selatan";
        $provinsi->kota()->save($kota);

        $kota = new app\kota;
        $kota->namaKota = "Serang";
        $provinsi->kota()->save($kota);

        $hotel = new App\hotel;
        $hotel->name = "Fraser Residence Menteng";
        $hotel->star = 5;
        $hotel->photo = "/images/hotel/fraser-residence-menteng/home.jpg";
        $hotel->save();

        $this->call([
            HotelSeeder::class,
        ]);

    }
}
