<?php

namespace App\Output\Writer;

use App\Entity\BaseEntity;
use Nette\Reflection\ClassType;

/**
 * Class HtmlWriter
 * @package App\Output\Writer
 */
class HtmlWriter implements IWriter
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
        $html = "<html>" . PHP_EOL;
        $html .= "<body>" . PHP_EOL;
        $html .= "<h1>$className</h1>" . PHP_EOL;
        $html .= "<table>" . PHP_EOL;
        foreach ($reflection->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            $pName = $property->getName();
            $html .= "<tr><th>$pName</th><td>" . $entity->$pName . "</td></tr>" . PHP_EOL;
        }
        $html .= "</table>" . PHP_EOL;
        $html .= "</body>" . PHP_EOL;
        $html .= "</html>" . PHP_EOL;

        file_put_contents($file . ".html", $html);
    }
}