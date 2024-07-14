<?php

declare(strict_types=1);

namespace core;

class Router{

    private array $routes ;

    public function __construct(){
        $this->routes = [];
    }

    private function register(string $method, string $path, array $controller){
        $this->routes[$method][$path] = $controller;

        return $this;
    }

    public function get(string $path, array $controller){
        return $this->register("GET",$path,$controller);
    }

    public function post(string $path, array $controller){
        return $this->register("POST",$path,$controller);
    }

    public function render(string $method, string $uri){

        $components = parse_url($uri);

        $path = $components["path"];

     
       $components = explode("/",$path);

       $controller = $components[2] ?? null;

       $action = $components[3] ?? null;

       $path = $controller."/".$action;

       if(isset($this->routes[$method][$path])){

        $controller_details = $this->routes[$method][$path];
        $class = $controller_details[0];
        $controller_method = $controller_details[1];
        $obj = new $class();

            return call_user_func_array([$obj,$controller_method],[]);
        }{
            echo $path,$method;
            print_r($this->routes);
            http_response_code(404);
            throw new \src\Exception\PageNotFound();
        }
    }


    public function getRoutes(){

        echo "<pre>";
        var_dump($this->routes);
        echo "</pre>";
    }
}