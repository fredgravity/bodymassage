<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 6/7/2020
 * Time: 10:51 AM
 */

namespace App\classes;


class Search
{


    public static function searchQuery($table){

        if (Request::exist('post')){
            $request = Request::get('post');

            if (CSRFToken::checkToken($request->token, false)){
                $search = $request->search;
                $role = $request->role;

                $searchUser = User::where([ ['username', 'LIKE', "%$search%"], ['role', '=', $role]] )
                    ->orWhere([['fullname', 'LIKE', "%$search%"], ['role', '=', $role]])
                    ->orWhere([['email', 'LIKE', "%$search%"], ['role', '=', $role]] )
                    ->orWhere([['country_name', 'LIKE', "%$search%"], ['role', '=', $role]] )->get();

                echo json_encode(['search' => $searchUser]);

            }
        }
        return null;

    }











}
