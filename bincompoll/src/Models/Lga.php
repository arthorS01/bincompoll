<?php

namespace src\Models;
use DI\Container;

class Lga{

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
            "SELECT lga_id,lga_name FROM lga"
        );

        $stmt->execute();
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
}