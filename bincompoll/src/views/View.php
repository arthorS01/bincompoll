<?php

namespace src\views;

class View{
    public static function render(string $view,array $variables): string|bool
    {
        
        if(file_exists(VIEWS_PATH.$view.".php")){
            extract($variables);
            //start the output buffer
            
            ob_start();
            
            require_once VIEWS_COMPONENT_PATH."header.php";
            require_once VIEWS_COMPONENT_PATH."nav_link.php";
            require_once VIEWS_PATH.$view.".php";
            require_once VIEWS_COMPONENT_PATH."footer.php";

            return ob_get_clean();
        }else{
            
            return false;
        }
    }

    public static function render404(){
        return "Page not found bro";    
    }
}