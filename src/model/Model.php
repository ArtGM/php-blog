<?php
namespace Blog\src\model;

abstract class Model
{
    protected $id;
    /**
     * Post constructor.
     * @param array $data
     */
    public function __construct($data)
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * @param array $data
     */
    protected function hydrate($data)
    {
        $this->setId($data['id']);
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
}
