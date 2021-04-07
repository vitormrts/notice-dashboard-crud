<?php

class NoticeController 
{
    public function index($id) {
        try {
            $notice = new Notice();
            $notice = $notice->getNotice($id);

            $params = array(
                "id" => $notice->getId(),
                "title" => $notice->getTitle(),
                "description" => $notice->getDescription(),
                "comments" => $notice->getComments()
            );

            ControllerUtils::render('notice', $params);
        } catch (Exception $e) {
            echo $e->getMessage();
        } 
    }

    public function addComment($id) {
        try {
            $comment = new Comment();
            $comment->insert($id, $_POST);

            echo "<script>alert('The comment was added with success!');</script>";
            echo '<script>location.href="/?page=notice&method=index&id=' . $id .'";</script>';
        } catch (Exception $e) {
            echo "<script>alert('" . $e->getMessage() . "');</script>";
            echo "<script>location.href='/?page=notice&method=index&id=". $id ."';</script>";
        }
    }
}

?>