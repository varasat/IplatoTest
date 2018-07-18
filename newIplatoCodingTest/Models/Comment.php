<?php

namespace newIplatoCodingTest\Models;

use newIplatoCodingTest\Engine\Db;

class Comment
{
    private $id;
    private $subject;
    private $content;
    private $userEmail;
    private $timeStamp;
    private $postId;

    /**
     * Comment constructor.
     */
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
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
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
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * @param mixed $userEmail
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;
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

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * @param mixed $postId
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;
    }

    public function add()
    {
        $this->setTimeStamp(time());
        $oStmt = $this->db->prepare('INSERT INTO comments (subject, content, userEmail, timestamp, postId) VALUES(:subject, :content, :userEmail, :timestamp, :postId)');
        $oStmt->bindValue(':subject', $this->getSubject());
        $oStmt->bindValue(':content', $this->getContent());
        $oStmt->bindValue(':userEmail', $this->getUserEmail());
        $oStmt->bindValue(':postId', $this->getPostId());
        $oStmt->bindValue(':timestamp', $this->getTimeStamp());
        if ($oStmt->execute()) {
            return [
                "id" =>$this->db->lastInsertId(),
                "subject" =>$this->getSubject(),
                "content" =>$this->getContent(),
                "userEmail" =>$this->getUserEmail(),
                "postId" =>$this->getPostId(),
                "timestamp" => date("d-m-Y H:i:s", $this->getTimeStamp()),
            ];

        };
        return false;
    }

    public function getAll($postId)
    {
        $oStmt = $this->db->prepare('SELECT * FROM comments WHERE postId = :postId ORDER BY timestamp DESC');
        $oStmt->bindParam(':postId', $postId, \PDO::PARAM_INT);
        $oStmt->execute();
        return $oStmt->fetchAll(\PDO::FETCH_OBJ);
    }
}