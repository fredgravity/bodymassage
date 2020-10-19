<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 10/7/2020
 * Time: 1:16 PM
 */

namespace App\classes;

use App\Classes\Redirect;

class LocationData
{
    public static $visitorData=[];

    public static function get_visitor_data($ip_address=false, $name=false){


        try{

            $cURLConnection = curl_init();
            curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);


            if ($ip_address){

                curl_setopt($cURLConnection, CURLOPT_URL, 'http://ip-api.com/json/'.$ip_address);

            }else {
                if (getenv('APP_ENV') != 'local'){

                    curl_setopt($cURLConnection, CURLOPT_URL, 'http://ip-api.com/json/'.get_ip());
                }else{

                    curl_setopt($cURLConnection, CURLOPT_URL, 'http://ip-api.com/json/154.160.1.98');
                }


            }

            $dataJSON = curl_exec($cURLConnection);
            curl_close($cURLConnection);

            $obj = new LocationData();
            $obj::$visitorData = json_decode($dataJSON);
//            pnd($obj::$visitorData);

            return $obj::$visitorData;

        }catch(\Exception $e){
            if (getenv('APP_ENV') == 'local'){
                echo $e->getMessage();
            }else{
                Session::flash('error', 'Could not get ip for location');
                Redirect::to('/');
            }
        }


        return false;

    }


    public static function getLocation ($name){
        $data = '';

        switch ($name){
            case 'country':
                $data = LocationData::get_visitor_data()->country;
                break;

            case 'countryCode':
                $data = LocationData::get_visitor_data()->countryCode;
                break;

            case 'region':
                $data = LocationData::get_visitor_data()->region;
                break;

            case 'regionName':
                $data = LocationData::get_visitor_data()->regionName;
                break;

            case 'city':
                $data = LocationData::get_visitor_data()->city;
                break;

            case 'latitude':
                $data = LocationData::get_visitor_data()->latitude;
                break;

            case 'longitude':
                $data = LocationData::get_visitor_data()->longitude;
                break;
        }
//pnd($data);
        return $data;
    }

}



?>