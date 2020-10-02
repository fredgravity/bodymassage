<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 5/26/2020
 * Time: 12:58 PM
 */

namespace App\classes;


use App\Models\User;

class Role
{

    public static function middleware($role){
        //IF USER ROLE IS NOT ANY OF THE BELOW DISPLAY THE MESSAGE
        $message = '';



        switch ($role){
            case 'admin':
                $message = 'You are not authorised to view Admin Panel';
                break;

            case 'user':
                $message = 'You are not authorised to view User Panel';
                break;

            case 'worker':
                $message = 'You are not authorised to view Worker Panel';
                break;
        }

        //CHECK IF USER IS AUTHENTICATED
//        dnd(isAuthenticated());
        if(isAuthenticated()){
            if (user()->role != $role){
                Session::flash('error', $message);
                return false;
            }
        }else{

            Session::flash('error', $message);
            Redirect::to('/login');

        }

        return true;

    }


}
