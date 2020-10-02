<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 5/10/2020
 * Time: 10:03 AM
 */

namespace App\Controller\Admin;


use App\Classes\CSRFToken;
use App\Classes\Request;
use App\Classes\ValidateRequest;
use App\Controller\BaseController;
use App\Models\Product;
use App\Classes\UploadFile;
use App\Classes\Redirect;
use App\Classes\Session;
use App\classes\Role;

class ProductController extends BaseController
{

    public $tableName = 'products';
    private $products;

    public function __construct()
    {
        if (!Role::middleware('admin')){
            Redirect::to('/');
        };
    }

    public function index(){

        $products = Product::all();
//        pnd($products); exit;

        return view('admin/product/index', compact('products'));
    }


    public function showCreateForm(){
        $this->products = Product::all();
        return view('admin/product/create', ['products'=>$this->products]);
    }


    public function create(){

        if (Request::exist('post')){
            $requests = Request::get('post');
            $fileError = [];




            if (CSRFToken::checkToken($requests->token, false)){

                //SET RULES
                $policyRules = [
                    'product_name' => ['required'=>true, 'string'=>true, 'minLength'=>3, 'unique'=>$this->tableName ],
                    'price' => ['required'=>true, 'minLength'=>2, 'number'=>true],
//                    'quantity'=>['required'=>true],
//                    'category'=>['required'=>true],
//                    'subcategory'=>['required'=>true],
                    'description'=>['required'=>true, 'mixed'=>true, 'minLength'=>4, 'maxLength'=>500]
                ];

                //VALIDATE INPUTS
                $validator = new ValidateRequest;
                $validator->abide($_POST, $policyRules);

                //Validate file
                $file = Request::get('file');

                isset($file->productImage->name)? $filename = $file->productImage->name : $filename = '';


                if(empty($filename)){
                    $fileError['productImage'] = ['The product image is required'];
                }elseif (!UploadFile::isImage($filename)){
                    $fileError['image'] = ['Make sure the file is an Image'];
                }elseif ($file->productImage->tmp_name === ''){
                    $fileError['image'] = ['Please select the file again'];
                }elseif (UploadFile::fileSize($file->productImage->size)){
                    $fileError['image'] = ['Please select an image < 500kb'];
                }


                //CHECK IF VALIDATION HAS ERRORS
                if($validator->hasError() || count($fileError)){
                    $response = $validator->getErrorMessages();
                    count($fileError)? $errors = array_merge($response, $fileError) : $errors= $response;

                    if (count($errors)){
                        return view('admin/product/create', [
                            'errors' => $errors,
                            'products' => $this->products
                        ]);
                    }

                }

                (user())? $username = user()->username : $username = 'default'.random_int(1,1000000);


                $tmpFile = $file->productImage->tmp_name;
                $optimideTo = "images" .DS. 'optimiseImages'. DS . "products". DS . $username;
                $folder = "images" .DS. "uploads" .DS. "products". DS . $username;

                //CREATE IMAGE PATH
                $imagePath = UploadFile::move($tmpFile, $folder, $optimideTo, $filename)->optimisedPath();



                Product::create(
                    [
                        'user_id' => 1,
                        'product_name'  => ucwords($requests->product_name),
                        'price'  => $requests->price,
                        'description' => $requests->description,
                        'image_path' => $imagePath
                    ]

                );

                //REFRESH FORM DATA
                Request::refresh();


                $success = 'New Massage Product Added';

                return view('admin/product/create', [
                    'success' => $success,

                ]);


            }else {
                $env = getenv('APP_ENV');
                if ($env === 'local') {
                    throw new \Exception('Token Mismatch');
                }
                die('Token Mismatch');
            }


        }

        return view('admin/product/create');
    }


    public function editProduct($params){
        $id = $params['id'];

        $product = Product::findOrFail($id);


        return view('admin/product/editProduct', ['product'=>$product]);
    }


    public function updateProduct($params){
        $id = $params['id'];
        if (Request::exist('post')){
            $requests = Request::get('post');
            $fileError = [];

            if (CSRFToken::checkToken($requests->token, false)){
                $this->products = Product::find($id);
                if ((int)$id && $this->products){

                    $rules = [

                        'product_name' => ['required'=>true, 'string'=>true, 'minLength'=>3 ],
                        'price' => ['required'=>true, 'minLength'=>2, 'number'=>true],
                        'description'=>['required'=>true, 'mixed'=>true, 'minLength'=>4, 'maxLength'=>2000]

                    ];

                    $validate = new ValidateRequest;
                    $validate->abide($_POST, $rules);

                    //VALIDATE UPLOADED FILE
                    $file = Request::get('file');
                    $imagePath = '';

                    //UPDATE PROFILE IMAGE IF AN IMAGE HAS BEEN PROVIDED
                    isset($file->productImage->name)? $filename = $file->productImage->name : $filename = '';

                    if($filename !== '') {
                        if (empty($filename)) {
                            $fileError['productImage'] = 'The user image is required';
                        } elseif (!UploadFile::isImage($filename)) {
                            $fileError['productImage'] = 'Please make sure the file is an image';
                        }elseif (UploadFile::fileSize($file->productImage->size)){
                            $fileError['productImage'] = ['Please select an image < 1mb'];
                        }

                    }

                    //CHECK IF VALIDATION HAS ERRORS
                    if($validate->hasError() || count($fileError)){
                        $response = $validate->getErrorMessages();
                        count($fileError)? $errors = array_merge($response, $fileError) : $errors= $response;

                        if (count($errors)){
                            return view('admin/product/editProduct', [
                                'errors' => $errors,
                                'product' => $this->products
                            ]);
                        }

                    }

                    (user())? $username = user()->username : $username = 'default'.random_int(1,1000000);

                    if ($file->productImage->name){

                        $tmpFile = $file->productImage->tmp_name;
                        $optimideTo = "images" .DS. 'optimiseImages'. DS . "products". DS . $username;
                        $folder = "images" .DS. "uploads" .DS. "products". DS . $username;

                        //CREATE IMAGE PATH
                        $imagePath = UploadFile::move($tmpFile, $folder, $optimideTo, $filename)->optimisedPath();

                    }else{
                        $prod = Product::find($id);
                        $imagePath = $prod->image_path;
                    }

//                    $update_user = true;
                 $update_product = Product::where('id', $id)
                        ->update(
                            [
                                'product_name' => $requests->product_name,
                                'price' => $requests->price,
                                'description' => $requests->description,
//                                'phone' => $requests->phone,
//                                'city' => $requests->city,
                                'image_path' => $imagePath
                            ]
                        );

                    if ($update_product){
                        Session::flash('success', 'Product updated successfully');
                        Redirect::to('/profile/'.user()->username.'/products');
                    }else{
                        Session::flash('error', 'Product failed to be updated');
                        Redirect::to('/profile/'.user()->username.'/products/'.$id.'/edit_product');
                    }
                }

            }

        }
    }


    public function deleteProduct($params){
        $id = $params['id'];
        if (Request::exist('post')){
            $request = Request::get('post');

            if (CSRFToken::checkToken($request->token, false)){
                //TODO: check whether session id is admin's id before deleting

                //GET USER ROLE AND DELETE USER
                if((int)$id){
                    Product::where('id', $id)->delete();

                    Session::flash('success', 'Product Deleted Successfully');
                    Redirect::to('/profile/'.user()->username.'/products');
                }


            }else{
                if (getenv('APP_ENV') !== 'production'){
                    die('Malicious Activity detected');
                }
            }

        }
    }





}



















