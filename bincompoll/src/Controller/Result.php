<?php

namespace src\Controller;
use src\views\View;
use src\Models\{Result as ResultModelHandler,Lga,Ward,Party};
use Valitron\Validator;
use src\Exceptions\InvalidResultDetail;


class Result{

    public function __construct(){

        //initialize party model
        $this->partyModel = new Party();
    }

   
    public function storePage()
    {
        $path = "store_results";

        //initialize ardModel 
        $wardModel = new Ward();

        //initialize LGA model
        $lgaModel = new Lga();

        //initialize Result model
        $model = new ResultModelHandler();

        $allLga = $lgaModel->getAll();
        $allWard = $wardModel->getAll();
        $allParty = $this->partyModel->getAll();
        
        //get HTML view
        $view =  View::render($path,["allLga"=>$allLga, "allWard"=>$allWard, "allParty"=>$allParty]);
        
        if(is_bool($view)){
          
            return false;
        }else{

            return $view;
        }   
    }

    public function store()
    {
        $requestData = $_POST;
    
        $validator = new Validator($requestData);
      
        $validator->rule("email","agent_email");
        $validator->rule("alpha","agent_name");
        $validator->rule("alphaNum", "unit_name");
        $validator->rule("required",["agent_email","agent_name","unit_name"]);
       
        $allParty = $this->partyModel->getAll();
        try{
            if($validator->validate()){
                $model = new ResultModelHandler;
                //get the uniqueid of the selected ward
                $queryA = "Select uniqueid FROM ward WHERE ward_id = :id LIMIT 1 ";
                $result = $model->query($queryA,["id"=>$requestData["ward"]]);
    
                $data = [
                    "ward_id"=>$requestData["ward"],
                    "lga_id"=>$requestData["lga_id"],
                    "uniquewardid"=>$result[0]["uniqueid"],
                    "polling_unit_number"=>$requestData["unit_number"],
                    "polling_unit_name"=>$requestData["unit_name"],
                    "polling_unit_description"=>$requestData["polling_unit_description"],
                    "entered_by"=>$requestData["agent_name"],
                    "date_entered"=>Date("y-m-d")
                ];
    
                foreach($allParty as $party){
                    $entry = $party["partyname"]."_score";
                    $data[$entry] = $requestData[$entry];
                }
    
                $model->store($data);
    
                $_SESSION["success"] = "Addedd Sucessfully";
                
            }else{
                throw new InvalidResultDetail($validator->errors());
            }
        }catch(InvalidResultDetail){
           
            $_SESSION["errors"] = $validator->errors();
            $_SESSION["old"] = $requestData;
          
        }

        $uri = "http://localhost/".SITE_NAME."/addScore";
        header("location:{$uri}");
        
    }
}