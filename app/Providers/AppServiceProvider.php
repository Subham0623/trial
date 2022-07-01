<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use Laravel\Passport\Console\ClientCommand;
use Laravel\Passport\Console\InstallCommand;
use Laravel\Passport\Console\KeysCommand;

use Schema;
use App\Models\Setting;
use Session;
// use App\Helpers\SeoHelper;
use App\Helpers\Tracker;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands([
            InstallCommand::class,
            ClientCommand::class,
            KeysCommand::class,
        ]);

        View::composer(
            'layouts.website', 'App\Http\View\Composers\FrontPageComposer'
        );
        View::composer(
            'layouts.admin', 'App\Http\View\Composers\AdminSettingComposer'
        );
        
        // try {
        //     \DB::connection()->getPdo();
        //     Schema::defaultStringLength(191);

        //     $code = @file_get_contents(public_path() . '/code.txt');        
            
        //     if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        //         $ip_address = @$_SERVER['HTTP_CLIENT_IP'];
        //     }
        //     //whether ip is from proxy
        //     elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        //         $ip_address = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        //     }
        //     //whether ip is from remote address
        //     else {
        //         $ip_address = @$_SERVER['REMOTE_ADDR'];
        //     }
            
        //     $d = \Request::getHost();
        //     $domain = str_replace("www.", "", $d);
            
        //     if ($domain == 'localhost' || strstr($domain, '.test') || strstr($domain, '192.168.0') || strstr($domain, 'codeaiders.com')) {
        //         // No Code
        //     }else{
        //         Tracker::validSettings($code,$domain,$ip_address);
        //     }

        //     if(\DB::connection()->getDatabaseName() && Schema::hasTable('settings')){
        //     //   SeoHelper::seosettings();
        //     }

        //     View::composer('*',function($view){

        //         if(\DB::connection()->getDatabaseName()){
        //           if(Schema::hasTable('settings')){
        //             $setting = Setting::first();
                    
        //             $view->with(
        //                 'setting', $setting   
        //             );

        //           }
        //         }
        //     });
        // }catch(\Exception $ex){

        //   return redirect('/get/step2');
        // }
    }
}
