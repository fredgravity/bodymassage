<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 6/5/2020
 * Time: 8:10 AM
 */

namespace App\controller;


use App\classes\Cart;
use App\Classes\CSRFToken;
use App\classes\MailWithGun;
use App\Classes\Session;
use App\classes\TinggPayment;
use App\classes\TwilioSms;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Product;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\Mail;
use App\models\User;

class CartController extends BaseController
{


    public $cartTotal;

    public function __construct()
    {
        if(!isAuthenticated()){
            Redirect::to('/');
        }

    }

    public function showCart(){

//        dnd($_SESSION['user_cart']);
//        pnd(Session::delete('user_cart'));
        $item = '';
        $count = false;

        if (Session::get('user_cart') !== null){
            $count = count($_SESSION['user_cart']);
        }

        //CHECK IF THE IS SESSION FOR CART ITEMS AND IF IT IS NOT EMPTY
        if(!Session::exist('user_cart') || count(Session::get('user_cart')) < 1){
            $item = 'Cart is Empty';
//            dnd('hi');
            return view('cart', compact('item'));
        }

        $cart = self::getCartItems();


        return view('cart', compact('cart','item', 'count' ));

    }


    public static function getCartItems(){
//        pnd($_SESSION['user_cart']);

        try{
            $results = array();
            $checkoutItems = [];
            $cartTotal = 0;


            $index = 0;
            //LOOP
            foreach ($_SESSION['user_cart'] as $cart_items) {
                $product_id = $cart_items['product_id'];
                $hours = $cart_items['hours'];
                $session = $cart_items['session'];
                $date = $cart_items['date'];
                $orderNumber = $cart_items['order_number'];
                $place = $cart_items['place'];
                $placeName = $cart_items['place_name'];
                $refNo = $cart_items['ref_no'];

                //GET PRODUCT FROM DATABASE WITH THAT ID AND SHOW IN CART
                $item = Product::where('id', $product_id)->first();

                //SKIP ITEM IF NOT FOUND IN THE CART OR DB BUT STORED IN THE $_SESSION
                if(!$item){continue;}


                $totalPrice = $item->price * $hours;
                $cartTotal = $totalPrice + $cartTotal;
                $totalPrice = number_format($totalPrice, 2);

                array_push($results, [
                    'id' => $item->id,
                    'product_name' => $item->product_name,
                    'image' => $item->image_path,
                    'description' => $item->description,
                    'price' => $totalPrice,
                    'unitPrice' => number_format($item->price, 2),
                    'total' => $totalPrice,
                    'hours' => $hours, //THIS REFERS TO THE CART ITEM QUANTITY
//                    'stock' => $item->quantity, // THIS REFERS TO THE DB ITEM QUANTITY
//                    'newStock' => $item->quantity - $quantity,
                    'index' => $index,
                    'date' => $date,
                    'session' => $session,
                    'orderNumber' =>$orderNumber,
                    'place' => $place,
                    'place_name' => $placeName,
                    'ref_no' => $refNo

                ]);


                $index ++;

            }



            $cartTotal = number_format($cartTotal, 2);
            Session::set('cartTotal', $cartTotal);
//pnd($results);
            return ['results'=>$results, 'cartTotal'=>$cartTotal];

//            echo json_encode(['items' => $result, 'cartTotal' => $cartTotal, 'authenticated' => isAuthenticated()]); exit();

        }catch (\Exception $exception){
            if (getenv('APP_ENV') == 'local'){
                echo $exception->getMessage(); exit();
            }else{
                echo 'Something went wrong please try again later!;';
            }
        }
        return false;
    }


    public static function getCartTotal($cartTotal){
        $obj = new CartController;
        $obj->cartTotal = number_format($cartTotal, 2);
        return $obj->cartTotal;
    }


    public function removeItem($id){
//pnd($id['id']);
        if(Request::exist('post')) {
            $request = Request::get('post');
            if (CSRFToken::checkToken($request->token, false)){
                if ($id === ''){
                    throw new \Exception('Malicious activity detected');
                }

                if (Session::exist('user_cart') && count($_SESSION['user_cart']) == 1 ){
                    Session::delete('user_cart');
                    Session::flash('success', 'Booking removed successfully');
                    Redirect::to('/bookings/cart');
                }else{
                    //REMOVE ITEM
                    Cart::removeItem($id['id']);
//                echo json_encode(['success' => 'Product Removed from cart']); exit();
                    Session::flash('success', 'Booking removed successfully');
                    Redirect::to('/bookings/cart');
                }


            }

        }

    }



    public function checkoutSuccess(){

//        return view('/success');
    }

    public function notify($all){
        pnd($all);
    }


    public function saveBookingToOrder(){

        if (Request::exist('post')){
            $request = Request::get('post');
            if (CSRFToken::checkToken($request->token, false)){

                $carts = self::getCartItems();

                $sessions = Session::get('user_cart');

                $results = $carts['results'];
//pnd($carts);
                try{

                    $index = 0;
                    foreach ($results as $result){

                        Order::updateOrCreate([
                            'order_number' => $result['orderNumber']

                        ],
                            [
                                'user_id' => user()->id,
                                'product_id' => $result['id'],
                                'order_number' => $result['orderNumber'],
                                'reference_no' => $result['ref_no']

                            ]
                        );

                        $order = Order::where('order_number',$result['orderNumber'])->first();

                        if ($order){
                            $address = '';
                            if ($sessions[$index]['place'] === 'home'){
                                $address = User::findOrFail(\user()->id)->address;

                            }else{
                                $address = $sessions[$index]['place_name'];
                            }
                            $details = OrderDetail::updateOrCreate(
                                [
                                    'order_number' => $result['orderNumber']
                                ],
                                [
                                    'order_id' => $order->id,
                                    'user_id' => user()->id,
                                    'product_id' => $result['id'],
                                    'unit_price' => $result['unitPrice'],
                                    'session_time' => $sessions[$index]['session'],
                                    'hours' => $sessions[$index]['hours'],
                                    'total_price' => $result['total'],
                                    'order_number' => $result['orderNumber'],
                                    'date_picked' => $sessions[$index]['date'],
                                    'status' => 'pending',
                                    'place' => $sessions[$index]['place'],
                                    'place_name' =>$address,
                                    'reference_no' => $result['ref_no']

                                ]);


                        };

                        $index++;




                    };
                    echo json_encode(['result'=>true, 'res'=>$sessions, 'user'=>user(), 'total'=>Session::get('cartTotal')]); exit();
//        return true;

                }catch (\Exception $e){
                    if (getenv('APP_ENV') == 'local'){
                        echo $e->getMessage(); exit();
                    }else{
                        echo 'Something went wrong please try again later!;';
                    }

                }


            }
            return false;
        }
        return false;



//        Session::flash('success', 'Bookings saved successfully');
//        Redirect::to('/bookings/cart');


    }




    public function verifyFlutterWavePayment(){
        if (Request::exist('post')){
            $requests = Request::get('post');

//            pnd($requests);
            if ($requests->status == 'successful' && $requests->customer->email == \user()->email){
                $orderAmt = OrderDetail::where('reference_no', $requests->tx_ref)->sum('total_price');

                if ($orderAmt == Session::get('cartTotal')){
                    // update the order details and payment values
                    OrderDetail::where('reference_no', $requests->tx_ref)->update([
                        'status' => 'paid'
                    ]);

                    if (Session::exist('user_cart') && count($_SESSION['user_cart']) > 0 ){
                        foreach ($_SESSION['user_cart'] as $item) {

                            //GET PRODUCT FROM DATABASE WITH THAT ID AND SHOW IN CART
                            $prod = Product::where('id', $item['product_id'])->first();

                            //SKIP ITEM IF NOT FOUND IN THE CART OR DB BUT STORED IN THE $_SESSION
                            if(!$item){continue;}

                            Payment::updateOrCreate(
                                ['order_number' => $item['order_number']],

                                [
                                'user_id' => \user()->id,
                                'amount' => $prod->price * $item['hours'],
                                'status' => 'completed'

                                ]);
                        }

                        CartController::sendEmailAndSms();

                        Session::flash('success', 'Thank you for booking a massage with us, Please check your email for Details');

                        Session::delete('user_cart');
                        Session::delete('cartTotal');

                        echo json_encode(['redirect'=>true]); exit();
                    }




                }
            }

        }


    }



    public function flutterWaveCardPayment(){
        if (Request::exist('post')){
            $request = Request::get('post');
//pnd(is_numeric($request->cardNo));
            if (CSRFToken::checkToken($request->token, false)){
//                pnd($_SESSION['cartTotal']);
                CartController::validateCardPaymentInput($request->cardNo, $request->month, $request->year, $request->cvv);

                $cardDetails = [
                    "card_number"=>$request->cardNo,
                   "cvv"=>$request->cvv,
                   "expiry_month"=> $request->month,
                   "expiry_year"=>$request->year,
                   "currency"=>"GHS",
                   "amount"=>$_SESSION['cartTotal'],
                   "email"=>\user()->email,
                   "fullname"=>\user()->fullname,
                   "tx_ref"=>$_SESSION['user_cart'][0]['ref_no'],
                   "redirect_url"=>getenv('APP_URL')."/checkout/card_payment/response/"
                ];

                $secureData = encrypt3Des(json_encode($cardDetails), getenv("RAVE_ENCRYPTION_TEST_KEY"));
//                pnd($secureData);


                $header = array();
                $header[] = 'Content-Length: 0';
                $header[] = 'Accept:application/json';
                $header[] = 'Content-Type: application/json';
                $header[] = "Authorization: Bearer ".getenv('RAVE_SECRET_TEST_KEY');
//pnd($header);

                $jsonData = json_encode(['client'=>$secureData]);

                $ch = curl_init();
                $url = "https://api.flutterwave.com/v3/charges?type=card";
                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt($ch,CURLOPT_POST, 1);                //0 for a get request
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_HEADER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
                curl_setopt($ch,CURLOPT_POSTFIELDS, $jsonData);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
                curl_setopt($ch,CURLOPT_TIMEOUT, 20);

                $response = curl_exec($ch);
                pnd($response);
                curl_close ($ch);

            }

        }
    }



    public function flutterWaveCardPaymentResponse($all){
        dnd($all);
    }


    public static function validateCardPaymentInput($cardNo, $month, $year, $cvv){
        if (empty($cardNo) || empty($month) || empty($year) || empty($cvv)){
            echo json_encode(['msg'=> 'Input fields can not be blank', 'error'=>true ]); exit();
        }

        if (strlen($cardNo) !== 16){
            echo json_encode(['msg'=> 'Card Number input not up to required number, 16', 'error'=>true ]); exit();
        }elseif(!is_numeric($cardNo)){
            echo json_encode(['msg'=> 'Card Number input should be only be numbers', 'error'=>true ]); exit();
        }

        if (strlen($month) !== 2){
            echo json_encode(['msg'=> 'Card Month input not up to required number, 2', 'error'=>true ]); exit();
        }elseif(!is_numeric($cardNo)){
            echo json_encode(['msg'=> 'Card Month input should be only be numbers', 'error'=>true ]); exit();
        }

        if (strlen($year) !== 2){
            echo json_encode(['msg'=> 'Card Year input not up to required number, 2', 'error'=>true ]); exit();
        }elseif(!is_numeric($cardNo)){
            echo json_encode(['msg'=> 'Card Year input should be only be numbers', 'error'=>true ]); exit();
        }

        if (strlen($cvv) !== 3){
            echo json_encode(['msg'=> 'Card CVV input not up to required number, 3', 'error'=>true ]); exit();
        }elseif(!is_numeric($cardNo)){
            echo json_encode(['msg'=> 'Card CVV input should be only be numbers', 'error'=>true ]); exit();
        }

    }


    public static function sendEmailAndSms(){

        $sessions = Session::get('user_cart');


        foreach ($sessions as $session) {

            $product = Product::findOrFail($session['product_id']);


            if ($product){
                //SEND EMAIL TO CLIENT AND US
                $data = [
                    'to'    => getenv('ZOHO_BOOKING_EMAIL'),
                    'subject'=> 'Massage Booking is Set, Are you Ready!!',
                    'view'  => 'bookingSet',
                    'name'  => 'Admin',
                    'cc'    => user()->email,
                    'ccName'=> user()->fullname,
                    'body'  => [
                        'name' => user()->fullname,
                        'massageDate' => $session['date'],
                        'massageTime' => $session['session'],
                        'orderNumber' => $session['order_number'],
                        'productName' => $product->product_name,
                        'amount' => $product->price * $session['hours'],
                        'massageHour' => $session['hours'],
                        'place' => user()->address,
                        'place_name' => $session['place_name'],
                        'reference_number' => $session['ref_no'],
                        'district'  => \user()->district

                    ]
                ];

                CartController::emailAdmin($data);

                //SEND SMS TO CLIENT AND US
                CartController::sendSms(\user()->phone, $data);


            }


        }

    }


    public function callBack(){
        if (Request::exist('post')){
            $request = Request::get('post');

//pnd($request);
            //TODO: VERIFY THE PAYMENT AT PAYSTACK BEFORE CHANGING THE STATUS OF THE ORDER DETAILS
//            if (true){

            $verifyPaystack = self::verifyPaystackPayment($request->reference);
//pnd($verifyPaystack);

            if (array_key_exists('data', $verifyPaystack)  && array_key_exists('status', $verifyPaystack['data'])  && $verifyPaystack['data']['status'] === 'success' ){

                if ($verifyPaystack['data']['currency'] === 'GHS' && $verifyPaystack['data']['amount'] == Session::get('cartTotal')*100){
                    $sessions = Session::get('user_cart');
//pnd($sessions);

                    foreach ($sessions as $session) {

                        $product = Product::findOrFail($session['product_id']);


                        $orderTrue = OrderDetail::where('order_number', $session['order_number'])->update([
                            'status' => 'Paid'
                        ]);



                        if ($orderTrue){

                            Payment::updateOrCreate(
                                ['order_number' => $session['order_number']],

                                [
                                    'user_id' => \user()->id,
                                    'amount' => $product->price * $session['hours'],
                                    'status' => 'completed'

                                ]);

                            //SEND EMAIL TO CLIENT AND US
                            $data = [
                                'to'    => getenv('ZOHO_BOOKING_EMAIL'),
                                'subject'=> 'Massage Booking is Set, Are you Ready!!',
                                'view'  => 'bookingSet',
                                'name'  => 'Admin',
                                'cc'    => user()->email,
                                'ccName'=> user()->fullname,
                                'body'  => [
                                    'name' => user()->fullname,
                                    'massageDate' => $session['date'],
                                    'massageTime' => $session['session'],
                                    'orderNumber' => $session['order_number'],
                                    'productName' => $product->product_name,
                                    'amount' => $product->price * $session['hours'],
                                    'massageHour' => $session['hours'],
                                    'place' => user()->address,
                                    'place_name' => $session['place_name'],
                                    'reference_number' => $session['ref_no']

                                ]
                            ];

                            CartController::sendEmailAndSms();


                        }


                    }


                    Session::flash('success', 'Thank you for booking a massage with us, Please check your email for Details');

                    Session::delete('user_cart');
                    Session::delete('cartTotal');

                    echo json_encode(['redirectCart' => true]); exit();

                }

                echo json_encode(['redirectCart' => false]); exit();


            }

            echo json_encode(['redirectCart' => false]); exit();
        }
        echo json_encode(['redirectCart' => false]); exit();
    }


    public static function verifyPaystackPayment($reference){
        $paystackApiUrl = 'https://api.paystack.co/transaction/verify/'.$reference;
//pnd($paystackApiUrl);
        //open curl connection
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $paystackApiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if (getenv('APP_ENV') == 'local'){
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer '.getenv('PAYSTACK_TEST_SECRET_KEY')]);
        }else{
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer '.getenv('PAYSTACK_LIVE_SECRET_KEY')]);
        }
//        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer '.getenv('PAYSTACK_TEST_SECRET_KEY')]);

        //send request
        $request = curl_exec($ch);
//pnd($request);
        //close connection
        curl_close($ch);

        if ($request){
            $aryResult = json_decode($request, true);
            return $aryResult;
        }
        return false;
    }


    public static function emailAdmin($data){
        $mail = new MailWithGun();
        $response = $mail->sendWithApi($data);
        return $response ;
    }


    public static function sendSms($phone, $data){
        $message = "
                                    Dear, {$data['body']['name']},
                                    Massage Date = {$data['body']['massageDate']},
                                    Session Period = {$data['body']['massageTime']},
                                    Order Number = {$data['body']['orderNumber']},
                                    Massage Type = {$data['body']['productName']},
                                    Amount = GHS {$data['body']['amount']},
                                    Massage Duration = {$data['body']['massageHour']} hr(s),
                                    Massage Place = {$data['body']['place']},
                                    Massage Other Place = {$data['body']['place_name']},
                                    Massage Reference Number = {$data['body']['reference_number']},
                                    Massage District = {$data['body']['district']},
                
                            ";
        $phone = '+233'.$phone;
        TwilioSms::twilioSendSms($phone,$message);
    }


    public  function getSessionInfo (){
        $obj = new CartController;

        if ($obj->saveBookingToOrder()){
            echo json_encode(['res'=>$_SESSION['user_cart'], 'user'=>user(), 'total'=>$_SESSION['cartTotal']*100]); exit();
        }
        echo json_encode(['res'=> false]);

    }



    public function tinggPayload(){
        if (Request::exist('post')){
            $request = Request::get('post');


            if (CSRFToken::checkToken($request->token, false)){
                $cartSessions = Session::get('user_cart');

                foreach ($cartSessions as $item){
                    $prod = Product::findOrFail($item['product_id']);
//pnd($prod);
                    $payloads = [
                        'merchantTransactionID' => getenv('TINGG_ACCESS_KEY'),
                        'customerFirstName' => \user()->username,
                        'customerLastName'=> \user()->fullname,
                        'MSISDN'=> "+233".\user()->phone,
                        'customerEmail'=> \user()->email,
                        'requestAmount'=> $prod->price * $item['hours'],
                        'currencyCode'=> "GHS",
                        'accountNumber'=> $item['order_number'],
                        'serviceCode'=> getenv('TINGG_SERVICE_CODE'),
                        'dueDate' => CartController::getDeadlineTime(),
                        'requestDescription'=> $prod->product_name,
                        'countryCode'=> "GH",
                        'languageCode'=> "en",
                        'successRedirectUrl'=> getenv('TINGG_SUCCESS_REDIRECT_URL'),
                        'failRedirectUrl'=> getenv('TINGG_FAILED_REDIRECT_URL'),
                        'paymentWebhookUrl'=> getenv('TINGG_PAYMENT_WEBHOOK_URL')
                    ];
//                    pnd($payloads);

                    $results = TinggPayment::processTingg($payloads);



                    header('Content-Type: application/json');
                    echo json_encode(array("params" => $results)); exit();

                }


            }

        }
    }


    public function tinggPayloadSuccess(){

        return view('home');
    }

    public function tinggPayloadFailed(){
        $error=["Tingg payment processing failed. Please try again later"];
        return view('errors/generic', compact('error'));
    }

    public function tinggPaymentWebhook(){

    }


    public static function getDeadlineTime(){
        $time = 5 * 60; //5 minutes
//        $start_time = date('Y-m-d h:i:s', time() - $time);
        $end_time = date('Y-m-d h:i:s', time() + $time);
//        $testTime = $end_time." ".date('Y-m-d h:i:s', time());
        return $end_time;
    }



}

































