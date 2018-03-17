<?php
/**
 * Created by PhpStorm.
 * User: necris
 * Date: 17.03.18
 * Time: 13:47
 */

namespace App\Output\Writer;


use App\Entity\BaseEntity;

interface IWriter
{
    public function write(BaseEntity $entity, string $file): void;

}