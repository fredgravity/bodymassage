<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 5/12/2020
 * Time: 2:30 PM
 */

namespace App\controller;
use App\Classes\Mail;
use App\Classes\Request;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;
use App\Classes\UploadFile;
use App\Classes\Session;
use App\models\User;
use App\Classes\Redirect;
use App\classes\Cookie;
use App\models\UserSession;
use App\classes\MailWithGun;


class AuthController extends BaseController
{
    public $users, $tableName ='users', $password, $imagePath;

    public function registerForm(){

            if (isset(user()->role) != 'admin'){
                $this->userAuthenticated();
            }



        $page_name = '';
        $uri = $_SERVER['REQUEST_URI'];
        ($uri === '/register')? $page_name = 'Register' : false;


            if (isset(user()->role) === 'admin'){
                return view('admin/register', compact('page_name'));
            }



        return view('auth/register', compact('page_name'));
    }

    public function register(){

        if (Request::exist('post')){
            $requests = Request::get('post');
            $fileError = [];
//            pnd($requests);
            if (CSRFToken::checkToken($requests->token, false)){

                //SET RULES 2 POLICY RULES FOR USER REGISTER AND FULL REGISTER
                if (count($_POST) > 7){
                    $policyRules = [
                        'username' => ['required'=>true, 'string'=>true, 'minLength'=>3, 'maxLength'=>20, 'unique'=>$this->tableName ],
                        'email' => ['required' => true, 'email' => true, 'unique' => $this->tableName],
                        'fullname' => ['required'=>true, 'minLength'=>2,'maxLength'=>30, 'string'=>true],
                        'address' => ['required'=>true, 'minLength'=>2, 'maxLength'=>100,'mixed'=>true],
                        'password' => ['required'=>true, 'minLength'=>4,'maxLength'=>20, 'mixed'=>true],
                        'confirmPassword' => ['required'=>true, 'minLength'=>4,'maxLength'=>20, 'mixed'=>true],
                        'region' => ['required'=>true, 'minLength'=>2, 'maxLength'=>20, 'mixed'=>true],
                        'city' => ['required'=>true, 'minLength'=>2,'maxLength'=>50, 'string'=>true],
                        'role' => ['required'=>true, 'minLength'=>2,'maxLength'=>7, 'string'=>true],
                        'phone' => ['required'=>true, 'minLength'=>2, 'maxLength'=>10, 'number'=>true],
//                    'description'=>['required'=>true, 'mixed'=>true, 'minLength'=>4, 'maxLength'=>200]
                    ];
                }else{

                    $policyRules = [
                        'username' => ['required'=>true, 'string'=>true, 'minLength'=>3, 'maxLength'=>20, 'unique'=>$this->tableName ],
                        'email' => ['required' => true, 'email' => true, 'unique' => $this->tableName],
                        'phone' => ['required'=>true, 'minLength'=>2, 'maxLength'=>10, 'number'=>true],
                        'fullname' => ['required'=>true, 'minLength'=>2,'maxLength'=>30, 'string'=>true],
                        'password' => ['required'=>true, 'minLength'=>4,'maxLength'=>20, 'mixed'=>true],
                        'confirmPassword' => ['required'=>true, 'minLength'=>4,'maxLength'=>20, 'mixed'=>true],

                    ];
                }



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
                        if(user()){
                            if (user()->role === 'admin'){
                                return view('admin/register', [
                                    'errors' => $errors,

                                ]);
                            }
                        }
                        return view('auth/register', [
                            'errors' => $errors,

                        ]);
                    }

                }



                if (isset($file->userImage->name)){
                    $tmpFile = $file->userImage->tmp_name;
                    $optimideTo = "images" .DS. 'optimiseImages'. DS . "uploads".DS. 'users_pics'. DS . $requests->username;
                    $folder = 'images'. DS . 'uploads'. DS . 'users'. DS . $requests->username. DS . 'profile_pic';

                    //CREATE IMAGE PATH
                    $this->imagePath = UploadFile::move($tmpFile, $folder, $optimideTo, $filename, 'profile_pic')->optimisedPath();
                }
//                dnd(AuthController::verifyPassword($requests->password, $requests->confirmPassword));

                if(AuthController::verifyPassword($requests->password, $requests->confirmPassword)){
                  // create user in db
                    $this->password = $requests->password;

                    if (isset(user()->role) === 'admin' || user()){
                        //send this password to user for entry


                        //INSERT INTO DB
                        AuthController::completeUser(
                            $requests->username,
                            $requests->email,
                            $this->password,
                            $requests->fullname,
                            $requests->role,
                            $requests->city,
                            $requests->region,
                            $requests->address,
                            $requests->phone,
                            $this->imagePath
                            );

                        // send password to registered user
//                        AuthController::sendPassword($requests->username,$requests->fullname, $requests->email, $this->password);

                        Request::refresh();
                        $success = $requests->username. ', has been registered successfully!';

                        view('admin/register', compact('success'));

                    }else{

                        AuthController::createUser(
                            $requests->username,
                            $requests->email,
                            $requests->phone,
                            $this->password,
                            $requests->fullname
                        );

                        Session::flash('success', $requests->username. ', has been registered successfully!');
                        Redirect::to('/');
                    }


                }else{
                    $errors = 'Passwords do not match!';
                    if (isset(user()->role) === 'admin'){
                        return view('admin/register', [
                            'errors' => $errors,

                        ]);
                    }
                    return view('auth/register', [
                        'errors' => $errors,

                    ]);
                };

            }else{
                $env = getenv('APP_ENV');
                if ($env == 'local'){
                    throw new \Exception('Token mismatch');
                }
                echo "Registration Failed, please try again later";exit();
            }

        }
        return null;
    }



    public function showLoginForm(){
        $this->userAuthenticated();

        return view('auth/login');
    }


    public function login(){
        if(Request::exist('post')){
            $request = Request::get('post');


            //VERIFY CSRF TOKEN
            if(CSRFToken::checkToken($request->token, false)){
                //CREATE VALIDATION RULES
                $rules = [
                    'username' => ['required' => true],
                    'email' => ['required' => true],
                    'password' => ['required' => true ],
                    'remember_me' => ['string' => true, 'minLength' => 2, 'maxLength'=>3]

                ];

                $validate = new ValidateRequest;
                $validate->abide($_POST, $rules);

                if ($validate->hasError()){
                    $errors = $validate->getErrorMessages();

                    return view('auth/login', compact('errors'));
                }

                //CHECK IF USER EXIST IN THE DB
                $user = User::where('username', $request->username)->orWhere('email', $request->username)->first();

                if($user){
                    if (!password_verify($request->password, $user->password)){
                        Session::flash('error', 'Username or Password is incorrect');
                        Redirect::to('/login');

//                    }
//                    elseif ($user->verified === null){
//                        Session::flash('error', 'Email verification link has been sent. Please verify your account to login');
//                        return view('/login');
                    } else{

                        //REMEMBER ME LOGIN INFORMATION
                        if (!empty($_POST['remember_me'])){
                            AuthController::remember($request->remember_me, $user->id);
                        }


                        Session::set('SESSION_USER_ID', $user->id);
                        Session::set('SESSION_USER_NAME', $user->username);


                        //CHECK ROLE OF USER AND REDIRECT TO APPROPRIATE PAGE
                        if($user->role == 'admin'){
                            Redirect::to('/admin/'.user()->username);
                        }else if($user->role == 'user' && Session::exist('bookings')){
                            Redirect::to('/bookings');
                        }else if($user->role == 'user' && !Session::exist('user_cart')){
                            Redirect::to('/');
                        }else if($user->role == 'worker'){
                            Redirect::to('/');
                        }


                    }
                }else{
                    Session::flash('error', 'Username or Password is incorrect');
                    Redirect::to('/login');
                }


//               refresh();
//                $categories = Category::all();
//                return view('/register', ['success' => 'Account created successfully!. Please login', 'categories' => $categories]);

            }else{
                $env = getenv('APP_ENV');
                if ($env == 'local'){
                    throw new \Exception('Token mismatch');
                }

            }
        }
    }

    public function logout(){

        if(isAuthenticated()){
            Session::delete('SESSION_USER_ID');
            Session::delete('SESSION_USER_NAME');

            if (Cookie::exist(getenv('COOKIE_NAME'))){
                Cookie::deleteCookie(getenv('COOKIE_NAME'));
            }

            if (Session::exist('user_cart')){
                session_destroy();
//                session_regenerate_id(true);
            }
        }

        Redirect::to('/');
    }

    public static function createUser($username, $email, $phone, $password, $fullname, $role='user'){
        User::create([
            'username' => $username,
            'email' => $email,
            'phone' => $phone,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'fullname' => $fullname,
            'role' => $role,
        ]);

        $user = User::where('username', $username)->first();

        //send welcome email to new user

        $details = [
            'username' => $user->username,
            'fullname' => $user->fullname,
        ];

        $data = [

            'to'    => $user->email,
            'subject'=> 'Welcome '.$user->username,
            'view'  => 'welcome',
            'cc'  => getenv('ADMIN_EMAIL'),
            'ccName'  => 'Masartgh Team',
            'name'  => 'Admin',
            'body'  => $details

        ];
//pnd($data);
        AuthController::sendWelcomeEmail($data);

        if ($user){
            Session::set('SESSION_USER_ID', $user->id);
            Session::set('SESSION_USER_NAME', $user->username);

            //CHECK ROLE OF USER AND REDIRECT TO APPROPRIATE PAGE
            if($user->role == 'admin'){
                Redirect::to('/admin');
            }else if($user->role == 'user' && Session::exist('bookings')){
                Redirect::to('/bookings');
            }else if($user->role == 'user' && !Session::exist('user_cart')){
                Redirect::to('/');
            }else if($user->role == 'worker'){
                Redirect::to('/worker');
            }
        }


    }


    public static function completeUser($username, $email, $password, $fullname, $role, $city, $region, $address, $phone, $imagePath){
        User::create([
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'fullname' => $fullname,
            'city' => $city,
            'region' => $region,
            'address' => $address,
            'role' => $role,
            'phone' => $phone,
            'image_path' => $imagePath,

        ]);
    }


    public static function remember($remember = null, $userId){
        if ($remember === 'on'){
            $cookieName = getenv('COOKIE_NAME');
            $rememberMeID  = md5(random_bytes(128) );
            $rememberMeHash = md5( random_bytes(128));
            $uagent = Session::uagentNoVersion();
//pnd($rememberMeHash);
            //GET USER ID AND CHECK IF COOKIE ALREADY EXIST
            $oldSession = UserSession::where('user_id', $userId)->first();


            //SET COOKIE
            Cookie::setCookie($cookieName, $rememberMeHash, getenv('COOKIE_EXPIRY'));

            if ($oldSession){
                UserSession::updateOrCreate(
                    ['user_id' => $userId, 'user_agent' => $oldSession->user_agent],
                    ['cookie_id' => $rememberMeID, 'cookie_hash' => $rememberMeHash , 'user_agent' => $uagent]
                );

            }else{
                UserSession::updateOrCreate(
                    ['user_id' => $userId],
                    ['cookie_id' => $rememberMeID, 'cookie_hash' => $rememberMeHash , 'user_agent' => $uagent]
                );

            }

        }
        return false;
    }


    public function userAuthenticated()
    {

        if(isAuthenticated()){
            Redirect::to('/');
        }
        return false;
    }


    public static function emailVerification($request){
        $vkey = md5(time().$request->username);
        return $vkey;
    }

    public static function sendPassword($username,$fullname, $email, $password){

        $details = [
            'username' => $username,
            'email' => $email,
            'password' => $password
        ];
        $data = [

            'to'    => $email,
            'name'    => $fullname,
            'subject'=> 'Your new user Details',
            'view'  => 'user_details',
            'body'  => $details

        ];

        $mail = new Mail;
        $mail->send($data);
        return new static;

    }


    public static function sendWelcomeEmail($data){
        $mail = new MailWithGun();
        $response = $mail->sendWithApi($data);
        return $response ;
    }


    public static function verifyPassword($password, $confirmPassword){
        if (strlen($password) == strlen($confirmPassword)){
            //password hash

            $hashPassword = password_hash($password, PASSWORD_BCRYPT);

            return password_verify($confirmPassword, $hashPassword);
        }
        return false;
    }

    public static function sendVerificationEmail($data){
        $mail = new Mail;
        $mail->send($data);
        return new static;
    }

}




