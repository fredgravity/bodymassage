<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 5/9/2020
 * Time: 4:17 PM
 */


$router = new AltoRouter;

//$router->map('GET', '/about', '','about_us');
$router->map('GET', '/', 'App\Controller\IndexController@showIndex','home');
$router->map('GET', '/contact_us', 'App\Controller\IndexController@contactUs','contact_us');
$router->map('POST', '/contact_us', 'App\Controller\IndexController@contactUsSend','contact_us_send');
$router->map('GET', '/massages', 'App\Controller\IndexController@massages','massages');
$router->map('GET', '/massages/[i:id]/description', 'App\Controller\IndexController@massageDescription','massage_description');
$router->map('GET', '/bookings', 'App\Controller\IndexController@bookings','bookings');
$router->map('GET', '/about_us', 'App\Controller\IndexController@aboutUs','about_us');
$router->map('GET', '/corporate', 'App\Controller\IndexController@corporate','corporate');
$router->map('GET', '/terms_and_condition', 'App\Controller\IndexController@termsAndCondition','terms_and_condition');
$router->map('GET', '/privacy', 'App\Controller\IndexController@privacy','privacy');

$router->map('POST', '/corporate/quote', 'App\Controller\IndexController@requestQuote','request_quote');





$router->map('GET', '/bookings/massage/[i:id]', 'App\Controller\IndexController@getMassageImage','massage_image');
$router->map('POST', '/bookings/massage/checkout', 'App\Controller\IndexController@massageCheckout','massage_checkout');
$router->map('POST', '/bookings/massage/checkout/maxedOut', 'App\Controller\IndexController@maxedOut','maxedOut');

//recaptcha
$router->map('POST', '/recaptcha', 'App\Controller\RecaptchaController@recapture','recaptcha');

//search
$router->map('POST', '/search/[a:table]', 'App\Controller\SearchController@search','search');



//Cart
$router->map('GET', '/bookings/cart', 'App\Controller\CartController@showCart','show_cart');
$router->map('POST', '/bookings/cart/[i:id]/remove_item', 'App\Controller\CartController@removeItem','remove_cart_item');
$router->map('GET', '/checkout/success', 'App\Controller\CartController@checkoutSuccess','checkout_success');
$router->map('GET', '/notify/[*:all]', 'App\Controller\CartController@notify','checkout_notify');



//flutter wave
$router->map('POST', '/checkout/save_payment', 'App\Controller\CartController@saveBookingToOrder','save_booking_to_order');
$router->map('POST', '/checkout/verify_payment', 'App\Controller\CartController@verifyFlutterWavePayment','verify_flutterwave_payment');
$router->map('POST', '/checkout/card_payment', 'App\Controller\CartController@flutterWaveCardPayment','flutterwave_card_payment');
$router->map('GET', '/checkout/card_payment/response/[*:all]', 'App\Controller\CartController@flutterWaveCardPaymentResponse','flutterwave_card_payment_response');


//paystack
$router->map('POST', '/bookings/cart/callback', 'App\Controller\CartController@callBack','callback');
$router->map('POST', '/cart/get_session_info', 'App\Controller\CartController@getSessionInfo','get_session_info');


//tingg payment
$router->map('POST', '/bookings/cart/payload', 'App\Controller\CartController@tinggPayload','tingg_payload');
$router->map('GET', '/bookings/cart/payload/success', 'App\Controller\CartController@tinggPayloadSuccess','tingg_payload_success');
$router->map('GET', '/bookings/cart/payload/failed', 'App\Controller\CartController@tinggPayloadFailed','tingg_payload_failed');


//for admin
$router->map('GET', '/admin/[a:user]', 'App\Controller\Admin\DashboardController@index','admin_dashboard');

$router->map('GET', '/profile/[a:user]/products', 'App\Controller\Admin\ProductController@index','products');
$router->map('GET', '/profile/[a:user]/products/create', 'App\Controller\Admin\ProductController@showCreateForm','show_create_products_form');
$router->map('POST', '/profile/[a:user]/products/create', 'App\Controller\Admin\ProductController@create','create_products');
$router->map('GET', '/profile/[a:user]/products/[i:id]/edit_product', 'App\Controller\Admin\ProductController@editProduct','edit_product_form');
$router->map('POST', '/profile/[a:user]/products/[i:id]/update_product', 'App\Controller\Admin\ProductController@updateProduct','update_product');
$router->map('POST', '/profile/[a:user]/products/[i:id]/delete_product', 'App\Controller\Admin\ProductController@deleteProduct','delete_product');


//admin user
$router->map('GET', '/profile/[a:user]/users', 'App\Controller\Admin\UserController@showIndex','show_users');
$router->map('GET', '/profile/[a:user]/users/register', 'App\Controller\AuthController@registerForm','show_users_create_form');
$router->map('GET', '/profile/[a:user]/users/[i:id]/edit_user', 'App\Controller\Admin\UserController@editUser','edit_user_form');
$router->map('POST', '/profile/[a:user]/users/[i:id]/update_user', 'App\Controller\Admin\UserController@updateUser','update_user');
$router->map('POST', '/profile/[a:user]/users/[i:id]/delete_user', 'App\Controller\Admin\UserController@deleteUser','delete_user');
$router->map('GET', '/profile/[a:user]/users/register', 'App\Controller\AuthController@registerForm','admin_user_register');


//ADMIN PAGINATOR
$router->map('GET', '/profile/[a:user]/users/[i:id]', 'App\Controller\Admin\UserController@showIndexNext','show_users_next');
$router->map('GET', '/profile/[a:user]/workers/[i:id]', 'App\Controller\Admin\UserController@showIndexNext','show_workers_next');

$router->map('GET', '/profile/[a:user]/payments/[i:id]', 'App\Controller\Admin\PaymentController@showIndexNext','show_payments_next');

$router->map('GET', '/profile/[a:user]/orders/[i:id]', 'App\Controller\Admin\OrderController@showIndexNext','show_orders_next');




//admin charts
$router->map('GET', '/admin/dashboard_charts', 'App\Controller\Admin\DashboardController@getChartData','dashboard_charts');
$router->map('GET', '/admin/payment_graph', 'App\Controller\Admin\PaymentController@payment_graph','payment_graph');




//for worker
$router->map('GET', '/profile/[a:user]/workers', 'App\Controller\Admin\UserController@showWorkers','show_workers');
$router->map('GET', '/profile/[a:user]/users/[i:id]/edit_worker', 'App\Controller\Admin\UserController@editWorker','edit_worker_form');


//for order
$router->map('GET', '/profile/[a:user]/orders', 'App\Controller\Admin\OrderController@showOrders','show_orders');
$router->map('GET', '/profile/[a:user]/orders/[i:id]/order_details', 'App\Controller\Admin\OrderController@showOrderDetails','show_orders_details');
$router->map('POST', '/profile/[a:user]/orders/[i:id]/delete_order', 'App\Controller\Admin\OrderController@orderDelete','delete_order');


//for payments
$router->map('GET', '/profile/[a:user]/payments', 'App\Controller\Admin\PaymentController@showPayments','show_payments');
$router->map('GET', '/profile/[a:user]/payments/[i:id]/payment_details', 'App\Controller\Admin\PaymentController@paymentDetails','show_payments_details');
$router->map('GET', '/profile/[a:user]/payments/graph', 'App\Controller\Admin\PaymentController@showGraph','show_graph');



//Authentication
$router->map('GET', '/login', 'App\Controller\AuthController@showLoginForm','login_users_form');
$router->map('POST', '/login', 'App\Controller\AuthController@login','login_users');
$router->map('GET', '/reset_password', 'App\Controller\AuthController@resetPasswordForm','show_reset_password');
$router->map('POST', '/reset_password', 'App\Controller\AuthController@resetPassword','reset_password');
$router->map('GET', '/register', 'App\Controller\AuthController@showRegisterForm','register_users_form');
$router->map('POST', '/register', 'App\Controller\AuthController@register','register_users');
$router->map('GET', '/logout', 'App\Controller\AuthController@logout','logout_users');


//Profile
$router->map('GET', '/profile/[a:user]', 'App\Controller\UserController@userDashboard','profile_dashboard');
$router->map('GET', '/profile/[a:user]/profile', 'App\Controller\UserController@userProfile','user_profile');
$router->map('POST', '/profile/[a:user]/profile', 'App\Controller\UserController@userProfileUpdate','user_profile_update');
$router->map('GET', '/user/charts', 'App\Controller\UserController@getChartData','profile_dashboard_charts');
$router->map('GET', '/profile/[a:user]/change_password', 'App\Controller\UserController@changePasswordForm','change_password_form');
$router->map('POST', '/profile/[a:user]/[i:id]/change_password', 'App\Controller\UserController@changePassword','change_password');
$router->map('GET', '/profile/[a:user]/my_orders', 'App\Controller\OrderController@showOrders','show_my_orders');
$router->map('GET', '/profile/[a:user]/my_payments', 'App\Controller\PaymentController@paymentDetails','show_my_payments');










