<?php
/**
 * Created by PhpStorm.
 * User: necris
 * Date: 17.03.18
 * Time: 13:49
 */

namespace App\Output\Writer;


use App\Entity\BaseEntity;
use Nette\Reflection\ClassType;

class XmlWriter implements IWriter
{

    public function write(BaseEntity $entity, string $file): void
    {


        $reflection = new ClassType($entity);
        $className = strtolower($reflection->getShortName());
        $xml .= "<?xml version=\"1.0\"?>" . PHP_EOL;
        $xml .= "<$className>" . PHP_EOL;
        foreach($reflection->getProperties(\ReflectionProperty::IS_PUBLIC) as $property){
            $pName = $property->getName();
            $xml .= "<$pName>" . $entity->$pName . "</$pName>" . PHP_EOL;
        }
        $xml .= "</$className>" . PHP_EOL;

        file_put_contents($file . ".xml", $xml);
    }
}