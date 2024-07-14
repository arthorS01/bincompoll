<?php

declare(strict_types=1);

namespace core;

class App{
    private Router $router;


    public function __construct(Router $router){
        $this->router = $router;
       
    }

    public function render(string $method, string $uri){
        return $this->router->render($method,$uri);
    }
}