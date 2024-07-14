<?php

namespace src\Controller;

use src\views\View;
use src\Models\Lga as LgaModelHandler;

class Lga{

    public function __construct(){}

   
    public function getTotal()
    {
        
        $path = "getTotal";
        $model = new LgaModelHandler();
        $total = null;
        $filteredLga = null;
        $allLga = $model->getAll();
        $sum = null;
        if(strtolower($_SERVER["REQUEST_METHOD"])== "post"){
            $lgaId =$_POST["lga-selection"];
            $query = "SELECT polling_unit.polling_unit_name,polling_unit.lga_id, announced_pu_results.party_abbreviation,announced_pu_results.party_score FROM polling_unit JOIN announced_pu_results WHERE polling_unit.polling_unit_id = announced_pu_results.polling_unit_uniqueid AND polling_unit.lga_id = :lga_id";
            $filteredLga = ($model)->query($query,["lga_id"=>$lgaId]);
            $sum = 0;
            
           foreach($filteredLga as $lga){
            $sum += $lga["party_score"]++;
           }
        }else{
            
        }
       
      
        $view =  View::render($path,["allLga"=>$allLga,"filtered_lga"=> $filteredLga,"total"=>$total,"method"=>strtolower($_SERVER["REQUEST_METHOD"]), "sum"=>$sum]);
        
        if(is_bool($view)){
          
            return false;
        }else{

            return $view;
        }   
 
        return $response;
    }
}