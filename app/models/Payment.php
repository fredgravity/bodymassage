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

class Payment extends Model
{
    use SoftDeletes;

    public $timestamps = true; // auto populate the timestamp columns in the db
    protected $fillable = ['user_id', 'order_number', 'amount', 'status']; // MASS INSERTION OF DATA INTO THE DB
    protected $dates = ['deleted_at'];


    public function user(){
        return $this->belongsTo(User::class);
    }


    public function transformToArray($data){
        $payments = []; //SET UP CATEGORIES ARRAY

        foreach ($data as $field){

            //CARBON FORMAT DATE FROM DB PROPERLY
            $added = new Carbon($field->created_at);
            $updated = new Carbon($field->updated_at);

            array_push($payments, [
                'id'           => $field->id,
                'user_id'     => $field->user_id,
                'amount'     => $field->amount,
                'status'     => $field->status,
                'order_number'     => $field->order_number,
//                'fullname'     => $field->user->fullname,
//                'email'        => $field->user->email,
//                'phone'        => $field->user->phone,
//                'region'       => $field->user->region,
//                'city'         => $field->user->city,
//                'address'      => $field->user->address,
//                'role'      => $field->user->role,
//                'image'        => $field->user->image_path,
                'added'        => $added->toFormattedDateString(),
                'updated'      => $updated->toFormattedDateString()
            ]);
        }
        return $payments;
    }
}
?>