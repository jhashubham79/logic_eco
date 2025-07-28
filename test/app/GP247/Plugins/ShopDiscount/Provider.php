<?php
/**
 * Provides everything needed for the Extension
 */

 $config = file_get_contents(__DIR__.'/gp247.json');
 $config = json_decode($config, true);
 $extensionPath = $config['configGroup'].'/'.$config['configKey'];
 
 $this->loadTranslationsFrom(__DIR__.'/Lang', $extensionPath);
 
 if (gp247_extension_check_active($config['configGroup'], $config['configKey'])) {
     
     $this->loadViewsFrom(__DIR__.'/Views', $extensionPath);
     
     if (file_exists(__DIR__.'/config.php')) {
         $this->mergeConfigFrom(__DIR__.'/config.php', $extensionPath);
     }
 
     if (file_exists(__DIR__.'/function.php')) {
         require_once __DIR__.'/function.php';
     }

     \Illuminate\Support\Facades\Validator::extend('discount_unique', function ($attribute, $value, $parameters, $validator) {
        $disountId = $parameters[0] ?? '';
        return (new \App\GP247\Plugins\ShopDiscount\Models\ShopDiscount)
        ->checkDiscountValidationAdmin(type: 'code', fieldValue: $value, discountId: $disountId, storeId: session('adminStoreId'));
    });
 }