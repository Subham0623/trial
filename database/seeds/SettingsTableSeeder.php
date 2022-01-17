<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('settings')->delete();
        
        \DB::table('settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Codeaiders',
                'logo' => 'logo.png',
                'favicon' => 'favicon.png',
                'copyright' => 'Copyright © 2022 Codeaiders Pvt. Ltd.',
                'footer_logo' => 'logo.png',
                'rightclick' => 0,
                'inspect' => 0,
                'meta_data_desc' => NULL,
                'meta_data_keyword' => NULL,
                'google_ana' => NULL,
                'fb_login_enable' => 1,
                'google_login_enable' => 1,
                'gitlab_login_enable' => 1,
                'w_email_enable' => 1,
                'wel_email' => 'admin@admin.com',
            ),
        ));
        
        
    }
}