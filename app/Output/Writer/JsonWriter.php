<?php
/**
 * Created by PhpStorm.
 * User: necris
 * Date: 17.03.18
 * Time: 13:49
 */

namespace App\Output\Writer;


use App\Entity\BaseEntity;

class JsonWriter implements IWriter
{

    public function write(BaseEntity $entity, string $file): void
    {
        file_put_contents($file . ".json", json_encode($entity));
    }
}