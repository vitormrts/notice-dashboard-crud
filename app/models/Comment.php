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

    public function insert($id_notice, $data) {
        if (empty($data['name']) || empty($data['msg']) || !$id_notice ) {
            throw new Exception("Fill in all fields.");
        }

        try {
            $connection = Connection::getConnection();

            $sql = 'INSERT INTO comments (name, msg, id_notice) VALUES (:name, :msg, :id_notice)';

            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':id_notice', $id_notice);
            $stmt->bindValue(':name', $data['name']);
            $stmt->bindValue(':msg', $data['msg']);

            if ($stmt->execute()) {
                return true;
            }
        } catch (Exception $e) {
            throw new Exception("It was not possible to add a comment.");
        }
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