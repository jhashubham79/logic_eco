<?php
#App\GP247\Plugins\ShopDiscount\Models\ExtensionModel.php
namespace App\GP247\Plugins\ShopDiscount\Models;
use App\GP247\Plugins\ShopDiscount\Models\ShopDiscount;

class ExtensionModel
{
    public function uninstallExtension()
    {
        (new ShopDiscount)->uninstall();
    }

    public function installExtension()
    {
        (new ShopDiscount)->install();
    }
    
}
