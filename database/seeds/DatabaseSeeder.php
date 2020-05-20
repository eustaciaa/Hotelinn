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
        $hotel->rate = "5";
        $hotel->photo = "/images/hotel/fraser-residence-menteng/home.jpg";
        $hotel->save();

        $alamat = new App\alamat;
        $alamat->provinsi_id = 1;
        $alamat->kota_id = 1;
        $alamat->detailLengkap = "Jl. Menteng Raya No. 60, Menteng Jakarta 10340,Indonesia";

        $hotel->alamat()->save($alamat);

        $room = new App\room_details;
        $room->name = "Studio Executive";
        $room->cost = 1200000;
        $room->capacity = 1;
        $room->available = 3;
        $room->photo = "/images/hotel/fraser-residence-menteng/studio-executive.jpg";
        $hotel->room()->save($room);

        $room = new App\room_details;
        $room->name = "Studio Premiere";
        $room->cost = 1500000;
        $room->capacity = 2;
        $room->available = 3;
        $room->photo = "/images/hotel/fraser-residence-menteng/studio-premiere.jpeg";
        $hotel->room()->save($room);

        $room = new App\room_details;
        $room->name = "Apartment Executive";
        $room->cost = 2500000;
        $room->capacity = 4;
        $room->available = 2;
        $room->photo = "/images/hotel/fraser-residence-menteng/apartment-executive.jpg";
        $hotel->room()->save($room);


        $hotel = new App\hotel;
        $hotel->name = "Business Tomang";
        $hotel->rate = "3";
        $hotel->photo = '/images/hotel/business-tomang/home.jpeg';
        $hotel->save();


        $alamat = new App\alamat;
        $alamat->provinsi_id = 1;
        $alamat->kota_id = 1;
        $alamat->detailLengkap = "Jl. Raya Tomang No.51, 11440, Jakarta, Indonesia";

        $hotel->alamat()->save($alamat);

        $room = new App\room_details;
        $room->name = "Standard Double Room";
        $room->cost = 225000;
        $room->capacity = 2;
        $room->available = 5;
        $room->photo = '/images/hotel/business-tomang/standard-double-room.jpeg';
        $hotel->room()->save($room);

        $room = new App\room_details;
        $room->name = "Deluxe Twin Room";
        $room->cost = 175000;
        $room->capacity = 1;
        $room->available = 0;
        $room->photo = '/images/hotel/business-tomang/deluxe-twin-room.jpg';
        $hotel->room()->save($room);    

        $hotel = new App\hotel;
        $hotel->name = "Jambuluwuk Malioboro";
        $hotel->rate = "5";
        $hotel->photo = "/images/hotel/jambuluwuk-malioboro/home.jpeg";
        $hotel->save();

        $alamat = new App\Alamat;
        $alamat->provinsi_id = 2;
        $alamat->kota_id = 2;
        $alamat->detailLengkap = "Jl. Gajah Mada No. 67, 55112, Yogyakarta, Indonesia";
        $hotel->alamat()->save($alamat);

        
    }
}
