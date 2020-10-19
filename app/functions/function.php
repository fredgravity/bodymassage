<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 5/9/2020
 * Time: 5:19 PM
 */

use Philo\Blade\Blade;
use App\Classes\Session;
use App\models\User;
use voku\helper\Paginator;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Support\Carbon;

function view($path, array $data = []){
    $view = __DIR__.'/../../resources/views';
    $cache = __DIR__.'/../../bootstrap/cache';
    $blade = new Blade($view, $cache);

    echo $blade->view()->make($path, $data)->render();


};


function make($fileName, $data){

    extract($data);

    //TURN ON OUTPUT BUFFERING
    ob_start();

    //INCLUDE THE TEMPLATE
    include PROOT."resources". DS . "views". DS. "emails". DS . $fileName .'.php';

    //GET THE BUFFER CONTENT
    $content = ob_get_contents();

    //CLEAN OUTPUT AND TURN OF OUTPUT BUFFERING
    ob_end_clean();

    return $content;


}


function get_ip(){
    $ip = '';
    if (isset($_SERVER['HTTP_CLIENT_IP'])){
//        pnd('hi');
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
//        pnd('hi2');
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
//        pnd($_SERVER['HTTP_X_FORWARDED_FOR']);
        $ip = (isset($_SERVER['REMOTE_ADDR'])? $_SERVER['REMOTE_ADDR'] : '' );
    }

    return $ip;
}



function encrypt3Des($data, $key){

    $encData = openssl_encrypt($data, 'DES-EDE3', $key, OPENSSL_RAW_DATA);

    return base64_encode($encData);

}

function generateRandomString($len){
    $char = 'abcdefghijklmnopqrstuvwxyz';
    $charLen = strlen($char) -1;
    $string = '';

    for ($i=0; $i<$len; $i++){
        $randNum = mt_rand(0, $charLen);
        $string .= $char[$randNum];
    }

    return strtoupper($string);
}


function isAuthenticated(){
    return Session::exist('SESSION_USER_NAME')? true : false;


}

function generateReferenceNo(){

    if (isset($_SESSION['user_cart']) && $_SESSION['user_cart'][0]['ref_no'] != null){
        $result = $_SESSION['user_cart'][0]['ref_no'];
        return  $result;
    }else{
        $result = 'REF_'.rand(1000,1000000)."_".generateRandomString(6);
        return $result;
    }
}

function generateOrderNumber(){
    $orderNumber = 'ORD_'. random_int(1, 1000000).generateRandomString(4);
    return $orderNumber;
}


function recaptcha($captcha){

    if(!$captcha){
        echo json_encode( ['response' => true]);
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

    pnd($responseKeys);

    if($responseKeys["success"] && $responseKeys['score'] >= 0.5) {
//        return true;
        echo json_encode(array('success' => 'true')); exit();
    } else {
        echo json_encode(array('success' => 'false'));exit();
//        return false;
    }
}




function user(){
    if (isAuthenticated()){
        return User::findOrFail(Session::get('SESSION_USER_ID'));
    }
    return false;
}


function paginateUsers($recordsNum, $totalRecords, $tableName, $obj){

    //CREATE A PAGINATION WITH THE NUMBER OF SPECIFIED RECORD AND INSTANTIATE IT (p)
    $pages = new Paginator($recordsNum, 'p');

    //SET THE TOTAL NUMBER OF RECORDS REQUIRED
    $pages->set_total($totalRecords);

    if ($recordsNum > $totalRecords){
        $data = Capsule::select("SELECT * FROM $tableName WHERE role = 'user' AND deleted_at is null ORDER BY created_at DESC");
    }else{
        $data = Capsule::select("SELECT * FROM $tableName WHERE role = 'user' AND deleted_at is null ORDER BY created_at DESC {$pages->get_limit()}");
    }

//    pnd($totalRecords);

    //CALL THE OBJ CLASS AND PERFORM THE TRANSFORM METHOD
    $users = $obj->transformToArray($data);
//    pnd($obj->transformToArray($data));
    //GET THE CATEGORIES FROM DB AND CREATE PAGE LINKS
    return [$users, $pages->page_links()];
}


function paginateWorkers($recordsNum, $totalRecords, $tableName, $obj){

    //CREATE A PAGINATION WITH THE NUMBER OF SPECIFIED RECORD AND INSTANTIATE IT (p)
    $pages = new Paginator($recordsNum, 'p');

    //SET THE TOTAL NUMBER OF RECORDS REQUIRED
    $pages->set_total($totalRecords);

    if ($recordsNum > $totalRecords){
        $data = Capsule::select("SELECT * FROM $tableName WHERE role = 'worker' AND deleted_at is null ORDER BY created_at DESC");
    }else{
        $data = Capsule::select("SELECT * FROM $tableName WHERE role = 'worker' AND deleted_at is null ORDER BY created_at DESC {$pages->get_limit()}");
    }


    //CALL THE OBJ CLASS AND PERFORM THE TRANSFORM METHOD
    $users = $obj->transformToArray($data);
//    pnd($obj->transformToArray($data));
    //GET THE CATEGORIES FROM DB AND CREATE PAGE LINKS
    return [$users, $pages->page_links()];
}

function paginatePayments($recordsNum, $totalRecords, $tableName, $obj){

    //CREATE A PAGINATION WITH THE NUMBER OF SPECIFIED RECORD AND INSTANTIATE IT (p)
    $pages = new Paginator($recordsNum, 'p');

    //SET THE TOTAL NUMBER OF RECORDS REQUIRED
    $pages->set_total($totalRecords);

    if ($recordsNum > $totalRecords){
        $data = Capsule::select("SELECT * FROM $tableName WHERE deleted_at is null ORDER BY created_at DESC");
    }else{
        $data = Capsule::select("SELECT * FROM $tableName WHERE deleted_at is null ORDER BY created_at DESC {$pages->get_limit()}");
    }




    //CALL THE OBJ CLASS AND PERFORM THE TRANSFORM METHOD
    $payments = $obj->transformToArray($data);

    //GET THE CATEGORIES FROM DB AND CREATE PAGE LINKS
    return [$payments, $pages->page_links()];
}


function paginate($recordsNum, $totalRecords, $tableName, $obj){

    //CREATE A PAGINATION WITH THE NUMBER OF SPECIFIED RECORD AND INSTANTIATE IT (p)
    $pages = new Paginator($recordsNum, 'p');

    //SET THE TOTAL NUMBER OF RECORDS REQUIRED
   $pages->set_total($totalRecords);

    if ($recordsNum > $totalRecords){
        $data = Capsule::select("SELECT * FROM $tableName WHERE deleted_at is null ORDER BY created_at DESC");
    }else{
        $data = Capsule::select("SELECT * FROM $tableName WHERE deleted_at is null ORDER BY created_at DESC {$pages->get_limit()}");
    }

//pnd($pages->get_limit());

    //CALL THE OBJ CLASS AND PERFORM THE TRANSFORM METHOD
    $data = $obj->transformToArray($data);

    //GET THE CATEGORIES FROM DB AND CREATE PAGE LINKS
    return [$data, $pages->page_links()];
}


function paginateOrder($recordsNum, $totalRecords, $tableName, $obj){

    //CREATE A PAGINATION WITH THE NUMBER OF SPECIFIED RECORD AND INSTANTIATE IT (p)
    $pages = new Paginator($recordsNum, 'p');

    //SET THE TOTAL NUMBER OF RECORDS REQUIRED
    $pages->set_total($totalRecords);

    $data = Capsule::select("SELECT * FROM $tableName WHERE deleted_at is null ORDER BY created_at DESC {$pages->get_limit()}");

    //SELECT THE RECORD TO PAGINATE FROM THE DATABASE
//    $data = Capsule::select("SELECT * FROM $tableName WHERE deleted_at is null AND role = 'user' ORDER BY created_at DESC ". $pages->get_limit());

    //CALL THE OBJ CLASS AND PERFORM THE TRANSFORM METHOD
    $users = $obj->transformToArray($data);
//    pnd($obj->transformToArray($data));
    //GET THE CATEGORIES FROM DB AND CREATE PAGE LINKS
    return [$users, $pages->page_links()];
}


function transformToArray($data){
    $users = []; //SET UP CATEGORIES ARRAY
//pnd('hi');
    foreach ($data as $field){
        //CARBON FORMAT DATE FROM DB PROPERLY
        $added = new Carbon($field->created_at);

        array_push($users, [

            'added' => $added->toFormattedDateString()
        ]);
    }
    return $users;
}










