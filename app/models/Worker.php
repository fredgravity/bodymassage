<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 5/16/2020
 * Time: 1:23 PM
 */

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Worker extends Model
{

    use SoftDeletes;

    public $timestamp = true;
    protected $fillable = ['user_id', 'institution', 'active'];
    protected $dates = ['deleted_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function transformToArray($data)
    {
        $workers = []; //SET UP CATEGORIES ARRAY

        foreach ($data as $field) {
            //CARBON FORMAT DATE FROM DB PROPERLY
            $added = new Carbon($field->created_at);
            $updated = new Carbon($field->updated_at);

            array_push($workers, [
                'id' => $field->id,
                'username' => $field->username,
                'fullname' => $field->fullname,
                'email' => $field->email,
                'phone' => $field->phone,
                'region' => $field->region,
                'city' => $field->city,
                'address' => $field->address,
                'gps' => $field->gps,
                'role' => $field->role,
                'image' => $field->image_path,
                'added' => $added->toFormattedDateString(),
                'updated' => $updated->toFormattedDateString()
            ]);
        }
        return $workers;
    }





}