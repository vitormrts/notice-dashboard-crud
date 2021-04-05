<?php

class Core
{
    public function start($urlGet) {
        $controller = isset($urlGet["page"]) ? ucfirst($urlGet["page"]) . "Controller" : "HomeController";
        $method = isset($urlGet["method"]) && method_exists($controller, $urlGet["method"]) ? $urlGet["method"] : 'index'; 

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