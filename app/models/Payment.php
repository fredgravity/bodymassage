<?php
/**
 * Created by PhpStorm.
 * User: Gravity
 * Date: 07/08/2018
 * Time: 9:14 AM
 */

namespace App\Models;

use App\Classes\Redirect;
use App\Classes\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Payment extends Model
{
    use SoftDeletes;

    public $timestamps = true; // auto populate the timestamp columns in the db
    protected $fillable = ['user_id', 'order_number', 'amount', 'status']; // MASS INSERTION OF DATA INTO THE DB
    protected $dates = ['deleted_at'];


    public function user(){
        return $this->belongsTo(User::class);
    }

//    public function orderDetail(){
//        return $this->belongsTo(OrderDetail::class);
//    }


    public function transformToArray($data){
        $payments = []; //SET UP CATEGORIES ARRAY


        foreach ($data as $field){

            if ($field->created_at == null || $field->updated_at == null){
                if (getenv('APP_ENV') == 'local'){
                    pnd('Payment model transform error');
                }else{
                    Session::flash('error', 'Could not transform payment data');
                    Redirect::to($_SERVER['REQUEST_URI']);
                }
            }else{
                //CARBON FORMAT DATE FROM DB PROPERLY
                $newAdded = Carbon::createFromFormat('Y-m-d H:i:s', $field->created_at)->format('d-m-Y');
                $newUpdated = Carbon::createFromFormat('Y-m-d H:i:s', $field->updated_at)->format('d-m-Y');

//            $added = new Carbon($field->created_at);
//            $updated = new Carbon($field->updated_at);

                array_push($payments, [
                    'id'           => $field->id,
                    'user_id'     => $field->user_id,
                    'amount'     => $field->amount,
                    'status'     => $field->status,
                    'order_number'     => $field->order_number,
////                'fullname'     => $field->user->fullname,
                    'added'        => $newAdded,
                    'updated'      => $newUpdated
                ]);

            }


        }
        return $payments;

    }
}
?>