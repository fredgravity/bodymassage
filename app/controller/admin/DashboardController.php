<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 5/9/2020
 * Time: 8:30 PM
 */

namespace App\Controller\Admin;


use App\classes\Role;
use App\Controller\BaseController;
use Illuminate\Support\Facades\Redirect;
use App\Models\Order;
use App\Models\Product;
use App\models\User;
use App\Models\Payment;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Models\OrderDetail;

class DashboardController extends BaseController
{

    public function __construct()
    {

        if (!Role::middleware('admin')){
            Redirect::to('/');
        };

    }


    public function index(){
        $orders = Order::all()->count();
        $products = Product::all()->count();
        $users = User::where('role', 'user')->count();
        $payments = Payment::all()->sum('amount');
        $order_details = OrderDetail::with(['product'])->orderBy('id', 'DESC')->limit(5)->get();

        return view('admin/dashboard', compact('orders', 'products', 'users', 'payments', 'order_details'));

//        return view('admin/dashboard');
    }


    public function getChartData(){

        $revenue = Capsule::table('payments')->select(
            Capsule::raw('sum(amount) as `amount` '),
            Capsule::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),
            Capsule::raw('YEAR(created_at) year, Month(created_at) month'),
            Capsule::raw("DATE_FORMAT(created_at, '%M') month_name")
        )->groupby('year', 'month')->get();

        $orders = Capsule::table('orders')->select(
            Capsule::raw('count(id) as `count` '),
            Capsule::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),
            Capsule::raw('YEAR(created_at) year, Month(created_at) month'),
            Capsule::raw("DATE_FORMAT(created_at, '%M') month_name")
        )->groupby('year', 'month')->get();

        echo json_encode(
            [
                'revenues' => $revenue,
                'orders' => $orders
            ]
        );
    }


}










