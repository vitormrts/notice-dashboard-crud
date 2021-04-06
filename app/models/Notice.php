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

    public function insert($data) {
        if (empty($data["title"]) || empty($data["description"])) {
            throw new Exception("Fill in all fields");
            return false;
        }

        try {
            $connection = Connection::getConnection();

            $sql = 'INSERT INTO notices (title, description) VALUES (:title, :description)';
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':title', $data['title']);
            $stmt->bindValue(':description', $data['description']);
    
            if ($stmt->execute()) {
                return true;
            }
        } catch (Exception $e){
            throw new Exception("Failed to insert notice.");
        }
    }

    public function update($id, $data) {
        if (empty($data["title"]) || empty($data["description"])) {
            throw new Exception("You cannot leave an empty field.");
            return false;
        }

        try {
            $connection = Connection::getConnection();
            $sql = 'UPDATE notices SET title = :title, description = :description WHERE id = :id';
        
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':title', $data['title']);
            $stmt->bindValue(':description', $data['description']);
            $stmt->bindValue(':id', $id);
    
            if ($stmt->execute()) {
                return true;
            }
        } catch (Exception $e) {
            throw new Exception("It was not possible to update the notice.");
        }
    }

    public function delete($id) {
        try {
            $connection = Connection::getConnection();

            $sql = "DELETE FROM notics WHERE id = :id";

            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':id', $id);

            if ($stmt->execute()) {
                return true;
            }
        } catch (Exception $e) {
            throw new Exception("It was not possible to delete the notice.");
        }
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