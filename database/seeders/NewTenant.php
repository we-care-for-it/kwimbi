<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\inspectionCompany;

class NewTenant extends Seeder
{
    /**
     * Run the database seeds.
     */ 
    public function run(): void
    {


        User::create([
            'name' => 'sysadmin',
            'email' => 'sysadmin@liftindex.nl',
            'password' => Hash::make('!Timmer2024@')
        ]);

        inspectionCompany::create([
            'name' => "Aboma B.V.",
            'address' => 'Maxwellstraat 49a',
            'zipcode' => '6716 BX',
            'place' => 'Ede',
            'phonenumber' => '0318 691 920',
            'website' => 'https://www.aboma.nl/',
            'general_emailaddress' => "info@aboma.nl",
        ]);

        inspectionCompany::create([
            'name' => "Dekra Certifications B.V.",
            'address' => 'Meander 1051',
            'zipcode' => '6825 MJ',
            'place' => 'Arnhem',
            'phonenumber' => '088 968 3000',
            'website' => 'https://www.dekra.nl/',
            'general_emailaddress' => "info@dekra.nl",
        ]);

        inspectionCompany::create([
            'name' => "HCC/DRS Inspecties B.V.",
            'address' => 'Kokkel 4-A',
            'zipcode' => '1723 HX',
            'place' => ' Noord-Scharwoude',
            'phonenumber' => '0226 321 229',
            'website' => 'https://www.hhcdrs.nl/',
            'general_emailaddress' => "info@hhcdrs.nl",
        ]);

        inspectionCompany::create([
            'name' => "Liftinstituut B.V.",
            'address' => 'Buikslotermeerplein 381',
            'zipcode' => '1025 XE',
            'place' => 'Amsterdam',
            'phonenumber' => '020 435 0606',
            'website' => 'https://www.liftinstituut.nl/',
            'general_emailaddress' => "info@liftinstituut.nl",
        ]);

        inspectionCompany::create([
            'name' => "Stichting Keuringsbureau Hout",
            'address' => 'Nieuwe Kanaal 9F',
            'zipcode' => '6709 PA ',
            'place' => 'Wageningen',
            'phonenumber' => '0317 - 45 34 25',
            'website' => 'https://www.skh.nl',
            'general_emailaddress' => "mail@skh.nl",
        ]);

        inspectionCompany::create([
            'name' => "TÜV NORD Nederland",
            'address' => 'Ekkersrijt 4401',
            'zipcode' => '5692DL ',
            'place' => 'Son en Breugel',
            'phonenumber' => '0499 - 339 500',
            'website' => 'https://www.tuv.nl/',
            'general_emailaddress' => "info@tuv.nl",
        ]);

        inspectionCompany::create([
            'name' => "Chex Liftkeuringen B.V.",
            'address' => 'Prins Mauritslaan 33',
            'zipcode' => '1171 LP',
            'place' => 'Badhoevedorp',
            'phonenumber' => "020 667 42 09",
            'website' => 'https://www.chex.nl/',
            'general_emailaddress' => "info@chex.nl",
        ]);



 


    }
}
