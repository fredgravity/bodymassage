<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 5/10/2020
 * Time: 9:10 AM
 */

namespace App\Classes;


class CSRFToken
{
//GENERATE TOKEN
    public static function generate(){
        if(!Session::exist('token')){
            $tokenValue = base64_encode(openssl_random_pseudo_bytes(32));
            Session::set('token', $tokenValue);
        }
        return Session::get('token');
    }


    //CHECK TOKEN GENERATED
    public static function checkToken($tokenName, $regenerate = true){
        if(Session::exist('token') && Session::get('token') === $tokenName){
            if($regenerate){
                Session::delete('token');
            }

            return true;
        }
        return false;
    }

}


