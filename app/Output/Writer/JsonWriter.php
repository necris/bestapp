<?php

namespace App\Output\Writer;


use App\Entity\BaseEntity;

/**
 * Class JsonWriter
 * @package App\Output\Writer
 */
class JsonWriter implements IWriter
{

    /**
     * @param BaseEntity $entity
     * @param string $file
     */
    public function write(BaseEntity $entity, string $file): void
    {
        file_put_contents($file . ".json", json_encode($entity));
    }
}