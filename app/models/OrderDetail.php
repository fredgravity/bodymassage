<?php
/**
 * Created by PhpStorm.
 * User: Gravity
 * Date: 07/08/2018
 * Time: 9:14 AM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class OrderDetail extends Model
{
    use SoftDeletes;

    public $timestamps = true; // auto populate the timestamp columns in the db
    protected $fillable = ['user_id', 'order_id', 'product_id', 'unit_price', 'hours', 'total_price', 'status', 'order_number', 'session_time', 'date_picked', 'place', 'place_name', 'reference_no']; // MASS INSERTION OF DATA INTO THE DB
    protected $dates = ['deleted_at'];

    public function order(){
        return $this->belongsTo(Order::class, 'order_number', 'order_number');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

//    public function payment(){
//        return $this->hasOne(Payment::class);
//    }


    public function transform($data){
//    public function transformToArray($data){
        $orders = []; //SET UP CATEGORIES ARRAY

        foreach ($data as $field){
            //CARBON FORMAT DATE FROM DB PROPERLY
//            $added = new Carbon($field->created_at);

            $newAdded = Carbon::createFromFormat('Y-m-d H:i:s', $field->created_at);

//            $newUpdated = Carbon::createFromFormat('Y-m-d H:i:s', $field->updated_at);

            array_push($orders, [
                'id'    => $field->id,
                'order_number'  => $field->order_number,
                'order_id'  => $field->order_id,
                'session_time' => $field->session_time,
                'user_id' => $field->user_id,
                'product_id' => $field->product_id,
                'unit_price' => $field->unit_price,
                'hours' => $field->hours,
                'place' => $field->place,
                'place_name' => $field->place_name,
                'total_price' => $field->total_price,
                'date_picked' => $field->date_picked,
                'status' => $field->status,
                'reference_no' => $field->reference_no,
                'added' =>$newAdded
            ]);
        }
        return $orders;
    }

}
?>