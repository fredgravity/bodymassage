<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 7/29/2020
 * Time: 5:30 PM
 */

namespace App\classes;

use Twilio\Rest\Client;

class TwilioSms
{

    public function __construct()
    {


    }

    public static function twilioSendSms($toPhoneNumber, $message, $ary=true){



        // Your Account SID and Auth Token from twilio.com/console
        $account_sid = getenv('TWILIO_LIVE_SID');
        $auth_token = getenv('TWILIO_LIVE_TOKEN');
        // In production, these should be environment variables. E.g.:
        // $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

        // A Twilio number you own with SMS capabilities
        $twilio_number = '"'. getenv('TWILIO_LIVE_NUMBER') . '"';


        if ($ary){
            $numbers = [$toPhoneNumber, '+233209114711'];
            foreach ($numbers as $number){
                self::sendSms($account_sid, $auth_token, $number, $twilio_number, $message);
            }
        }else{
            self::sendSms($account_sid, $auth_token, $toPhoneNumber, $twilio_number, $message);
        }





    }


    public static function sendSms($account_sid, $auth_token, $toPhoneNumber, $twilio_number, $message){
        try{

            $client = new Client($account_sid, $auth_token);
            $client->messages->create(
            // Where to send a text message (your cell phone?)
                $toPhoneNumber,
                array(
                    'from' => $twilio_number,
                    'body' => $message
                )
            );

        }catch (\Exception $e) {
            if (getenv('APP_ENV')  == 'local'){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }else{
                echo 'Something went wrong please try again later.'; exit();
            }

        }
    }

}