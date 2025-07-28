<?php
namespace App\GP247\Plugins\ShopDiscount\Models;

use Illuminate\Database\Eloquent\Model;
use GP247\Core\Models\AdminStore;
use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\GP247\Plugins\ShopDiscount\Models\ShopDiscountStore;

class ShopDiscount extends Model
{
    use \GP247\Core\Models\UuidTrait;
    
    public $table = GP247_DB_PREFIX.'shop_discount';
    public $table_related = GP247_DB_PREFIX.'shop_discount_customer';
    public $table_discount_store = GP247_DB_PREFIX.'shop_discount_store';
    protected $guarded    = [];
    protected $dates      = ['expires_at'];
    protected $connection = GP247_DB_CONNECTION;

    protected static function boot()
    {
        parent::boot();
        // before delete() method call this
        static::deleting(function ($model) {
            $model->users()->detach();
            $model->stores()->detach();
        });

        //Uuid
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = gp247_generate_id('DIS');
            }
        });
    }

    public function stores()
    {
        return $this->belongsToMany(AdminStore::class, ShopDiscountStore::class, 'discount_id', 'store_id');
    }

        /**
     * Get the users who is related promocode.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(\GP247\Shop\Models\ShopCustomer::class, $this->table_related, 'discount_id', 'customer_id')
            ->withPivot('used_at', 'log');
    }


    /**
     * [getPromotionByCode description]
     *
     * @param   [type]  $code  [$code description]
     *
     * @return  [type]         [return description]
     */
    public function getPromotionByCode($code) {
        $promotion = $this->where($this->getTable().'.code', $code);

        if (gp247_store_check_multi_partner_installed() ||  gp247_store_check_multi_store_installed()) {
            $storeId = config('app.storeId');
            $tableStore = (new AdminStore)->getTable();
            $tableDiscountStore = (new ShopDiscountStore)->getTable();

            $promotion = $promotion->join($tableDiscountStore, $tableDiscountStore.'.discount_id', $this->getTable() . '.id');
            $promotion = $promotion->join($tableStore, $tableStore . '.id', $tableDiscountStore.'.store_id');
            $promotion = $promotion->where($tableStore . '.status', '1');
            $promotion = $promotion->where($tableDiscountStore.'.store_id', $storeId);

        }
        $promotion = $promotion->first();
        return $promotion;
    }

    /**
     * Check if code is expired.
     *
     * @return bool
     */
    public function isExpired()
    {
        return $this->expires_at ? Carbon::now()->gte($this->expires_at) : false;
    }

        /**
     * Query builder to get expired promotion codes.
     *
     * @param $query
     * @return mixed
     */
    public function scopeExpired($query)
    {
        return $query->whereNotNull('expires_at')->whereDate('expires_at', '<=', Carbon::now());
    }

    public function uninstall() {
        if (Schema::hasTable($this->table)) {
            Schema::drop($this->table);
        }
        if (Schema::hasTable($this->table_related)) {
            Schema::drop($this->table_related);
        }
        if (Schema::hasTable($this->table_discount_store)) {
            Schema::drop($this->table_discount_store);
        }
    }


    public function install()
    {
        $this->uninstall();

        Schema::create($this->table, function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code', 50)->unique();
            $table->decimal('reward',15,2)->default(2);
            $table->string('type', 10)->default('point')->comment('point - Point; percent - %');
            $table->string('data', 300)->nullable();
            $table->integer('limit')->default(1);
            $table->integer('used')->default(0);
            $table->integer('login')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->dateTime('expires_at')->nullable();
            $table->timestamps();
        });

        Schema::create($this->table_related, function (Blueprint $table) {
            $table->uuid('customer_id')->index();
            $table->uuid('discount_id')->index();
            $table->text('log')->nullable();
            $table->timestamp('used_at')->nullable();
            $table->timestamps();
        });
        
        Schema::create($this->table_discount_store, function (Blueprint $table) {
            $table->uuid('discount_id');
            $table->uuid('store_id');
            $table->primary(['discount_id', 'store_id']);
        });

    }

    
    /**
     * Get discount detail in admin
     *
     * @param   [type]  $id  [$id description]
     *
     * @return  [type]       [return description]
     */
    public static function getDiscountAdmin($id) {
        $data =  self::where('id', $id);
        $tableDiscount = (new ShopDiscount)->getTable();
        if (gp247_store_check_multi_partner_installed() ||  gp247_store_check_multi_store_installed()) {
            if (session('adminStoreId') != GP247_STORE_ID_ROOT) {
                $tableDiscountStore = (new ShopDiscountStore)->getTable();
                $data = $data->leftJoin($tableDiscountStore, $tableDiscountStore . '.discount_id', $tableDiscount . '.id');
                $data = $data->where($tableDiscountStore . '.store_id', session('adminStoreId'));
            }
        }
        $data = $data->first();
        return $data;
    }

    /**
     * Get list discount in admin
     *
     * @param   [array]  $dataSearch  [$dataSearch description]
     *
     * @return  [type]               [return description]
     */
    public function getDiscountListAdmin(array $dataSearch) {
        $sort_order       = $dataSearch['sort_order'] ?? '';
        $arrSort          = $dataSearch['arrSort'] ?? '';
        $keyword          = $dataSearch['keyword'] ?? '';
        $discountList = (new ShopDiscount);
        $tableDiscount = (new ShopDiscount)->getTable();
        if (gp247_store_check_multi_partner_installed() ||  gp247_store_check_multi_store_installed()) {
            if (session('adminStoreId') != GP247_STORE_ID_ROOT) {
                $tableDiscountStore = (new ShopDiscountStore)->getTable();
                $discountList = $discountList->leftJoin($tableDiscountStore, $tableDiscountStore . '.discount_id', $tableDiscount . '.id');
                $discountList = $discountList->where($tableDiscountStore . '.store_id', session('adminStoreId'));
            }
        }
        if ($keyword) {
            $discountList = $discountList->where('code', 'like', '%'.$keyword.'%');
        }
        if ($sort_order && array_key_exists($sort_order, $arrSort)) {
            $field = explode('__', $sort_order)[0];
            $sort_field = explode('__', $sort_order)[1];
            $discountList = $discountList->orderBy($field, $sort_field);
        } else {
            $discountList = $discountList->orderBy('id', 'desc');
        }
        $discountList = $discountList->paginate(20);

        return $discountList;
    }

    /**
     * Create a new discount
     *
     * @param   array  $dataInsert  [$dataInsert description]
     *
     * @return  [type]              [return description]
     */
    public static function createDiscountAdmin(array $dataInsert) {

        return self::create($dataInsert);
    }

     /**
     * [checkDiscountValidationAdmin description]
     *
     * @param   [type]$type     [$type description]
     * @param   null  $fieldValue    [$field description]
     * @param   null  $discountId      [$discountId description]
     * @param   null  $storeId  [$storeId description]
     * @param   null            [ description]
     *
     * @return  [type]          [return description]
     */
    public function checkDiscountValidationAdmin($type = null, $fieldValue = null, $discountId = null, $storeId = null) {
        $storeId = $storeId ? $storeId : session('adminStoreId');
        $type = $type ? $type : 'code';
        $fieldValue = $fieldValue;
        $tableDiscount = (new ShopDiscount)->getTable();
        $check = (new ShopDiscount)->where($type, $fieldValue);

        if (gp247_store_check_multi_partner_installed() ||  gp247_store_check_multi_store_installed()) {
            if (session('adminStoreId') != GP247_STORE_ID_ROOT) {
                $tableDiscountStore = (new ShopDiscountStore)->getTable();
                $check = $check->leftJoin($tableDiscountStore, $tableDiscountStore . '.discount_id', $tableDiscount . '.id');
                $check = $check->where($tableDiscountStore . '.store_id', session('adminStoreId'));
            }
        }
        if ($discountId) {
            $check = $check->where($tableDiscount.'.id', '<>', $discountId);
        }
        $check = $check->first();

        if ($check) {
            return false;
        } else {
            return true;
        }
    }
}
