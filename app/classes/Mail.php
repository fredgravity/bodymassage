<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 5/9/2020
 * Time: 6:55 PM
 */

namespace App\Classes;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Mail
{

    protected $_mail;

    public function __construct()
    {
        $this->_mail = new PHPMailer;
        $this->setUp();
    }

    public function setUp(){

        $this->_mail->isSMTP();
        $this->_mail->Mailer = 'smtp';
        $this->_mail->SMTPAuth = true;
        $this->_mail->SMTPSecure = 'tls';

        //HOST AND PORT
        $this->_mail->Host = getenv('SMTP_HOST');
        $this->_mail->Port = getenv('SMTP_PORT');

        //ADD CUSTOM HEADERS


        //DEBUG
        $env = getenv('APP_ENV');
        if ($env == 'production'){
            $this->_mail->SMTPDebug = '';
        }else{
            $this->_mail->SMTPDebug = '';
        }

        //AUTHENTICATION INFO
        $this->_mail->Username = getenv('EMAIL_USERNAME');
        $this->_mail->Password = getenv('EMAIL_PASSWORD');

        $this->_mail->isHTML(true);
        $this->_mail->SingleTo = true;

        //SENDER INFORMATION
        $this->_mail->From = getenv('ADMIN_EMAIL');
        $this->_mail->FromName = getenv('APP_NAME');

        $this->_mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

    }

    public function send($data, $cc=false){

        //RECIPIENT ADDRESS
        $this->_mail->addAddress($data['to'], $data['name']);
        $this->_mail->Subject = $data['subject'];
        $this->_mail->Body = make($data['view'], ['data' => $data['body']]);

        if ($cc){
            $this->_mail->addCC($data['cc'], $data['ccName']);
        }

        try{
            return $this->_mail->send();
        }catch (Exception $e){
            return 'Message: '.$e->getMessage();
        }

    }


}



