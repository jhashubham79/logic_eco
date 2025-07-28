<?php
namespace App\GP247\Plugins\ShopDiscount\Models;

use Illuminate\Database\Eloquent\Model;

class ShopDiscountStore extends Model
{
    use \GP247\Core\Models\UuidTrait;
    
    protected $primaryKey = ['store_id', 'discount_id'];
    public $incrementing  = false;
    protected $guarded    = [];
    public $timestamps    = false;
    public $table = GP247_DB_PREFIX.'shop_discount_store';
    protected $connection = GP247_DB_CONNECTION;

    protected static function boot()
    {
        parent::boot();
        // before delete() method call this
        static::deleting(function ($model) {
            //
        });
    }
}
