<?php

namespace App\Entity;

use App\Loader\EntityLoader;
use App\Misc\PropertyLoader;


/**
 * Class BaseEntity
 * @package App\Entity
 */
abstract class BaseEntity
{

    use PropertyLoader;

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



}