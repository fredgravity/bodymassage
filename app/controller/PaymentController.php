<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 5/19/2020
 * Time: 4:06 PM
 */

namespace App\Controller;

use App\Models\Payment;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Classes\Request;
use App\Classes\Redirect;

class PaymentController
{

    private $payments, $paymentsLink, $tableName='payments', $amount;

    public function __construct()
    {



        if (!isAuthenticated()){
            Redirect::to('/');
        }
//        $this->payments = Payment::with('user')->get();
//
//        $total = count($this->payments);
//        list($this->payments, $this->paymentsLink) = paginatePayments(10, $total, $this->tableName, new Payment());
        $this->amount = Payment::where('user_id', user()->id)->sum('amount');

    }


//    public function showPayments(){
//        $revenues = Capsule::table('payments')->selectRaw('sum(amount) as `amount`')->where('status','completed')->get();
//        $revenue = $revenues[0]->amount;
//        $payments = $this->payments;
//        $links = $this->paymentsLink;
//
//        return view('/admin/payment/index', compact(['revenue', 'payments', 'links']));
//    }
//
//    public function showGraph(){
//
//        return view('admin/payment/graph');
//    }

    public function paymentDetails(){
        $id = user()->id;
        $amount = $this->amount;
        $payments = Payment::where('user_id', $id)->with('user')->get();
        $errors = '';

        return view('user/paymentDetails', compact('payments', 'errors', 'amount'));
    }

//    public function paymentConverter(){
//        if (Request::exist('post')){
//            $request = Request::get('post');
//            $convert = $request->convert;
//            $result = '';
//            $amount = '';
//
//            $payments = Capsule::table('payments')->select(
//                Capsule::raw('sum(amount) as `amount`'))->get();
//            foreach ($payments as $payment) {
//                $amount = $payment->amount;
//            }
//
//
//            switch ($convert){
//                case 'USD':
//                    $result = '$ ' . number_format($amount * getenv('USD_RATE'), 2);
//                    break;
//
//                case 'GBP':
//                    $result = '€ ' . number_format( $amount * getenv('GBP_RATE'), 2);
//                    break;
//
//                case 'EUR':
//                    $result = '£ ' . number_format( $amount * getenv('EUR_RATE'), 2);
//                    break;
//
//                case 'ZAR':
//                    $result = 'R ' . number_format( $amount * getenv('ZAR_RATE'), 2);
//                    break;
//
//                default:
//                    //DO NOTHING
//            }
//
////           pnd($result);
//            echo json_encode(['rate' => $result]);
//        }
//    }


//    public function paymentGraph(){
//        $revenue = Capsule::table('payments')->select(
//            Capsule::raw('sum(amount) as `amount` '),
//            Capsule::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),
//            Capsule::raw('YEAR(created_at) year, Month(created_at) month')
//        )->groupby('year', 'month')->get();
//
//        echo json_encode(
//            [
//                'revenues' => $revenue
//            ]
//        );
//    }


}