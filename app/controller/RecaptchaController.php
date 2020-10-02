<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 6/8/2020
 * Time: 3:27 AM
 */

namespace App\controller;


use App\Classes\Request;

class RecaptchaController extends BaseController
{


    public function recapture(){
        $online = getenv('RECAPTCHA_ONLINE');
        if ($online){
            if (Request::exist('post')){
                $request = Request::get('post');

                $captcha = $request->token;
//            $captcha = '';

                if(!$captcha){
                    echo json_encode( ['success' => false]);
                    exit;
                }
                $secretKey = getenv('GR_SECRET_KEY');
                $ip = $_SERVER['REMOTE_ADDR'];

                // post request to server
                $url = 'https://www.google.com/recaptcha/api/siteverify';
                $data = array('secret' => $secretKey, 'response' => $captcha);

                $options = array(
                    'http' => array(
                        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                        'method'  => 'POST',
                        'content' => http_build_query($data)
                    )
                );
                $context  = stream_context_create($options);
                $response = file_get_contents($url, false, $context);
                $responseKeys = json_decode($response,true);
                header('Content-type: application/json');

//            pnd($responseKeys);

                if($responseKeys["success"] && $responseKeys['score'] >= 0.5) {
//        return true;
                    echo json_encode(array('success' => 'true')); exit();
                } else {
                    echo json_encode(array('success' => 'false'));exit();
//        return false;
                }


            }
            echo json_encode(array('success' => 'true'));exit();
        }

    }




}

