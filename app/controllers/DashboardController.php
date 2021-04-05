<?php

class DashboardController
{
    public function index() {
        try {
            $notice = new Notice();

            $params = array(
                "notices" => $notice->getAllNotices()
            );

            // var_dump($params);
    
            ControllerUtils::render('dashboard', $params);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

    public function create() {
        try {    
            ControllerUtils::render('dashboard-create');
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

    public function insert() {
        try {
            $notice = new Notice();
            $notice->insert($_POST);

            echo '<script>alert("The notice has been published!");</script>';
            echo '<script>location.href="/?page=dashboard&method=index";</script>';

            
        } catch (Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '");</script>';
            echo '<script>location.href="/?page=dashboard&method=create";</script>';
        }

    }
}

?>