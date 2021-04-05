<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$template = file_get_contents('app/templates/structure.html');

require_once 'vendor/autoload.php';

require_once 'app/core/Core.php';

require_once 'app/config/Env.php';
require_once 'app/config/Connection.php';

require_once 'app/utils/ControllerUtils.php';

require_once 'app/models/Notice.php';
require_once 'app/models/Comment.php';

require_once 'app/controllers/HomeController.php';
require_once 'app/controllers/ErrorController.php';
require_once 'app/controllers/NoticeController.php';
require_once 'app/controllers/DashboardController.php';


ob_start();
    $core = new Core;
    $core->start($_GET);

    $page = ob_get_contents();
ob_end_clean();

$newTemplate = str_replace('{{ dynamic_content }}', $page, $template);

echo $newTemplate;
?>