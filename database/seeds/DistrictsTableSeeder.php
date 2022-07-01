<?php

use Illuminate\Database\Seeder;
use App\District;

class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        \DB::table('districts')->delete();

        $districts = [
            [
            'province_id' => 1,  
            'name' => 'Bhojpur',
            'name_ne' => 'भोजपुर',
            ],
            [
            'province_id' => 1,  
            'name' => 'Dhankuta',
            'name_ne' => 'धनकुटा',
            ],
            [
            'province_id' => 1,  
            'name' => 'Jhapa',
            'name_ne' => 'झापा',
            ],
            [
            'province_id' => 1,  
            'name' => 'Khotang',
            'name_ne' => 'खोटाङ',
            ],
            [
            'province_id' => 1,  
            'name' => 'Morang',
            'name_ne' => 'मोरङ',
            ],
            [
            'province_id' => 1,  
            'name' => 'Okhaldhunga',
            'name_ne' => 'ओखलढुंगा',
            ],
            [
            'province_id' => 1,  
            'name' => 'Panchthar',
            'name_ne' => 'पाँचथर',
            ],
            [
            'province_id' => 1,  
            'name' => 'Sankhuwasabha',
            'name_ne' => 'संखुवासभा',
            ],
            [
            'province_id' => 1,  
            'name' => 'Solukhumbu',
            'name_ne' => 'सोलुखुम्बु',
            ],
            [
            'province_id' => 1,  
            'name' => 'Sunsari',
            'name_ne' => 'सुनसरी',
            ],
            [
            'province_id' => 1,  
            'name' => 'Taplejung',
            'name_ne' => 'ताप्लेजुङ',
            ],
            [
            'province_id' => 1,  
            'name' => 'Terhathum',
            'name_ne' => 'तेह्रथुम',
            ],
            [
            'province_id' => 1,  
            'name' => 'Ilam',
            'name_ne' => 'इलाम',
            ],
            [
            'province_id' => 1,  
            'name' => 'Udayapur',
            'name_ne' => 'उदयपुर',
            ],
            [
            'province_id' => 2,  
            'name' => 'Dhanusha',
            'name_ne' => 'धनुषा',
            ],
            [
            'province_id' => 2,  
            'name' => 'Bara',
            'name_ne' => 'बारा',
            ],
            [
            'province_id' => 2,  
            'name' => 'Parsa',
            'name_ne' => 'पर्सा',
            ],
            [
            'province_id' => 2,  
            'name' => 'Rautahat',
            'name_ne' => 'रौतहट',
            ],
            [
            'province_id' => 2,  
            'name' => 'Siraha',
            'name_ne' => 'सिराहा',
            ],
            [
            'province_id' => 2,  
            'name' => 'Saptari',
            'name_ne' => 'सप्तरी',
            ],
            [
            'province_id' => 2,  
            'name' => 'Sarlahi',
            'name_ne' => 'सर्लाही',
            ],
            [
            'province_id' => 2,  
            'name' => 'Mahottari',
            'name_ne' => 'महोत्तरी',
            ],
            [
            'province_id' => 3,  
            'name' => 'Dolakha',
            'name_ne' => 'दोलखा',
            ],
            [
            'province_id' => 3,  
            'name' => 'Sindhupalchok',
            'name_ne' => 'सिन्धुपाल्चोक',
            ],
            [
            'province_id' => 3,  
            'name' => 'Rasuwa',
            'name_ne' => 'रसुवा',
            ],
            [
            'province_id' => 3,  
            'name' => 'Dhading',
            'name_ne' => 'धादिङ्ग',
            ],
            [
            'province_id' => 3,  
            'name' => 'Nuwakot',
            'name_ne' => 'नुवाकोट',
            ],
            [
            'province_id' => 3,  
            'name' => 'Kabhrepalanchok',
            'name_ne' => 'काभ्रेपलाञ्चोक',
            ],
            [
            'province_id' => 3,  
            'name' => 'Sindhuli',
            'name_ne' => 'सिन्धुली',
            ],
            [
            'province_id' => 3,  
            'name' => 'Ramechhap',
            'name_ne' => 'रामेछाप',
            ],
            [
            'province_id' => 3,  
            'name' => 'Makawanpur',
            'name_ne' => 'मकवानपुर',
            ],
            [
            'province_id' => 3,  
            'name' => 'Chitawan',
            'name_ne' => 'चितवन',
            ],
            [
            'province_id' => 3,  
            'name' => 'Kathmandu',
            'name_ne' => 'काठमाडौं',
            ],
            [
            'province_id' => 3,  
            'name' => 'Lalitpur',
            'name_ne' => 'ललितपुर',
            ],
            [
            'province_id' => 3,  
            'name' => 'Bhaktapur',
            'name_ne' => 'भक्तपुर',
            ],
            [
            'province_id' => 4,  
            'name' => 'Mustang',
            'name_ne' => 'मुस्तांग',
            ],
            [
            'province_id' => 4,  
            'name' => 'Myagdi',
            'name_ne' => 'म्याग्दी',
            ],
            [
            'province_id' => 4,  
            'name' => 'Baglung',
            'name_ne' => 'बागलुङ',
            ],
            [
            'province_id' => 4,  
            'name' => 'Manang',
            'name_ne' => 'मनाङ',
            ],
            [
            'province_id' => 4,  
            'name' => 'Kaski',
            'name_ne' => 'कास्की',
            ],
            [
            'province_id' => 4,  
            'name' => 'Parbat',
            'name_ne' => 'पर्वत',
            ],
            [
            'province_id' => 4,  
            'name' => 'Syangja',
            'name_ne' => 'स्याङ्‍जा',
            ],
            [
            'province_id' => 4,  
            'name' => 'East Nawalparasi',
            'name_ne' => 'नवलपरासी पूर्व',
            ],
            [
            'province_id' => 4,  
            'name' => 'Tanahu',
            'name_ne' => 'तनहुँ',
            ],
            [
            'province_id' => 4,  
            'name' => 'Lamjung',
            'name_ne' => 'लमजुङ',
            ],
            [
            'province_id' => 4,  
            'name' => 'Gorkha',
            'name_ne' => 'गोरखा',
            ],
            [
            'province_id' => 5,  
            'name' => 'East Rukum',
            'name_ne' => 'रुकुम पूर्व',
            ],
            [
            'province_id' => 5,  
            'name' => 'Rolpa',
            'name_ne' => 'रोल्पा',
            ],
            [
            'province_id' => 5,  
            'name' => 'Pyuthan',
            'name_ne' => 'प्यूठान',
            ],
            [
            'province_id' => 5,  
            'name' => 'Gulmi',
            'name_ne' => 'गुल्मी',
            ],
            [
            'province_id' => 5,  
            'name' => 'Arghakhanchi',
            'name_ne' => 'अर्घाखाची',
            ],
            [
            'province_id' => 5,  
            'name' => 'Palpa',
            'name_ne' => 'पाल्पा',
            ],
            [
            'province_id' => 5,  
            'name' => 'Nawalparasi (Bardaghar Susta West)',
            'name_ne' => 'नवलपरासी (बर्दघाट सुस्ता पश्चिम)',
            ],
            [
            'province_id' => 5,  
            'name' => 'Rupandehi',
            'name_ne' => 'रुपन्देही',
            ],
            [
            'province_id' => 5,  
            'name' => 'Kapilbastu',
            'name_ne' => 'कपिलवस्तु',
            ],
            [
            'province_id' => 5,  
            'name' => 'Dang',
            'name_ne' => 'दाङ्ग',
            ],
            [
            'province_id' => 5,  
            'name' => 'Banke',
            'name_ne' => 'बाँके',
            ],
            [
            'province_id' => 5,  
            'name' => 'Bardiya',
            'name_ne' => 'बर्दिया',
            ],
            [
            'province_id' => 6,  
            'name' => 'West Rukum',
            'name_ne' => 'रुकुम पश्चिम',
            ],
            [
            'province_id' => 6,  
            'name' => 'Salyan',
            'name_ne' => 'सल्यान',
            ],
            [
            'province_id' => 6,  
            'name' => 'Surkhet',
            'name_ne' => 'सुर्खेत',
            ],
            [
            'province_id' => 6,  
            'name' => 'Dailekh',
            'name_ne' => 'दैलेख',
            ],
            [
            'province_id' => 6,  
            'name' => 'Jajarkot',
            'name_ne' => 'जाजरकोट',
            ],
            [
            'province_id' => 6,  
            'name' => 'Dolpa',
            'name_ne' => 'डोल्पा',
            ],
            [
            'province_id' => 6,  
            'name' => 'Jumla',
            'name_ne' => 'जुम्ला',
            ],
            [
            'province_id' => 6,  
            'name' => 'Kalikot',
            'name_ne' => 'कालिकोट',
            ],
            [
            'province_id' => 6,  
            'name' => 'Mugu',
            'name_ne' => 'मुगु',
            ],
            [
            'province_id' => 6,  
            'name' => 'Humla',
            'name_ne' => 'हुम्ला',
            ],
            [
            'province_id' => 7,  
            'name' => 'Bajura',
            'name_ne' => 'बाजुरा',
            ],
            [
            'province_id' => 7,  
            'name' => 'Bajhang',
            'name_ne' => 'बझाङ',
            ],
            [
            'province_id' => 7,  
            'name' => 'Darchula',
            'name_ne' => 'दार्चुला',
            ],
            [
            'province_id' => 7,  
            'name' => 'Baitadi',
            'name_ne' => 'बैतडी',
            ],
            [
            'province_id' => 7,  
            'name' => 'Dadeldhura',
            'name_ne' => 'डडेल्धुरा',
            ],
            [
            'province_id' => 7,  
            'name' => 'Doti',
            'name_ne' => 'डोटी',
            ],
            [
            'province_id' => 7,  
            'name' => 'Achham',
            'name_ne' => 'अछाम',
            ],
            [
            'province_id' => 7,  
            'name' => 'Kailali',
            'name_ne' => 'कैलाली',
            ],
            [
            'province_id' => 7,  
            'name' => 'Kanchanpur',
            'name_ne' => 'कञ्चनपुर',
            ],
        ];

        District::insert($districts);
  
    }
}
