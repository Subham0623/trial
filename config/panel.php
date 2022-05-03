<?php
// dd((config('app.env') == 'local')?config('app.url'):'http://mangosoftsolution.com:3930');
return [
    'date_format'         => 'Y-m-d',
    'time_format'         => 'H:i:s',
    'primary_language'    => 'en',
    'available_languages' => [
        'en' => 'English',
    ],
    'homepage' => (config('app.env') == 'local')?config('app.url'):'http://mangosoftsolution.com:3930',
];
