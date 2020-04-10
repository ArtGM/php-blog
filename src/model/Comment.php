<?php


namespace Blog\src\model;

class Comment extends Model
{

    private $content;
    private $createTime;
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
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * @param mixed $createTime
     */
    public function setCreate_time($createTime): void
    {
        $this->createTime = $createTime;
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
    public function setComment_status_id($commentStatusId): void
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
    public function setUser_id($userId): void
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
    public function setPost_id($postId): void
    {
        $this->postId = $postId;
    }

}
