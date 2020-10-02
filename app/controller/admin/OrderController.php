<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 5/17/2020
 * Time: 10:29 AM
 */

namespace App\controller\admin;


use App\Controller\BaseController;
use App\Models\Order;
use App\Models\OrderDetail;
use App\models\User;
use App\Classes\Request;
use App\Classes\CSRFToken;
use App\Classes\Redirect;
use App\Classes\Session;
use App\classes\Role;

class OrderController extends BaseController
{

    public $tableName = 'orders', $orders, $users,  $orderLinks, $search;
    private $_data, $_tmpFile;

    public function __construct()
    {

        if (!Role::middleware('admin')){
            Redirect::to('/');
        };

        $this->orders = Order::all();
        $this->users = User::all();
//        pnd($this->orders);
        $total = count($this->orders);
        list($this->orders, $this->orderLinks) = paginate(5, $total, $this->tableName, new Order);

    }


    public function showOrders(){
        $orders = $this->orders;
        $links = $this->orderLinks;
        $users = $this->users;

        return view('admin/order/index', compact(['orders', 'links', 'users']));
    }


    public function showOrderDetails($params){
        $id = $params['id'];
        $orderDetails = Order::where('id', $id)->with(['user', 'orderDetail', 'product'])->get();
//        pnd($orderDetails);
        return view('admin/order/indexDetails', compact('orderDetails'));
    }


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




