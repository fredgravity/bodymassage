<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 5/19/2020
 * Time: 4:06 PM
 */

namespace App\controller\admin;

use App\Models\Payment;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Classes\Request;
use App\classes\Role;
use App\Classes\Redirect;

class PaymentController
{

    private $payments, $paymentsLink,$total, $tableName='payments', $recordNum=5;

    public function __construct()
    {

        if (!Role::middleware('admin')){
            Redirect::to('/');
        };

        $this->payments = Payment::with('user')->get();

        $this->total = count($this->payments);
    }


    public function showPayments(){
        list($this->payments, $this->paymentsLink) = myPaginator($this->recordNum, $this->total, $this->tableName,new Payment());
        $revenues = Capsule::table('payments')->selectRaw('sum(amount) as `amount`')->where('status','completed')->get();
        $revenue = $revenues[0]->amount;
        $payments = $this->payments;
        $links = $this->paymentsLink;

        return view('/admin/payment/index', compact('revenue', 'payments', 'links'));
    }


    public function showIndexNext($params){
//        pnd($params);
        $urlString = $_SERVER['REQUEST_URI'];
        $pageId = $params['id'];
        $role = '';
        if (strpos($urlString, 'users')){
            $role = 'user';
        }elseif (strpos($urlString, 'workers')){
            $role = 'worker';
        }
//pnd($role);
        $this->nextPageUsers($role, $pageId);

    }


    public function nextPageUsers($role, $pageId){
        list($this->payments, $this->paymentsLink)= myPaginatorNext($this->recordNum, $this->total, $this->tableName, new Payment(), $role, $pageId);
        $revenues = Capsule::table('payments')->selectRaw('sum(amount) as `amount`')->where('status','completed')->get();
        $revenue = $revenues[0]->amount;
        $payments = $this->payments;
        $links = $this->paymentsLink;

        return view('/admin/payment/index', compact('revenue', 'payments', 'links'));
    }


    public function showGraph(){

        return view('admin/payment/graph');
    }

    public function paymentDetails($params){
        $id = $params['id'];
//        $payments = Payment::find($id)->with('user')->get();
        $payments = Payment::with('user')->find($id);
//pnd($payments);
        return view('admin/payment/paymentDetails', compact('payments'));
    }

    public function paymentConverter(){
        if (Request::exist('post')){
            $request = Request::get('post');
            $convert = $request->convert;
            $result = '';
            $amount = '';

            $payments = Capsule::table('payments')->select(
                Capsule::raw('sum(amount) as `amount`'))->get();
            foreach ($payments as $payment) {
                $amount = $payment->amount;
            }


            switch ($convert){
                case 'USD':
                    $result = '$ ' . number_format($amount * getenv('USD_RATE'), 2);
                    break;

                case 'GBP':
                    $result = '€ ' . number_format( $amount * getenv('GBP_RATE'), 2);
                    break;

                case 'EUR':
                    $result = '£ ' . number_format( $amount * getenv('EUR_RATE'), 2);
                    break;

                case 'ZAR':
                    $result = 'R ' . number_format( $amount * getenv('ZAR_RATE'), 2);
                    break;

                default:
                    //DO NOTHING
            }

//           pnd($result);
            echo json_encode(['rate' => $result]);
        }
    }


    public function payment_graph(){

        $revenue = Capsule::table('payments')->select(
            Capsule::raw('sum(amount) as `amount` '),
            Capsule::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),
            Capsule::raw('YEAR(created_at) year, Month(created_at) month')
        )->groupby('year', 'month')->get();

        echo json_encode(
            [
                'revenues' => $revenue
            ]
        );
    }


}