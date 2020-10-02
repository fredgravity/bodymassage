<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 5/12/2020
 * Time: 1:39 PM
 */

namespace App\controller\admin;


use App\Classes\CSRFToken;
use App\Classes\Request;
use App\Controller\BaseController;
use App\models\User;
use App\Classes\ValidateRequest;
use App\Classes\UploadFile;
use App\Classes\Session;
use App\Classes\Redirect;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\classes\Role;


class UserController extends BaseController
{

    public $users, $tableName ='users',  $user, $workers, $usersLink, $workersLink;

    public function __construct()
    {

        if (!Role::middleware('admin')){
            Redirect::to('/');
        };

        $this->users = User::where('role', 'user')->orderBy('id', 'DESC')->get();
        $this->workers = User::where('role', 'worker')->orderBy('id', 'DESC')->get();
        $total = count($this->users);
        $totalw = count($this->workers);
        list($this->users, $this->usersLink) = paginateUsers(15, $total, $this->tableName, new User());
        list($this->workers, $this->workersLink) = paginateWorkers(10, $totalw, $this->tableName, new User());


    }


    public function showIndex(){
        $users = $this->users;
        $links = $this->usersLink;
        $role = 'user';
//        if ($users)
        return view('admin/user/index', compact('users', 'links', 'role'));
    }


    public function showWorkers(){

        $workers = $this->workers;
        $links = $this->workersLink;
        $role = 'worker';

        return view('admin/user/index', compact('workers', 'role', 'links'));
    }

    public function editUser($params){
        $user = UserController::getUser($params['id']);


        return view('admin/user/editUser', ['user'=>$user]);
    }


    public function updateUser($params){
        if (Request::exist('post')){
            $requests = Request::get('post');
            $fileError = [];
//pnd($requests);
            $id = $params['id'];

            if (CSRFToken::checkToken($requests->token, false)){
                $this->user = User::find($id);
                if ((int)$id && $this->user){

                    $rules = [

                        'fullname' => ['required' => true, 'minLength' => 6, 'maxLength' => 50, 'mixed'=>true],
                        'address' => ['required' => true, 'minLength' => 4, 'maxLength' => 500, 'mixed' => true],
                        'gps' => [ 'minLength' => 4, 'maxLength' => 500, 'mixed' => true],
                        'region' => [ 'minLength' => 4, 'maxLength' => 50, 'mixed' => true],
                        'city' => ['required' => true, 'minLength' => 3, 'maxLength' => 50, 'string' => true],
                        'role' => ['required' => true, 'minLength' => 3, 'maxLength' => 7, 'string' => true],
                        'phone' => ['required' => true, 'minLength' => 4, 'maxLength' => 15, 'number' => true],

                    ];

                    $validate = new ValidateRequest;
                    $validate->abide($_POST, $rules);

                    //VALIDATE UPLOADED FILE
                    $file = Request::get('file');
                    $imagePath = '';
                    //UPDATE PROFILE IMAGE IF AN IMAGE HAS BEEN PROVIDED
                    isset($file->userImage->name)? $filename = $file->userImage->name : $filename = '';

                    if($filename !== '') {
                        if (empty($filename)) {
                            $fileError['userImage'] = 'The user image is required';
                        } elseif (!UploadFile::isImage($filename)) {
                            $fileError['userImage'] = 'Please make sure the file is an image';
                        }elseif (UploadFile::fileSize($file->userImage->size)){
                            $fileError['userImage'] = ['Please select an image < 500kb'];
                        }

                    }

                    if ($file->userImage->tmp_name) {
                        //change profile image if new image is selected
                        $tmpFile = $file->userImage->tmp_name;
                        $optimideTo = "images" .DS. 'optimiseImages'. DS . "uploads".DS. 'users_pics'. DS . $this->user['username'];
                        $folder = 'images'. DS . 'uploads'. DS . 'users'. DS . $this->user['username']. DS . 'profile_pic';

                        //CREATE IMAGE PATH
                        $imagePath = UploadFile::move($tmpFile, $folder, $optimideTo, $filename, 'profile_pic')->optimisedPath();


                    }
//

                    if ($validate->hasError() || count($fileError)){

                        $response = $validate->getErrorMessages();
                        count($fileError)? $errors = array_merge($response, $fileError) : $errors = $response;

                        if (count($errors)){
                            $user = $this->user;
                            return view('admin/user/editUser', ['user'=>$user, 'errors'=>$errors]);
                        }

                    };
//                    pnd($requests->fullname);

//                  $update_user = true;
                    $update_user = User::where([['username', $this->user['username']], ['id', $id]])
                        ->update(
                            [
                                'fullname' => $requests->fullname,
                                'region' => $requests->region,
                                'address' => $requests->address,
                                'phone' => $requests->phone,
                                'city' => $requests->city,
                                'role' => $requests->role,
                                'gps' => $requests->gps,
                                'image_path' => $imagePath
                            ]
                        );

                    if ($update_user){
                        Session::flash('success', 'Details updated successfully!');
                        if ($requests->role === 'user'){
                            Redirect::to('/profile/'.user()->username.'/users/'.$id.'/edit_user');
                        }else{
                            Redirect::to('/profile/'.user()->username.'/workers/'.$id.'/edit_worker');
                        }

                    }else{
                        Session::flash('error', 'Failed to update details please try again!');
                        if ($requests->role === 'user'){
                            Redirect::to('/profile/'.user()->username.'/users/'.$id.'/edit_user');
                        }else{
                            Redirect::to('/profile/'.user()->username.'/workers/'.$id.'/edit_worker');
                        }
                    }
                }

            }

        }

    }

    public static function  getUser($id){
        $obj = new UserController;
        $obj->user = User::where('id', $id)->first();
        return $obj->user;
    }

    //TODO: make sure only admin can delete things
    public function deleteUser($params){
        $id = $params['id'];
        if (Request::exist('post')){
            $request = Request::get('post');

            if (CSRFToken::checkToken($request->token, false)){
                //TODO: check whether session id is admin's id before deleting

                //GET USER ROLE AND DELETE USER
                if((int)$id){
                    $userRole = User::where(['id'=> $id, 'role' => 'user'])->first();

                    if ($userRole->role === 'user'){
                        User::where('id', $id)->delete();

                        Session::flash('success', 'User Deleted Successfully');

                        Redirect::to('/profile/'.$userRole->username.'/users');
                    }else{
                        User::where('id', $id)->delete();

                        Session::flash('success', 'User Deleted Successfully');

                        Redirect::to('/profile/'.$userRole->username.'/workers');
                    }

                }


            }else{
                if (getenv('APP_ENV') !== 'production'){
                    die('Malicious Activity detected');
                }
            }

        }

    }


    public function editWorker($params){
        $id = $params['id'];
        $worker = UserController::getUser($id);

        if ($worker->role === 'worker'){
            return view('admin/user/editWorker', compact('worker'));
        }

    }


    public function userProfile($user){

        if ($user){
            $username = User::where('username', $user)->first();
            if ($username->role === 'admin'){
                $orders = Order::all()->count();
                $products = Product::all()->count();
                $users = User::where('role', 'user')->count();
                $payments = Payment::all()->sum('amount');

                return view('admin/dashboard', compact('orders', 'products', 'users', 'payments'));
            }elseif ($username->role === 'worker'){
                //TODO: get worker dashboard profile
                return true;
            }else{
                //TODO: get user dashboard profile
                return true;
            }
        }

        pnd($user);
    }




}

