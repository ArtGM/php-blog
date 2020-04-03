<?php
namespace Blog\src\model;

abstract class Model
{
    protected $id;
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
}
