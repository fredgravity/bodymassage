<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Order extends Model
{
    use SoftDeletes;

    public $timestamps = true; // auto populate the timestamp columns in the db
    protected $fillable = ['user_id', 'product_id', 'order_number', 'reference_no']; // MASS INSERTION OF DATA INTO THE DB
    protected $dates = ['deleted_at'];



    public function transformToArray($data){
        $orders = []; //SET UP CATEGORIES ARRAY

        foreach ($data as $field){

            //CARBON FORMAT DATE FROM DB PROPERLY
//            $added = new Carbon($field->created_at);
            $newAdded = Carbon::createFromFormat('Y-m-d H:i:s', $field->created_at);

            array_push($orders, [
                'id'    => $field->id,
                'order_number'  => $field->order_number,
                'user_id' => $field->user_id,
                'product_id' => $field->product_id,
                'ref_no' => $field->reference_no,
                'added' => $newAdded->format('d-m-Y')
            ]);
        }
//        pnd($orders);
        return $orders;
    }

    public function orderDetail(){
        return$this->hasOne(OrderDetail::class, 'order_number', 'order_number');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
?>