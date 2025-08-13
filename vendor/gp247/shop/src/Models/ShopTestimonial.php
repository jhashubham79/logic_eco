<?php
namespace GP247\Shop\Models;

use Illuminate\Database\Eloquent\Model;
class ShopTestimonial extends Model
{
     protected $table = 'testimonials';
    protected $connection = GP247_DB_CONNECTION;
    protected $guarded = [];
}