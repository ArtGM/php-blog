<?php

namespace Blog\src\model;

use Blog\src\tools\Slug;

class Post
{
    private $id;
    private $title;
    private $content;
    private $status;
    private $createdAt;
    private $updatedAt;
    private $postType;
    private $userId;
    private $userRolesId;

    public $slug;

    /**
     * Post constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * @param array $data
     */
    private function hydrate(array $data)
    {
        foreach ($data as $attr => $val) {
            $setMethod = 'set' . ucfirst($attr);
            if (is_callable($setMethod, true)) {
                $this->$setMethod($val);
            }
        }
    }

    public function getSlug()
    {
        $slugify = new Slug();
        return $slugify->generate($this->title);
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
    public function setId($id): void
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
    public function setTitle($title): void
    {
        $this->title = $title;
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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreated_at($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdated_at($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getPostType()
    {
        return $this->postType;
    }

    /**
     * @param mixed $postType
     */
    public function setPost_type($postType): void
    {
        $this->postType = $postType;
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
    public function getUserRolesId()
    {
        return $this->userRolesId;
    }

    /**
     * @param mixed $userRolesId
     */
    public function setUser_roles_id($userRolesId): void
    {
        $this->userRolesId = $userRolesId;
    }
}
