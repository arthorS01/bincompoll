<?php

namespace src\Models;
use DI\Container;

class Poll{

    public function __construct(){
        try{
            $dbHost = DB_HOST;
            $dbName = DB_NAME;
            $this->connection = new \PDO("mysql:host={$dbHost};dbname={$dbName}",DB_USER,DB_PASS);
        }catch(\PDOException $e){
            throw new FailedTOConnectTODb;
        }
       
    }
    public function getResult(string $pollUnitID){
        
        
        $stmt  = $this->connection->prepare(
            "SELECT * FROM announced_pu_results WHERE polling_unit_uniqueid = :id "
        );

        $stmt->execute(["id"=>$pollUnitID]);
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        return $result;
    }

    public function getUnits():array
    {
        $stmt  = $this->connection->prepare(
            "SELECT uniqueid,polling_unit_name FROM polling_unit"
        );

        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
}