<?php
use Illuminate\Support\Facades\Route;
if (file_exists(app_path('GP247/Shop/Admin/Controllers/AdminShopConfigController.php'))) {
    $nameSpaceAdminShopConfig = 'App\GP247\Shop\Admin\Controllers';
} else {
    $nameSpaceAdminShopConfig = 'GP247\Shop\Admin\Controllers';
}
Route::group(['prefix' => 'shop_config'], function () use ($nameSpaceAdminShopConfig) {
    Route::get('/', $nameSpaceAdminShopConfig.'\AdminShopConfigController@index')->name('admin_shop_config.index');
});

 // Testimonials Routes
Route::get('/testimonial', $nameSpaceAdminShopConfig.'\ShopTestimonialController@index')
    ->name('admin.testimonial.index');

Route::get('/testimonial/create', $nameSpaceAdminShopConfig.'\ShopTestimonialController@create')
    ->name('admin_testimonial.create');

Route::post('/testimonial/store', $nameSpaceAdminShopConfig.'\ShopTestimonialController@store')
    ->name('admin_testimonial.store');

Route::get('/testimonial/edit/{id}', $nameSpaceAdminShopConfig.'\ShopTestimonialController@edit')
    ->name('admin_testimonial.edit');

Route::post('/testimonial/update/{id}', $nameSpaceAdminShopConfig.'\ShopTestimonialController@update')
    ->name('admin_testimonial.update');

Route::delete('/testimonial/delete/{id}', $nameSpaceAdminShopConfig.'\ShopTestimonialController@destroy')
    ->name('admin_testimonial.delete');
