<?php

namespace src\Models;
use DI\Container;


class Result{

    public function __construct(){
        try{
            $dbHost = DB_HOST;
            $dbName = DB_NAME;
            $this->connection = new \PDO("mysql:host={$dbHost};dbname={$dbName}",DB_USER,DB_PASS);
        }catch(\PDOException $e){
            throw new FailedTOConnectTODb;
        }
       
    }
    public function getAll(){
        
        
        $stmt  = $this->connection->prepare(
            "SELECT ward_id,ward_name FROM ward"
        );

        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        return $result;
    }

    public function query(string $queryString, ?array $params)
    {
        $stmt  = $this->connection->prepare($queryString);

        if(is_null($params)){
            $stmt->execute();
        }else{
            $stmt->execute($params);
        }
        
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;   
    }

    public function store(array $data):bool{
    //$queryA = 
    // //$queryB = 
        try{
            $this->connection->beginTransaction();
            $stmt = $this->connection->prepare("INSERT into polling_unit(ward_id,lga_id) Values(:ward_id,:lga_id)");
            //create the polling unit
            $stmt->execute([
                "ward_id"=>$data["ward_id"],
                "lga_id"=>$data["lga_id"]
            ]);
            $last_inserted_id = $this->connection->lastInsertId();

            //get all parties
            $all_parties = (new Party)->getAll();
            $names = array_map(function($item){
                return $item["partyname"];
            },$all_parties);

            $data2 = [
                "polling_unit_uniqueid"=>$last_inserted_id,
                "entered_by_user"=>$data["entered_by"],
                "date_entered"=>$data["date_entered"]
            ];
            
            $stmt = $this->connection->prepare("Insert into announced_pu_results(polling_unit_uniqueid,party_abbreviation,party_score,entered_by_user,date_entered) Values (:polling_unit_uniqueid,:party_abbreviation,:party_score,:entered_by_user,:date_entered)");

            foreach($names as $key=>$name){
                $data2["party_abbreviation"] = $name;
                $data2["party_score"]=$data[$name."_score"];

                $stmt->execute($data2);
            }
            
          $this->connection->commit();

          return true;
           
        }catch(\Exception $e){

            throw $e;
            $this->connection->rollback();
            echo $e->getMessage();
            return false;
        }
    
    }
}