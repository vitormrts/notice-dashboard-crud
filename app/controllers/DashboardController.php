<?php

class DashboardController
{
    public function index() {
        try {
            $notice = new Notice();

            $params = array(
                "notices" => $notice->getAllNotices()
            );
    
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

    public function change($id) {
        try {
            $notice = new Notice();
            $notice = $notice->getNotice($id);

            $params = array(
                "title" => $notice->getTitle(),
                "description" => $notice->getDescription(),
                "id" => $notice->getId()
            );

            ControllerUtils::render('dashboard-update', $params);
            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
 
    public function update($id) {
        try {
            $notice = new Notice();
            $notice->update($id, $_POST);

            echo "<script>alert('The notice was updated with success!');</script>";
            echo '<script>location.href="/?page=dashboard&method=index";</script>';
        } catch (Exception $e) {
            echo "<script>alert('" . $e->getMessage() . "');</script>";
            echo "<script>location.href='/?page=dashboard&method=change&id=". $id ."';</script>";
        }
    }

    public function delete($id) {
        try {
            $notice = new Notice();
            $notice->delete($id);

            echo "<script>alert('The notice was deleted with success!');</script>";
            echo "<script>location.href='/?page=dashboard';</script>";
        } catch (Exception $e){
            echo "<script>alert('" . $e->getMessage() . "');</script>";
            echo "<script>location.href='/?page=dashboard';</script>";
        }

    }
}

?>