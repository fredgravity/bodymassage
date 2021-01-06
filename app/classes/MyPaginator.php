<?php
/**
 * Created by PhpStorm.
 * User: gravity
 * Date: 11/2/2020
 * Time: 7:43 AM
 */

namespace App\classes;

use Illuminate\Database\Capsule\Manager as Capsule;

class MyPaginator
{

    private $offset=0, $offsetNext=0, $recordNum,  $tableName, $getNext, $role, $next, $nextLink, $prevLink, $lastLink, $firstLink, $baseUrl;
    public $selectResults, $selectResultsNext, $resultData, $baseRequestUrl, $lastUrlNum, $num ;

    public function __construct($recordNum, $tableName, $role, $next)
    {
//        pnd('hi');
        $this->recordNum = $recordNum;
        $this->tableName = $tableName;
        $this->role = $role;
        $this->next = $next;
        $this->baseUrl = $_SERVER['REQUEST_URI'];
        $this->getBaseUrl();
        $this->getUrlPageNo();
        $this->getPageNo();
        $this->getNextPage();
        $this->resultData = Capsule::select($this->getResultQueryString());
//        if (isset($_GET['p'])){
        $this->getNext = Capsule::select($this->getResultQueryStringNext());
//        pnd($this->getNext);
//        }

    }


    public function getUrlPageNo(){
//        pnd($this->next);
        return ($this->next);
    }


    private function getPageNo(){
        $url_number = (int)$this->getUrlPageNo();
//        pnd($url_number);

        if (isset($_GET['p']) && is_numeric($_GET['p'])){
            $page_value = $_GET['p'];
            if ($page_value > 1){

                $this->offset = ($page_value - 1)*$this->recordNum;
            }
//            $this->offsetNext = ($page_value)*$this->recordNum;
        }else{
            $page_value = $url_number;

            if ($page_value > 1){
                $this->offset = ($page_value-1) * $this->recordNum;
            }else{
                $this->offset = ($page_value) * $this->recordNum;
            }

//            pnd($this->offset);
        }

        if ($this->role){
//            pnd($this->role);
            $this->selectResults =  "select * from {$this->tableName} WHERE role = '{$this->role}' AND deleted_at is null  ORDER BY created_at DESC limit {$this->offset}, {$this->recordNum}";
        }else{
            $this->selectResults = "select * from {$this->tableName} WHERE deleted_at is null ORDER BY created_at DESC limit {$this->offset}, {$this->recordNum}";
        }

//        pnd($this->selectResults);
    }


    private function getNextPage(){
        $url_number = (int)$this->getUrlPageNo();
        if(isset($_GET['p']) && is_numeric($_GET['p'])){
            $page_value = $_GET['p'];
            $this->offsetNext = $page_value * $this->recordNum;

        }else{
//            pnd($url_number);
            if ($url_number != 0){
                $page_value = $url_number;
                $this->offsetNext =  $page_value * $this->recordNum;
            }else{

                $this->offsetNext = $this->recordNum;
            }

        }

        if ($this->role){
            $this->selectResultsNext = "select * from {$this->tableName} WHERE role = '{$this->role}' and deleted_at is null ORDER BY created_at DESC limit {$this->offsetNext}, {$this->recordNum}";
        }else{
            $this->selectResultsNext = "select * from {$this->tableName} WHERE deleted_at is null ORDER BY created_at DESC limit {$this->offsetNext}, {$this->recordNum}";
        }
//        pnd($this->selectResultsNext);
    }


    public function getResultQueryString(){
//        pnd($this->selectResults);
        return $this->selectResults;
    }

    public function getResultQueryStringNext(){
        return $this->selectResultsNext;
    }

    public function getResultLinks($totalRecord){

        if ($this->resultData){
            $links = [];
            $links2 = [];

            $result = $this->resultData;
            $this->num = $totalRecord / $this->recordNum;


            $next = $this->getNext;

            if ($this->getLastUrl($this->num)){

                if ($this->firstLink != '' && $this->prevLink != ''){
                    //FIRST PAGE

                    $links2['first'] = $this->firstLink;


                    //PREVIOUS PAGE
                    $links2['prev'] = $this->prevLink;
                }

                //CURRENT PAGE
                $links['current'] = 1;
                $links2['current'] = (int)$this->getUrlPageNo();


                //NEXT PAGE
                if ($next){

                    $links['next'] = "<a href=".$_SERVER['REDIRECT_URL']."?p=".(2)."> Next > </a>";
                    $links2['next'] = $this->nextLink;

                    if (ceil($this->num) != $this->lastUrlNum ){
                        //LAST PAGE
                        $links2['last'] =  $this->lastLink;
                    }

                }

            }else{

                if (isset($_GET['p'])){
                    $links['current'] = $_GET['p'];
                }else{
                    $links['current'] = 1;
                    $links2['current'] = (int)$this->getUrlPageNo();
                }

            }
//pnd($links2);
            return $links2;
        }

//        pnd($this->baseRequestUrl);

        Redirect::to($this->baseRequestUrl);
    }

    public function getBaseUrl(){

        $urlString = $this->baseUrl;
        $explodeUrl = explode('/', $urlString);
        $countUrl = count($explodeUrl);
        $lastUrl = $explodeUrl[$countUrl-1];

        if (is_numeric($lastUrl)){

            $urlWithoutLastNum = str_replace($lastUrl,'', $urlString);
            $urlWithoutLastNumTrimed = rtrim($urlWithoutLastNum, '/');
            $this->baseRequestUrl = $urlWithoutLastNumTrimed;
            return $urlWithoutLastNumTrimed;
        }
        return false;
    }

    public function getLastUrl($num){
        $url = $this->baseUrl;

        if (strpos($url,'?')){
            $url = rtrim($url, '?');
        }

        $explodeUrl = explode('/', $url);
        $countUrl = count($explodeUrl);
        $lastUrl = $explodeUrl[$countUrl-1];

        if (strpos($lastUrl,'?')){
            $lastUrl = rtrim($lastUrl, '?');
            $this->lastUrlNum = $lastUrl;
        }else{

            $this->lastUrlNum = (int) $lastUrl;
        }

        $this->getAllLinks($lastUrl, $url, $num);
        return true;

    }


    public function getAllLinks($lastUrl, $url, $num){
        $newRequestUrl = str_replace($lastUrl,'',$url);


        if (is_numeric($lastUrl)){
            $this->baseRequestUrl = $newRequestUrl;

            $newNextUrl = (int)$lastUrl + 1;
            $newPrevUrl = (int)$lastUrl - 1;
            $newLastUrl = ceil($num);
            $newFirstUrl = $newRequestUrl;

            $this->nextLink = $newRequestUrl.$newNextUrl;
            $this->prevLink = ($newPrevUrl == 1)?  rtrim($newRequestUrl,"/"):  $newRequestUrl.$newPrevUrl;
            $this->lastLink = $newRequestUrl.$newLastUrl;
            $this->firstLink = rtrim($newFirstUrl,"/");
//            pnd($this->prevLink);
            return true;
        }

        $this->baseRequestUrl = $url.'/';
        $this->nextLink = $this->baseRequestUrl.'2';
        $this->lastLink = $this->baseRequestUrl. ceil($num);
        return true;
    }


    public function getResultData(){
        return $this->resultData;
    }




















}