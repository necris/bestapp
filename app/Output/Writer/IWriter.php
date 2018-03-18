<?php

namespace App\Output\Writer;

use App\Entity\BaseEntity;

/**
 * Interface IWriter
 * @package App\Output\Writer
 */
interface IWriter
{
    /**
     * @param BaseEntity $entity
     * @param string $file
     */
    public function write(BaseEntity $entity, string $file): void;

}