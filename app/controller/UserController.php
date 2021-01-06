<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 6/1/2020
 * Time: 1:01 PM
 */

namespace App\Controller;


use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;
use App\models\User;
use App\Classes\Session;
use App\Classes\UploadFile;

class UserController extends BaseController
{


    public $orders, $payments, $order_details, $user, $imagePath;

    public function __construct()
    {



        if (!isAuthenticated()){
            Redirect::to('/');
        }

        $this->orders = Order::where('user_id', user()->id)->count();
//        $pay = Payment::where('user_id', user()->id)->sum('amount');
        $this->payments = Payment::where('user_id', user()->id)->sum('amount');
        $this->user = User::where('id', user()->id)->first();
        $this->order_details = OrderDetail::where('user_id', \user()->id)->with(['product'])->orderBy('id', 'DESC')->limit(5)->get();


    }


    public function userDashboard(){
        $orders = $this->orders;
        $payments = $this->payments;
        $order_details = $this->order_details;

        return view('user/dashboard', compact('orders', 'payments', 'order_details'));
    }


    public function getChartData(){
        $revenue = Capsule::table('payments')->where('user_id', \user()->id)->select(
            Capsule::raw('sum(amount) as `amount` '),
            Capsule::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),
            Capsule::raw('YEAR(created_at) year, Month(created_at) month'),
            Capsule::raw("DATE_FORMAT(created_at, '%M') month_name")
        )->groupby('year', 'month')->get();

        $orders = Capsule::table('orders')->where('user_id', \user()->id)->select(
            Capsule::raw('count(id) as `count` '),
            Capsule::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),
            Capsule::raw("YEAR(created_at) year, Month(created_at) month"),
            Capsule::raw("DATE_FORMAT(created_at, '%M') month_name")
        )->groupby('year', 'month')->get();

//        yearly orders


        echo json_encode(
            [
                'revenues' => $revenue,
                'orders' => $orders
            ]
        );
    }


    public function changePasswordForm(){
        $user = $this->user;
        return view('user/changePassword' , compact('user'));
    }


    public function changePassword($params){
        $id = $params['id'];
        $username = $params['user'];
        if(Request::exist('post')){
            $request = Request::get('post');

//            dnd((int)$id);
            if((int)$id === \user()->id){
                if(CSRFToken::checkToken($request->token, false)){

                    $rules = [
                        'old_password' => ['required' => true, 'minLength' => 6],
                        'new_password' => ['required' => true, 'minLength' => 6],
                        'confirm_password' => ['required' => true, 'minLength' => 6],
                    ];

                    $validation = new ValidateRequest;
                    $validation->abide($_POST, $rules);

                    if($validation->hasError()){
                        $errors = $validation->getErrorMessages();

                        $user = $this->user;
                        return view('/user/changePassword', compact('user', 'errors' ));
                    }


                    $user = User::select('password')->where([['role', 'user'], ['id', $id], ['username', $username]])->get();

                    if($request->new_password === $request->confirm_password){

                        foreach ($user as $password){
                            if (password_verify($request->old_password, $password->password)){

                                $newPassword = password_hash($request->new_password, PASSWORD_BCRYPT);
                                $user = User::where([['role', 'user'], ['id', $id], ['username', $username]])->update(['password' => $newPassword]);

                                if ($user){

                                    Session::flash('success', 'Your password has been changed successfully');
                                    Redirect::to('/profile/'.$username.'/change_password');

                                }

                            }else{

                                Session::flash('error', 'Please Enter a valid old password');
                                $user = $this->user;
                                return view('/profile/'.$username.'/change_password', compact('user'));

                            }


                        }

                    }

                    Session::flash('error', 'Please make sure your confirm password matches your new password');
                    $user = $this->user;
                    return view('/profile/'.$username.'/change_password', compact('user'));
                }
            }



        }

        return null;
    }


    public function userProfile($user){
        $user = $this->user;

        return view('user/profile', compact('user'));
    }

    public function userProfileUpdate($user){
        $username = $user['username'];

        if (Request::exist('post')){
            $requests = Request::get('post');
            $fileError = [];


            if (CSRFToken::checkToken($requests->token, false)){

                $policyRules = [

                    'fullname' => ['required'=>true, 'minLength'=>2,'maxLength'=>30, 'string'=>true],
                    'address' => ['required'=>true, 'minLength'=>2, 'maxLength'=>100,'mixed'=>true],
                    'gps' => ['required'=>true, 'minLength'=>2, 'maxLength'=>100,'mixed'=>true],
                    'region' => ['required'=>true, 'minLength'=>2, 'maxLength'=>20, 'string'=>true],
                    'city' => ['required'=>true, 'minLength'=>2,'maxLength'=>50, 'string'=>true],
                    'phone' => ['required'=>true, 'minLength'=>2, 'maxLength'=>10, 'number'=>true]
                ];



                //VALIDATE INPUTS
                $validator = new ValidateRequest;
                $validator->abide($_POST, $policyRules);

//                pnd(AuthController::verifyPassword($requests->password, $requests->confirmPassword));


                //Validate file
                $file = Request::get('file');
                isset($file->userImage->name)? $filename = $file->userImage->name : $filename = '';


                if ($filename != ''){

                    if(empty($filename)){
                        $fileError['image'] = ['The user image is required'];
                    }elseif (!UploadFile::isImage($filename)){
                        $fileError['image'] = ['Make sure the file is an Image'];
                    }elseif ($file->userImage->tmp_name === ''){
                        $fileError['image'] = ['Please select the file again'];
                    }elseif (UploadFile::fileSize($file->userImage->size)){
                        $fileError['image'] = ['Please select an image < 1mb'];
                    }

                }


                //CHECK IF VALIDATION HAS ERRORS
                if($validator->hasError() || count($fileError)){
                    $response = $validator->getErrorMessages();
                    count($fileError)? $errors = array_merge($response, $fileError) : $errors= $response;

                    if (count($errors)){
                        $user = $this->user;
                        return view('user/profile', compact('errors', 'user'));
                    }

                }

                $old_image = User::where('id',user()->id)->first();
                $this->imagePath = $old_image->image_path;


                if ($filename != ''){
                    $tmpFile = $file->userImage->tmp_name;
                    $optimideTo = "images" .DS. 'optimiseImages'. DS . "uploads".DS. 'users_pics'. DS . $this->user->username;
                    $folder = 'images'. DS . 'uploads'. DS . 'users'. DS . $this->user->username . DS . 'profile_pic';

                    //CREATE IMAGE PATH
                    $this->imagePath = UploadFile::move($tmpFile, $folder, $optimideTo, $filename, 'profile_pic')->optimisedPath();
                }



                if ($this->user->username){

                    $user = User::where([['role', 'user'], ['id', user()->id], ['username', $this->user->username]])->update([
                        'fullname' => $requests->fullname,
                        'city' => $requests->city,
                        'region' => $requests->region,
                        'address' => $requests->address,
                        'phone' => $requests->phone,
                        'gps' => $requests->gps,
                        'image_path' => $this->imagePath
                    ]);

                    if ($user){
                        Session::flash('success', 'Profile has been updated successfully');
                        Redirect::to('/profile/'.$this->user->username.'/profile');
                    }else{
                        Session::flash('error', 'Profile failed to be updated successfully');
                        Redirect::to('/profile/'.$this->user->username.'/profile');

                    }

                }



            }


        }
        return false;
    }


}




?>





