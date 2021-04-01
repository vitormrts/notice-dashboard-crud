<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$template = file_get_contents('app/templates/structure.html');

require_once 'app/core/Core.php';

require_once 'app/controllers/HomeController.php';
require_once 'app/controllers/ErroController.php';
 
ob_start();
    $core = new Core;
    $core->start($_GET);

    $page = ob_get_contents();
ob_end_clean();

$newTemplate = str_replace('{{ dynamic_content }}', $page, $template);

echo $newTemplate;
?>

<h1>
    teste
</h1>