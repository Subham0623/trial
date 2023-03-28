<?php

Route::group([
    'namespace' => 'Product',
], function () {
    includeRouteFiles(__DIR__ . '/Product/');
});
