<?php

namespace App\Entity;

use App\Loader\EntityLoader;


/**
 * Class BaseEntity
 * @package App\Entity
 */
abstract class BaseEntity
{

    /**
     * @var EntityLoader
     */
    protected $entityLoader;

    /**
     * BaseEntity constructor.
     * @param EntityLoader $el
     */
    public function __construct(EntityLoader $el)
    {
        $this->entityLoader = $el;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {

        if ($this->$name == null) {
            $loaderMethod = "load" . ucfirst($name);
            $this->$name = $this->$loaderMethod();
        }
        return $this->$name;

    }

}