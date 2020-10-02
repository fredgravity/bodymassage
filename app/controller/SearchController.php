<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 6/8/2020
 * Time: 11:07 AM
 */

namespace App\controller;


use App\Classes\CSRFToken;
use App\Classes\Request;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\models\User;
use Illuminate\Database\Capsule\Manager as Capsule;

class SearchController extends BaseController
{


    public function search($table){
        if (Request::exist('post')){
            $request = Request::get('post');

            if (CSRFToken::checkToken($request->token, false)){


                $search = $request->search;
                $table = ucfirst($table['table']);

//                pnd($table);

                if ($table === 'Order'){
                    $orders = Order::where('order_number', 'LIKE', "%$search%")->get();
                    $links = '';
                    return view('admin/order/index', compact('orders', 'links'));
//                    pnd($data);
                }elseif ($table === 'Product'){
                    $products = Product::where('product_name', 'LIKE', "%$search%")
                        ->orWhere(
                            'price', 'LIKE', "%$search%"
                        )
                        ->orWhere(
                            'description', 'LIKE', "%$search%")
                        ->get();

                    return view('admin/product/index', compact('products'));
                }elseif ($table === 'User'){
                    $role = 'user';
                    $links = '';
                    $users = User::where([
                        ['username', 'LIKE', "%$search%"], ['role', '=', $role]] )
                        ->orWhere([
                            ['fullname', 'LIKE', "%$search%"], ['role', '=', $role]
                        ])
                        ->orWhere([
                            ['email', 'LIKE', "%$search%"], ['role', '=', $role]
                        ] )
                        ->orWhere([
                            ['region', 'LIKE', "%$search%"], ['role', '=', $role]
                        ] )->orWhere([
                            ['city', 'LIKE', "%$search%"], ['role', '=', $role]
                        ] )->orWhere([
                            ['phone', 'LIKE', "%$search%"], ['role', '=', $role]
                        ] )->orWhere([
                            ['address', 'LIKE', "%$search%"], ['role', '=', $role]
                        ] )->orWhere([
                            ['gps', 'LIKE', "%$search%"], ['role', '=', $role]
                        ] )
                        ->get();

                    return view('admin/user/index', compact('users', 'links', 'role'));

                }elseif ($table === 'Worker'){

                    $role = 'worker';
                    $links = '';
                    $workers = User::where([
                        ['username', 'LIKE', "%$search%"], ['role', '=', $role]] )
                        ->orWhere([
                            ['fullname', 'LIKE', "%$search%"], ['role', '=', $role]
                        ])
                        ->orWhere([
                            ['email', 'LIKE', "%$search%"], ['role', '=', $role]
                        ] )
                        ->orWhere([
                            ['region', 'LIKE', "%$search%"], ['role', '=', $role]
                        ] )->orWhere([
                            ['city', 'LIKE', "%$search%"], ['role', '=', $role]
                        ] )->orWhere([
                            ['phone', 'LIKE', "%$search%"], ['role', '=', $role]
                        ] )->orWhere([
                            ['address', 'LIKE', "%$search%"], ['role', '=', $role]
                        ] )->orWhere([
                            ['gps', 'LIKE', "%$search%"], ['role', '=', $role]
                        ] )
                        ->get();

                    return view('admin/user/index', compact('workers', 'links', 'role'));

                }elseif ($table === 'Payment'){

                    $revenues = Capsule::table('payments')->selectRaw('sum(amount) as `amount`')->where('status', 'LIKE', "%$search%")->get();
                    $revenue = $revenues[0]->amount;
                    $links = '';
                    $payments = Payment::where('order_number', 'LIKE', "%$search%" )
                        ->orWhere('amount', 'LIKE', "%$search%")
                        ->orWhere('status', 'LIKE', "%$search%")
                        ->get();


                    return view('/admin/payment/index', compact('revenue', 'payments', 'links'));
                }



            }


        }
    }




}