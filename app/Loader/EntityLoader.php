<?php

namespace App\Loader;

use App\Entity\BaseEntity;
use App\Misc\UrlHelper;
use GuzzleHttp\Exception\RequestException;
use Nette\Reflection\ClassType;

class EntityLoader
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @var string
     */
    private $apiEndpoint;


    /**
     * EntityLoader constructor.
     * @param $apiEndpoint
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(string $apiEndpoint, \GuzzleHttp\Client $client)
    {
        $this->client = $client;
        $this->apiEndpoint = $apiEndpoint;
    }

    /**
     * call api request and return entity
     * @param $class
     * @param null $id
     * @param array $parameters
     * @return BaseEntity|BaseEntity[]
     * @throws RequestException
     * @throws \ReflectionException
     */
    public function load($class, $id = null, $parameters = [])
    {
        $reflection = new \Nette\Reflection\ClassType($class);

        $url = $this->apiEndpoint . "/" . $this->getEntityCollection($reflection) . "/" . $id . UrlHelper::formatParameters($parameters);

        $data = json_decode($this->client->request("GET", $url)->getBody());
        if ($id === null) {
            $entities = [];
            foreach ($data as $r) {
                $entities[] = $this->populateEntity($r, $class);
            }
            return $entities;
        } else {
            return $this->populateEntity($data, $class);
        }
    }

    /**
     * @param ClassType $r
     * @return \Nette\Reflection\IAnnotation
     */
    private function getEntityCollection(ClassType $r): string
    {
        return $r->getAnnotation("Collection");
    }


    /**
     * @param $r
     * @param $class
     * @return BaseEntity
     * @throws \ReflectionException
     */
    private function populateEntity($r, $class): BaseEntity
    {
        $reflection = new \Nette\Reflection\ClassType($class);
        $e = new $class($this);
        foreach ($reflection->getProperties() as $p) {
            if ($p->hasAnnotation("mapping")) {
                $propertyName = $p->getName();
                $mappingName = $p->getAnnotation("mapping");
                $e->$propertyName = $r->$mappingName;
            }
        }
        return $e;
    }
}