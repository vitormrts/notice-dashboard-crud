<?php

class NoticeController 
{
    public function index($id) {
        try {
            $notice = new Notice();
            $notice = $notice->getNotice($id);

            $params = array(
                "title" => $notice->getTitle(),
                "description" => $notice->getDescription(),
                "comments" => $notice->getComments()
            );

            ControllerUtils::render('notice', $params);
        } catch (Exception $e) {
            echo $e->getMessage();
        } 
    }
}

?>