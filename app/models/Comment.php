<?php

class Comment
{
    private $id;
    private $name;
    private $msg;
    private $idNotice;

    public function getAllComments($idNotice) {
        $connection = Connection::getConnection();

        $sql = 'SELECT * FROM comments WHERE id_notice = :id';
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':id', $idNotice, PDO::PARAM_INT);
        $stmt->execute();

        $comments = array();

        while ($comment = $stmt->fetchObject('Comment')) {
            array_push($comments, $comment);
        }

        return $comments;
    }

    public function getId($id) {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getMsg() {
        return $this->msg;
    }

    public function getIdNotice() {
        return $this->idNotice;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setMsg($msg) {
        $this->msg = $msg;
    }

    public function setIdNotice($idNotice) {
        $this->idNotice = $idNotice;
    }
}

?>