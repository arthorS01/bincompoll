<?php

namespace src\Models;
use DI\Container;

class Party{

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
            "SELECT partyname FROM party"
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