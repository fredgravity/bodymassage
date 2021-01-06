<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 5/12/2020
 * Time: 1:36 PM
 */

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class User extends Model
{

    use SoftDeletes;

    public $timestamp = true;
    protected $fillable = ['username', 'fullname', 'password','country', 'region', 'city', 'phone', 'address', 'email', 'image_path', 'role', 'gps', 'id_type', 'id_number', 'district'];
    protected $dates = ['deleted_at'];

    public function worker(){
        return $this->hasOne(Worker::class);
    }

    public function payment(){
        return $this->hasMany(Payment::class);
    }

    public function userSession(){
        return $this->hasMany(UserSession::class);
    }


    public function transformToArray($data){
        $users = []; //SET UP CATEGORIES ARRAY
//pnd($data);
        foreach ($data as $field){
            //CARBON FORMAT DATE FROM DB PROPERLY
//            $added = new Carbon($field->created_at);

                $newAdded = Carbon::createFromFormat('Y-m-d H:i:s', $field->created_at);

                $newUpdated = Carbon::createFromFormat('Y-m-d H:i:s', $field->updated_at);

                array_push($users, [
                    'id'           => $field->id,
                    'username'     => $field->username,
                    'fullname'     => $field->fullname,
                    'email'        => $field->email,
                    'phone'        => $field->phone,
                    'country'      => $field->country,
                    'region'       => $field->region,
                    'city'         => $field->city,
                    'address'      => $field->address,
                    'gps'      => $field->gps,
                    'role'      => $field->role,
                    'district'      => $field->district,
                    'image'        => $field->image_path,
                    'added'        => $newAdded->format('d-m-Y'),
                    'updated'      => $newUpdated->format('d-m-Y')
                ]);
            }


        return $users;
    }

}




