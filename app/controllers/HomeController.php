<?php

class HomeController
{
    public function index() {
        try {
            $notice = new Notice();
            $notices = $notice->getAllNotices();  

            $params = array(
                "notices" => $notices
            );

            ControllerUtils::render('home', $params);
        } catch (Exception $e) {
            echo $e->getMessage();
        } 
    }
}
?>