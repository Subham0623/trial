<?php

return [
    'date_format'         => 'Y-m-d',
    'time_format'         => 'H:i:s',
    'primary_language'    => 'en',
    'available_languages' => [
        'en' => 'English',
    ],
    'homepage' => (config('app.env') == 'production')?config('app.production'):((config('app.env') == 'staging')?config('app.staging'):config('app.url')),
];
