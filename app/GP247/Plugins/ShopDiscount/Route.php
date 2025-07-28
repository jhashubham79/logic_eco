<?php
use Illuminate\Support\Facades\Route;

$config = file_get_contents(__DIR__.'/gp247.json');
$config = json_decode($config, true);

if(gp247_extension_check_active($config['configGroup'], $config['configKey'])) {

    Route::group(
        [
            'middleware' => GP247_FRONT_MIDDLEWARE,
            'prefix'    => 'plugin/discount',
            'namespace' => 'App\GP247\Plugins\ShopDiscount\Controllers',
        ],
        function () {
            Route::post('/discount_process', 'FrontController@useDiscount')
                ->name('discount.process');
            Route::post('/discount_remove', 'FrontController@removeDiscount')
                ->name('discount.remove');
        }
    );

    Route::group(
        [
            'prefix' => GP247_ADMIN_PREFIX.'/discount',
            'middleware' => GP247_ADMIN_MIDDLEWARE,
            'namespace' => '\App\GP247\Plugins\ShopDiscount\Admin',
        ], 
        function () {
            Route::get('/', 'AdminController@index')
            ->name('admin_discount.index');
            Route::get('create', 'AdminController@create')
                ->name('admin_discount.create');
            Route::post('/create', 'AdminController@postCreate')
                ->name('admin_discount.create');
            Route::get('/edit/{id}', 'AdminController@edit')
                ->name('admin_discount.edit');
            Route::post('/edit/{id}', 'AdminController@postEdit')
                ->name('admin_discount.edit');
            Route::post('/delete', 'AdminController@deleteList')
                ->name('admin_discount.delete');
        }
    );
}