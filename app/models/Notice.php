<?php

class Notice
{
    private $id;
    private $title;
    private $description; 
    private $comments;
    
    public function getAllNotices() {
        $connection = Connection::getConnection();

        $sql = 'SELECT * FROM notices ORDER BY id DESC';

        $stmt = $connection->prepare($sql);
        $stmt->execute();

        $notices = array();

        # se dermos $stmt->fetchAll() receberemos que as noticias sao arrays, por isso as transformaremos em objetos

        while ($row = $stmt->fetchObject('Notice')) { # transforma o registro em um objeto do tipo Notice
            // $notices[] = $row;
            array_push($notices, $row);
        }

        if (!$notices) {
            throw new Exception("No record could be found.");
        }

        return $notices;
    }

    public function getNotice($id) {
        $connection = Connection::getConnection();

        $sql = 'SELECT * FROM notices WHERE id = :id';

        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $notice = $stmt->fetchObject('Notice');

        if (!$notice) {
            throw new Exception("No record could be found.");
        }

        $comments = new Comment();
        $comments = $comments->getAllComments($id);
        
        $notice->setComments($comments);

        if (!$notice->getComments()) {
            $notice->setComments("This notice has no comments.");
        }

        return $notice;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getComments() {
        return $this->comments;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setComments($comments) {
        $this->comments = $comments;
    }
};

?>