<?php


namespace Blog\Model;

/**
 * Class Comment
 * @package Blog\src\Model
 */
class Comment extends Model
{
    private $content;
    private $createTime;
    private $userName;
    private $postTitleComment;
    /**
     * @var mixed
     */
    private $userId;

    /**
     * @return mixed
     */
    public function getPostTitleComment()
    {
        return $this->postTitleComment;
    }

    /**
     * @param mixed $postTitleComment
     */
    public function setPostTitleComment($postTitleComment): void
    {
        $this->postTitleComment = $postTitleComment;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName): void
    {
        $this->userName = $userName;
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
     * @param mixed $commentStatusId
     */
    public function setComment_status_id($commentStatusId): void
    {
        $commentStatusId1 = $commentStatusId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $postId
     */
    public function setPost_id($postId): void
    {
        $postId1 = $postId;
    }

    /**
     * @param array $data
     */
    protected function hydrate(array $data)
    {
        parent::hydrate($data);
        $this->setContent($data['content']);
        $this->setCreate_time($data['create_time']);
        $this->setComment_status_id($data['comment_status_id']);
        $this->setUser_id($data['user_id']);
        $this->setPost_id($data['post_id']);
        $this->setUserName($data['username']);
        if (isset($data['title'])) {
            $this->setPostTitleComment($data['title']);
        }
    }

    /**
     * @param mixed $userId
     */
    public function setUser_id($userId): void
    {
        $this->userId = $userId;
    }
}
