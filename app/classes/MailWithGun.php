<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 8/3/2020
 * Time: 11:23 AM
 */



namespace App\classes;

use Http\Adapter\Guzzle6\Client;
use Mailgun\Mailgun;
use PHPMailer\PHPMailer\PHPMailer;

class MailWithGun
{

    private $_mail, $mgClient, $domain;
    public function __construct()
    {

        $this->_mail = new PHPMailer;
        $this->mgClient = Mailgun::create(getenv('MAILGUN_PRIVATE_KEY'));
        $this->domain = getenv('MAILGUN_DOMAIN');
//        self::setup();

    }


    public static function setup(){
        $obj = new MailWithGun();

        $obj->_mail->isSMTP();
        $obj->_mail->Host = 'smtp.mailgun.org';
        $obj->_mail->Mailer = 'smtp';
        $obj->_mail->SMTPAuth = true;


        //DEBUG
        $env = getenv('APP_ENV');
        if ($env == 'local'){
            $obj->_mail->SMTPDebug = '2';
        }else{
            $obj->_mail->SMTPDebug = '';
        }

        // Enable SMTP authentication
        $obj->_mail->Username = getenv('MAILGUN_SMTP_USERNAME');
        $obj->_mail->Password = getenv('MAILGUN_SMTP_PASSWORD');
        $obj->_mail->SMTPSecure = 'tls';
        $obj->_mail->Port = getenv('MAILGUN_SMTP_PORT');

        $obj->_mail->From = getenv('MAILGUN_SENT_FROM') ;
        $obj->_mail->FromName = getenv('APP_NAME');
        $obj->_mail->addAddress( getenv('ADMIN_EMAIL'));

        $obj->_mail->WordWrap = 50;

        $obj->_mail->Subject = 'Hello Testing mailgun domain';
        $obj->_mail->Body    = 'Testing some Mailgun awesomness';

        if(!$obj->_mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $obj->_mail->ErrorInfo; exit();
        } else {
            echo 'Message has been sent'; exit();
        }
    }


    public function sendWithApi($data){

        $params = array(
            'from'    => getenv('APP_NAME')."<". getenv('MAILGUN_SENT_FROM') .">",
            'to'      => $data['to'],
            'cc'      => $data['cc'],
//            'bcc'     => 'john@example.com',
            'subject' => $data['subject'],
//            'text'    => 'Testing some Mailgun awesomness!',
            'html'    =>  make($data['view'], ['data' => $data['body']]),
//            'attachment' => array(
//                array(
//                    'filePath' => 'test.txt',
//                    'filename' => 'test_file.txt'
//                )
//            )
        );

        # Make the call to the client.
        try{
            $result = $this->mgClient->messages()->send($this->domain, $params);
//            pnd($result);
            return true;
        }catch (\Exception $e){
            if(getenv('APP_ENV') == 'local'){
                echo $e->getMessage(); exit();
            }
            echo "Email failed to send. Please try again later"; exit();
        }


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



