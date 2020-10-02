<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 5/10/2020
 * Time: 10:09 AM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    use SoftDeletes;

    public $timestamp = true;
    protected $fillable = ['user_id', 'product_name', 'price', 'description', 'image_path'];
    protected $dates = ['deleted_at'];


    public function order(){
        return $this->hasOne(Order::class);
    }


}


