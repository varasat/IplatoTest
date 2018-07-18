<?php
namespace newIplatoCodingTest\Models;

use newIplatoCodingTest\Engine\Db;

class Post
{
    private $id;
    private $title;
    private $annotation;
    private $content;
    private $timeStamp;
    protected $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getAnnotation()
    {
        return $this->annotation;
    }

    /**
     * @param mixed $annotation
     */
    public function setAnnotation($annotation)
    {
        $this->annotation = $annotation;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getTimeStamp()
    {
        return $this->timeStamp;
    }

    /**
     * @param mixed $timeStamp
     */
    public function setTimeStamp($timeStamp)
    {
        $this->timeStamp = $timeStamp;
    }

    public function getAll()
    {
        $oStmt = $this->db->query('SELECT * FROM posts ORDER BY timestamp DESC');
        return $oStmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function add()
    {
        $oStmt = $this->db->prepare('INSERT INTO posts (title, annotation, content, timestamp) VALUES(:title, :annotation, :content, :timestamp)');
        $oStmt->bindValue(':title', $this->getTitle());
        $oStmt->bindValue(':annotation', $this->getAnnotation());
        $oStmt->bindValue(':content', $this->getContent());
        $oStmt->bindValue(':timestamp',time() );
        if($oStmt->execute()){
            return $this->db->lastInsertId();
        };
        return false;
    }

    public function update()
    {
        $oStmt = $this->db->prepare('UPDATE Posts SET title = :title, annotation = :annotation, content = :content, timestamp = :timestamp  WHERE id = :postId LIMIT 1');
        $oStmt->bindValue(':postId', $this->getId());
        $oStmt->bindValue(':title', $this->getTitle());
        $oStmt->bindValue(':annotation', $this->getAnnotation());
        $oStmt->bindValue(':content', $this->getContent());
        $oStmt->bindValue(':timestamp',time() );
        return $oStmt->execute();
    }

    public function getById($id)
    {
        $oStmt = $this->db->prepare('SELECT * FROM Posts WHERE id = :postId LIMIT 1');
        $oStmt->bindParam(':postId', $id, \PDO::PARAM_INT);
        $oStmt->execute();
        $post = $oStmt->fetch(\PDO::FETCH_OBJ);
        $this->setId($post->id);
        $this->setTitle($post->title);
        $this->setAnnotation($post->annotation);
        $this->setContent($post->content);
        $this->setTimeStamp($post->timestamp);
    }

    public function delete()
    {
        $oStmt = $this->db->prepare('DELETE FROM Posts WHERE id = :postId LIMIT 1');
        $oStmt->bindParam(':postId', $this->getId(), \PDO::PARAM_INT);
        return $oStmt->execute();
    }

}