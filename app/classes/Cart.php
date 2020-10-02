<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 6/4/2020
 * Time: 4:44 PM
 */

namespace App\classes;


class Cart
{

    protected static $_isItemInCart = false; public static $counter=0; public static $userId;

    public static function add($request){
        //TRY TO GET CART ITEMS
        $order_number = generateOrderNumber();
        $refNo = generateReferenceNo();



            try{


                //CHECK IF SESSION EXIST FOR CART OR THE COUNT OF CART ITEMS OTHERWISE ADD NEW CART SESSION
                if(!Session::exist('user_cart') || count(Session::get('user_cart')) < 1){
                    Session::set('user_cart', [
                        //MULTI ARRAY OF SESSION VALUE
                        0 => [
                            //CART KEY          CART VALUE
                            'product_id' => $request->massageId,
                            'hours'   => $request->massageHours,
                            'session'   => $request->massageTime,
                            'date'   => $request->datePicker,
                            'order_number' => $order_number,
                            'place' => $request->place,
                            'place_name' => $request->place_name,
                            'ref_no' => $refNo
                        ]
                    ]);
                }else{
                    $index = 0;
                    foreach ($_SESSION['user_cart'] as $cartItem) {
                        $valueAry = [];
                        $index++; //INCREASE THE INDEX VALUE

                        //CHECK IF CART KEY AND CART VALUE ARE WHAT IS BEING LOOPED THROUGH
                        foreach ($cartItem as $key => $value) {
                            $valueAry[] = $value;

                            if(in_array($request->massageId, $valueAry)) {

                                if ( in_array($request->massageTime, $valueAry)){

                                    if (in_array($request->datePicker, $valueAry)){

                                        if (in_array($order_number, $valueAry)){

                                            if ($cartItem['hours'] < 3){
                                                array_splice($_SESSION['user_cart'], $index - 1, 1, [
                                                    [
                                                        'product_id' => $request->massageId,
                                                        'hours'   => $cartItem['hours'] + 1,
                                                        'session'   => $request->massageTime,
                                                        'date'   => $request->datePicker,
                                                        'order_number' => $order_number,
                                                        'place' => $request->place,
                                                        'place_name' => $request->place_name,
                                                        'ref_no' => $refNo
                                                    ]
                                                ]);

                                                self::$_isItemInCart = true;
                                            }
                                            self::$_isItemInCart = true;
                                        }


                                    }

                                }



                            }
                        }

                    }

                    //CHECK IF ITEM IS NOT ALREADY ADDED TO THE CART
                    if(!self::$_isItemInCart){
                        array_push($_SESSION['user_cart'], [
                            'product_id' => $request->massageId,
                            'hours'   => $request->massageHours,
                            'session'   => $request->massageTime,
                            'date'   => $request->datePicker,
                            'order_number' => $order_number,
                            'place' => $request->place,
                            'place_name' => $request->place_name,
                            'ref_no' => $refNo
                        ]);
                    }
                }



            }catch (\Exception $e){
                $env = getenv('APP_ENV');
                if($env === 'local'){
                    echo 'Message: '. $e->getMessage();
                }else{
                    echo 'Error in Adding to the cart';
                }


            }

        }




    public static function removeItem($index){
        if (count(Session::get('user_cart')) <= 1){
            //CLEAR SESSION
            self::clear();

        }else{
            unset($_SESSION['user_cart'][$index]);
            sort($_SESSION['user_cart']);
        }

    }


    public static function clear(){
        Session::delete('user_cart');
    }







}