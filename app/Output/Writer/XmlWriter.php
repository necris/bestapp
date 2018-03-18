<?php

namespace App\Output\Writer;

use App\Entity\BaseEntity;
use Nette\Reflection\ClassType;

/**
 * Class XmlWriter
 * @package App\Output\Writer
 */
class XmlWriter implements IWriter
{

    /**
     * @param BaseEntity $entity
     * @param string $file
     * @throws \ReflectionException
     */
    public function write(BaseEntity $entity, string $file): void
    {
        $reflection = new ClassType($entity);
        $className = strtolower($reflection->getShortName());
        $xml .= "<?xml version=\"1.0\"?>" . PHP_EOL;
        $xml .= "<$className>" . PHP_EOL;
        foreach ($reflection->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            $pName = $property->getName();
            $xml .= "<$pName>" . $entity->$pName . "</$pName>" . PHP_EOL;
        }
        $xml .= "</$className>" . PHP_EOL;

        file_put_contents($file . ".xml", $xml);
    }
}