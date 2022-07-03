<?php

use Illuminate\Database\Seeder;
use App\Province;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('provinces')->delete(); 

        $provinces = [
            [
                'id'             => 1,
                'name'      => 'Province 1',
                'name_ne'   => 'प्रदेश नं. १',
            ],
            [
                'id'             => 2,
                'name'      => 'Madhesh Province',                
                'name_ne'   => 'मधेश प्रदेश',
            ],
            [
                'id'             => 3,
                'name'      => 'Bagmati Province',
                'name_ne'   => 'बागमती प्रदेश',
            ],
            [
                'id'             => 4,
                'name'      => 'Gandaki Province',
                'name_ne'   => 'गण्डकी प्रदेश',
            ],
            [
                'id'             => 5,
                'name'      => 'Lumbini Province',
                'name_ne'   => 'लुम्बिनी प्रदेश',
            ],
            [
                'id'             => 6,
                'name'      => 'Karnali Province',
                'name_ne'   => 'कर्णाली प्रदेश',
            ],
            [
                'id'             => 7,
                'name'      => 'Sudurpashchim Province',
                'name_ne'   => 'सुदुर पश्चिम प्रदेश',
            ],
        ];

        Province::insert($provinces);
    }
}
