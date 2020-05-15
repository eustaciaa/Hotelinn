<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $hotel = new App\hotel;
        $hotel->name = "Fraser Residence Menteng";
        $hotel->rate = "5";
        $hotel->save();

        $alamat = new App\alamat;
        $alamat->provinsi = "DKI Jakarta";
        $alamat->kota = "Jakarta";
        $alamat->detailLengkap = "Jl. Menteng Raya No. 60, Menteng Jakarta 10340,Indonesia";

        $hotel->alamat()->save($alamat);


        $hotel = new App\hotel;
        $hotel->name = "Business Tomang";
        $hotel->rate = "3";
        $hotel->save();

        $alamat = new App\alamat;
        $alamat->provinsi = 'DKI Jakarta';
        $alamat->kota = "Jakarta";
        $alamat->detailLengkap = "Jl. Raya Tomang No.51, 11440, Jakarta, Indonesia";

        $hotel->alamat()->save($alamat);

        $hotel = new App\hotel;
        $hotel->name = "Jambuluwuk Malioboro";
        $hotel->rate = "5";
        $hotel->save();

        $alamat = new App\Alamat;
        $alamat->provinsi = "D.I. Yogyakarta";
        $alamat->kota = "Yogyakarta";
        $alamat->detailLengkap = "Jl. Gajah Mada No. 67, 55112, Yogyakarta, Indonesia";
        $hotel->alamat()->save($alamat);
    }
}
