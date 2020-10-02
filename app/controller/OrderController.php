<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 5/17/2020
 * Time: 10:29 AM
 */

namespace App\Controller;


use App\Controller\BaseController;
use App\Models\Order;
use App\Models\OrderDetail;
use App\models\User;
use App\Classes\Request;
use App\Classes\CSRFToken;
use App\Classes\Redirect;
use App\Classes\Session;

class OrderController extends BaseController
{

    public $tableName = 'orders', $orders, $users,  $orderLinks, $search;
    private $_data, $_tmpFile;

    public function __construct()
    {

        if (!isAuthenticated()){
            Redirect::to('/');
        }

        $this->orders = Order::where('user_id', \user()->id)->with(['user', 'orderDetail', 'product'])->get();
//        pnd($this->orders);
//        $total = count($this->orders);
//        list($this->orders, $this->orderLinks) = paginate(1, $total, $this->tableName, new Order);

    }


    public function showOrders(){
        $orders = $this->orders;
        $errors = '';
        return view('user/orderDetails', compact('orders', 'errors'));
    }


//    public function showOrderDetails($params){
//        $id = $params['id'];
//        $orderDetails = Order::where('id', $id)->with(['user', 'orderDetail', 'product'])->get();
////        pnd($orderDetails);
//        return view('admin/order/indexDetails', compact('orderDetails'));
//    }


    public function orderDelete($params){
        $id =$params['id'];
        if (Request::exist('post')){
            $request = Request::get('post');

            if (CSRFToken::checkToken($request->token, false)){
                //TODO: check whether session id is admin's id before deleting

                //GET USER ROLE AND DELETE USER
                if((int)$id){
                    if (Order::where('id', $id)->delete()){
                        OrderDetail::where('order_id', $id)->delete();
                    }

                    Session::flash('success', 'Order Deleted Successfully');
                    Redirect::to('/profile/'.user()->username.'/orders');
                }


            }else{
                if (getenv('APP_ENV') !== 'production'){
                    die('Malicious Activity detected');
                }
            }

        }
    }

}




