<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 5/9/2020
 * Time: 4:26 PM
 */

namespace App\Controller;


use App\classes\Cart;
use App\classes\LocationData;
use App\Classes\Mail;
use App\classes\MailWithGun;
use App\Classes\Redirect;
use App\Classes\Session;
use App\Classes\ValidateRequest;
use App\Classes\Request;
use App\Classes\CSRFToken;
use App\Models\District;
use App\Models\OrderDetail;
use App\Models\Product;
use App\models\User;


class IndexController extends BaseController
{

    private $sessionTime = ['first', 'second', 'third'], $hours = [1,1.5,2,3], $order_number, $dateTimesInADay = 3, $count;


    public function __construct()
    {

        $this->order_number = generateOrderNumber();
        if (Session::exist('user_cart')){
            $this->count = count($_SESSION['user_cart']);
        }

//        MailWithGun::sendWithApi();
//        MailWithGun::setup();
    }

    public function showIndex(){
        $count = $this->count;

        return view('home',  compact('count'));
    }



    public function contactUs(){
        $count = $this->count;

        return view('/contactus', compact('count'));
    }

    public function contactUsSend(){

        if (Request::exist('post')){
            $request = Request::get('post');

            if (CSRFToken::checkToken($request->token, false)){
//                pnd($request);

                //CREATE VALIDATION RULES
                $rules = [
                    'phone' => [ 'number' => true, 'minLength' => 5, 'maxLength' => 15 ],
                    'email' => ['required' => true, 'email' => true, 'mixed' => true],
                    'fullname' => ['required' => true, 'minLength' => 6, 'maxLength' => 50],
                    'message' => ['required' => true, 'minLength' => 5, 'maxLength' => 200, 'mixed' => true]
                ];

                $validate = new ValidateRequest;
                $validate->abide($_POST, $rules);

                if ($validate->hasError()){
                    $errors = $validate->getErrorMessages();
                    $count = $this->count;
                    return view('/contactus', compact('errors', 'count'));

                }



                //SEND EMAIL TO ARTISAO ADMIN
                $data = [
                    //TODO: use artisao enquiry email address for contact us
                    'to'    => getenv('ZOHO_CONTACT_EMAIL'),
                    'subject'=> 'Contact Us',
                    'view'  => 'contactus',
                    'name'  => 'Admin',
                    'cc'  => $request->email,
                    'body'  => [
                        'name' => $request->fullname,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'message' => $request->message
                    ]
                ];

                 if (IndexController::emailAdmin($data)){
                     Session::flash('success', 'Email has been sent to admin. Please expect our feedback soon');
                     Redirect::to('/contact_us');
                 }
                $errors = ['Email has not been sent to admin. Please try again later'];
                 $count = $this->count;
                return view('/contactus', compact('errors', 'count'));

            }


        }
        return false;
    }



    public function requestQuote(){

        if (Request::exist('post')){
            $request = Request::get('post');

            if (CSRFToken::checkToken($request->token, false)){
//                pnd($request);

                //CREATE VALIDATION RULES
                $rules = [
                    'phone' => [ 'number' => true, 'minLength' => 5, 'maxLength' => 15 ],
                    'email' => ['required' => true, 'email' => true, 'mixed' => true],
                    'fullname' => ['required' => true, 'minLength' => 6, 'maxLength' => 50],
                    'organisation' => ['required' => true, 'minLength' => 6, 'maxLength' => 70],
                    'needs' => ['required' => true, 'minLength' => 5, 'maxLength' => 200, 'mixed' => true]
                ];

                $validate = new ValidateRequest;
                $validate->abide($_POST, $rules);

                if ($validate->hasError()){
                    $errors = $validate->getErrorMessages();
                    $count = $this->count;
                    return view('/corporate', compact('errors','count'));

                }



                //SEND EMAIL TO ARTISAO ADMIN
                $data = [
                    //TODO: use artisao enquiry email address for contact us
                    'to'    => getenv('ZOHO_ENQUIRY_EMAIL'),
                    'subject'=> 'Quote Requested',
                    'view'  => 'requestQuote',
                    'name'  => 'Admin',
                    'cc' => $request->email,
                    'body'  => [
                        'name' => $request->fullname,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'organisation' => $request->organisation,
                        'needs' => $request->needs
                    ]
                ];

                if (IndexController::emailAdmin($data)){
                    Session::flash('success', 'Email has been sent to admin. Please expect our feedback soon');
                    Redirect::to('/corporate');
                }
                $errors = ['Failed to request Quote. Please try again later'];
                $count = $this->count;
                return view('/corporate', compact('errors', 'count'));

            }

        }
        return false;
    }



    public function massages(){
        $products = Product::all();
        $count = $this->count;
        return view('/massage', compact('products', 'count'));
    }

    public function massageDescription($id){
        $product = Product::findOrFail($id)->first();

        echo json_encode(['desc'=>$product->description, 'prod_name'=>$product->product_name, 'prod_id'=>$product->id, 'prod_price'=>$product->price]);
    }


    public static function emailAdmin($data){
        $mail = new MailWithGun();
        $response = $mail->sendWithApi($data);
//         $response = $mail->send($data);
        return $response ;
    }



    public function bookings(){

        $products = Product::all();
        $districts = District::all();
        if (user()){
            $userCity = \user()->city;
            $user = str_replace(' ', '+', $userCity);
        }else{
            $user = '';
        }
//pnd($districts);

        $count = $this->count;
        return view('booking', compact('products','districts', 'user', 'count'));
    }

    public function getMassageImage($id){
        if (Product::find($id)->count() == 1){
            $product =  Product::find($id)->first();
            $image = $product->image_path;
            echo json_encode(['image' => $image]);
        };

    }


    public function massageCheckout(){
        if (Request::exist('post')){
            $requests = Request::get('post');
//pnd($requests);
            if (CSRFToken::checkToken($requests->token, false)){

                if (in_array($requests->massageHours, $this->hours) && in_array($requests->massageTime, $this->sessionTime) && !empty($requests->datePicker)){

                    //CREATE VALIDATION RULES
                    $rules = [
                        'massageId' => [ 'required' => true, 'number' => true, 'minLength' => 1 ],
                        'massageHours' => ['required' => true, 'number' => true, 'minLength' => 1 ],
                        'massageTime' => ['required' => true, 'minLength' => 5, 'string'=>true],
                        'datePicker' => ['required' => true, 'mixed' => true],
                        'place' => ['required'=> true, 'string'=>true, 'maxLength'=>20],
                        'place_name' => ['required'=>true, 'mixed'=>true, 'maxLength'=>100],
                        'gps' => ['mixed'=>true,'minLength'=>5, 'maxLength'=>100],
                        'city' => [ 'string'=>true,'minLength'=>3, 'maxLength'=>100],
                        'district' => ['required'=>true, 'string'=>true,'minLength'=>3, 'maxLength'=>100],
                    ];

                    $validate = new ValidateRequest;
                    $validate->abide($_POST, $rules);

                    if ($validate->hasError()){
                        $errors = $validate->getErrorMessages();
//                        pnd($errors);

                        Session::flash('error', 'Please fill out required fields(*). Fields can contain only letters, numbers, dashes and spaces');
                        echo json_encode(['redirect'=>true]); exit();

                    }

                    if (!isAuthenticated()){
                        Session::set('bookings', true);
                        Session::flash('error', 'You need to be logged in to be able to book a session');
                        echo json_encode(['redirectAuth'=>true]); exit();
                    }else{

                        //disable dates after its been booked 3 times same day, same session


                        $orderDetails = OrderDetail::where([
                            ['session_time' , $requests->massageTime],
                            ['date_picked' , $requests->datePicker]
                        ])->get();



                        $dbDate = [];
                        $dbTime = [];

                        foreach ($orderDetails as $orderDetail) {
                            $dbDate[] = $orderDetail['date_picked'];
                            $dbTime[] = $orderDetail['session_time'];
                        };


                        $countsdate = [];
                        $countTime = [];
                        if (Session::exist('user_cart')){
                            foreach ($_SESSION['user_cart'] as $item) {
                                $countsdate[] = $item['date'];
                                $countTime[] = $item['session'];

                            }
                        }


                        if (count(array_merge($dbDate, $countsdate)) >=3 && count(array_merge($dbTime, $countTime)) >=3 ){
                            echo json_encode(['redirectDateMax'=>true]);
//                            self::disableDate($orderDetails);
                            exit();
                        }

                        //check whether user is booking from accra region
                        if (LocationData::getLocation('regionName') !== 'Greater Accra Region'){
                            echo json_encode(['redirectNotAccra' => true]);
                            exit();
                        }


                        if (Session::exist('user_cart')){
                            if ( count($_SESSION['user_cart']) <=2 ){
                                Cart::add($requests);

                                User::updateOrCreate([
                                    'id' => \user()->id
                                ],
                                    [
                                        'address' => $requests->place_name,
                                        'gps' => $requests->gps,
                                        'city' => $requests->city,
                                        'district' => $requests->district
                                ]);

                                echo json_encode(['redirectAdded'=>true, 'count'=>count($_SESSION['user_cart'])]);

                                exit();
                            }
                            echo json_encode(['maxReached'=>true]); exit();

                        }else{
                            Cart::add($requests);

                            User::updateOrCreate([
                                'id' => \user()->id
                            ],
                                [
                                    'address' => $requests->place_name,
                                    'gps' => $requests->gps,
                                    'city' => $requests->city,
                                    'district' => $requests->district
                                ]);

                            echo json_encode(['redirectAdded'=>true , 'count'=>count($_SESSION['user_cart'])]); exit();
                        }




//

                    }


                }else{
                    Session::flash('error', 'Invalid booking information');
                    echo json_encode(['redirect'=>true]); exit();
                }



            }

        }
    }



    public static function disableDate($orderDetails){
        $disabledDate = [];

        foreach ($orderDetails as $orderDetail) {
            $disabledDate[] = $orderDetail['date_picked'];
        }


        if (count($disabledDate) == 3){
            echo json_encode(['disabled' => $disabledDate]);exit();
        }
    }


    public function maxedOut(){
        if (Request::exist('post')){
            $request = Request::get('post');
//            pnd($request);
            $orderDetails = OrderDetail::where([
                ['session_time' , $request->session_time],
                ['date_picked' , $request->date_picked]
            ])->count();

            if ($orderDetails > 3){
                echo json_encode(['response' => true]); exit();
            }
            echo json_encode(['response' => false]); exit();

        }


    }


    public function aboutUs(){
        $count = $this->count;
        return view('aboutUs', compact('count'));
    }

    public function corporate(){
        $count = $this->count;

        return view('corporate', compact('count'));
    }

    public function termsAndCondition(){
        return view('terms_and_condition');
    }

    public function privacy(){
        return view('privacy');
    }


}












