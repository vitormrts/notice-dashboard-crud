<?php


abstract class ControllerUtils
{
    public static function render($page = 'home', $params = array()) {
        $loader = new \Twig\Loader\FilesystemLoader('app/views');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load($page . '.html');
        
        echo $template->render($params);
    }
}

?>