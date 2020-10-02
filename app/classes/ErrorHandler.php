<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 5/9/2020
 * Time: 7:56 PM
 */

namespace App\Classes;


use Whoops\Handler\PrettyPageHandler;
use App\classes\MailWithGun;

class ErrorHandler
{

    public function handleError($error_number, $error_message, $error_file, $error_line){




        $env = getenv('APP_ENV');
        if ($env == 'local'){
            $whoops = new \Whoops\Run;
            $whoops->pushHandler( new PrettyPageHandler);
            $whoops->register();
        }else{
            $error='';

            switch ($error_number) {
                case E_ERROR:
                    $error = "[{$error_number}] an error occurred in file {$error_file} on line {$error_line}: {$error_message}";
                    $data = [
                        'to' => getenv('ADMIN_EMAIL'),
                        'subject' => 'System Error',
                        'view' => 'error',
                        'name' => 'Gravity',
                        'body' => $error
                    ];


                    ErrorHandler::emailAdmin($data)->displayFriendlyError();
                    break;
                case E_USER_ERROR:
                    $error = "[{$error_number}] an error occurred in file {$error_file} on line {$error_line}: {$error_message}";
                    $data = [
                        'to' => getenv('ADMIN_EMAIL'),
                        'subject' => 'System Error',
                        'view' => 'error',
                        'name' => 'Gravity',
                        'body' => $error
                    ];


                    ErrorHandler::emailAdmin($data)->displayFriendlyError();
                    break;
                case E_USER_WARNING:
                    $error = "[{$error_number}] an error occurred in file {$error_file} on line {$error_line}: {$error_message}";
                    $data = [
                        'to' => getenv('ADMIN_EMAIL'),
                        'subject' => 'System Error',
                        'view' => 'error',
                        'name' => 'Gravity',
                        'body' => $error
                    ];


                    ErrorHandler::emailAdmin($data);
                    break;
                case E_USER_NOTICE:
                    $error = "[{$error_number}] an error occurred in file {$error_file} on line {$error_line}: {$error_message}";
                    $data = [
                        'to' => getenv('ADMIN_EMAIL'),
                        'subject' => 'System Error',
                        'view' => 'error',
                        'name' => 'Gravity',
                        'body' => $error
                    ];


                    ErrorHandler::emailAdmin($data);
                    break;
                default:
                    $error = "Unknown [{$error_number}] an error occurred in file {$error_file} on line {$error_line}: {$error_message}";
                    $data = [
                        'to' => getenv('ADMIN_EMAIL'),
                        'subject' => 'System Error',
                        'view' => 'error',
                        'name' => 'Gravity',
                        'body' => $error
                    ];


                    ErrorHandler::emailAdmin($data);
                    break;
            }



        }
    }



    public function displayFriendlyError(){
        ob_end_clean();

        view('errors/generic');
        exit;
    }


    public static function emailAdmin($data){
        $mail = new MailWithGun();
        $mail->send($data);
        return new static;
    }


}






