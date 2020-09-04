<?php
namespace Blog\src\model;

/**
 * Class Model
 * @package Blog\src\model
 */
abstract class Model
{
    protected $id;

    /**
     * Post constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * @param array $data
     */
    protected function hydrate(array $data)
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
