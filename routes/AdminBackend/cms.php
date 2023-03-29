<?php

Route::group([
    'namespace' => 'CMS',
], function () {
    includeRouteFiles(__DIR__ . '/CMS/');
});
