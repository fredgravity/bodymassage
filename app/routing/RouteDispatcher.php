<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 5/9/2020
 * Time: 4:44 PM
 */

namespace App\routing;

use AltoRouter;
class RouteDispatcher
{

     protected $match;
     protected $controller;
     protected $method;


     public function __construct(AltoRouter $router)
     {

         $this->match = $router->match();

         if($this->match){

            list($controller, $method) = explode('@', $this->match['target']);
            $this->controller = $controller;
            $this->method = $method;

            if (is_callable([new $this->controller, $this->method])){
                call_user_func_array([new $this->controller, $this->method], [$this->match['params']]);


            }else{
                echo "The method {$this->method} is not defined in the {$this->controller}";
            }


         }else{
             header($_SERVER['SERVER_PROTOCOL'].'404 NOT FOUND');
             view('errors/404');
         }


     }


}





