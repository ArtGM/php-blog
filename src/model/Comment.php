<?php


namespace Blog\src\model;

class Comment extends Model
{

    private $content;
    private $createdTime;
    private $commentStatusId;
    private $userId;
    private $postId;

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
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getCreatedTime()
    {
        return $this->createdTime;
    }

    /**
     * @param mixed $createdTime
     */
    public function setCreatedTime($createdTime): void
    {
        $this->createdTime = $createdTime;
    }

    /**
     * @return mixed
     */
    public function getCommentStatusId()
    {
        return $this->commentStatusId;
    }

    /**
     * @param mixed $commentStatusId
     */
    public function setCommentStatusId($commentStatusId): void
    {
        $this->commentStatusId = $commentStatusId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
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
    public function setPostId($postId): void
    {
        $this->postId = $postId;
    }

}
