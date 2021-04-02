<?php

class Core
{
    public function start($urlGet) {
        if (isset($urlGet["page"])) {
            $controller = ucfirst($urlGet["page"]) . 'Controller';
        } else {
            $controller = 'HomeController';
        }

        $method = 'index';
        
        if (!class_exists($controller)) {
            $controller = 'ErrorController';
        } 

        $params = array(
            "id" => $urlGet["id"] ?? null
        );

        call_user_func_array(array(new $controller, $method), array_values($params));
    }
}



?>