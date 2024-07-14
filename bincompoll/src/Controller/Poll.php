<?php

namespace src\Controller;

use src\views\View;
use src\Models\Poll as PollModelHandler;

class Poll{

    public function __construct(){}
    public function index()
    {
        $path = "index";
        $polling_units = (new PollModelHandler())->getUnits();
        
        $view = View::render($path,["polling_units"=>$polling_units]);
        
        if(is_bool($view)){
            echo "could not load";
           return false;
        }else{
           echo $view;
        }   
    }

    public function getUnitResult()
    {
       
        $unit = $_POST["polling_unit"];
        $units = (new PollModelHandler())->getUnits();
        $results = [];
        $path = "index";
        if(strtolower($_SERVER["REQUEST_METHOD"]) == "post"){
           $results = (new PollModelHandler())->getResult($unit);
        }
       
        $view =  View::render($path,["polling_units"=>$units,"results"=>$results]);

        return $view;
        
    }

    public function getTotalPage()
    {
        $path = "getTotal";
        $allLGA = (new PollModelHandler())->getLGAs();
        $view =  View::render($path,["polling_units"=>$units,"results"=>$results]);
 
        if(is_bool($view)){
          
            return false;
        }else{

            return $view;
        }    
       
    }
}