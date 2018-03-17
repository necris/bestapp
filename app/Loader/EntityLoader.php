<?php

namespace App\Loader;


use App\Entity\BaseEntity;
use GuzzleHttp\Exception\RequestException;
use Nette\Reflection\ClassType;

class EntityLoader
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    private $apiEndpoint;


    /**
     * EntityLoader constructor.
     * @param $apiEndpoint
     * @param \GuzzleHttp\Client $client
     */
    public function __construct($apiEndpoint, \GuzzleHttp\Client $client)
    {
        $this->client = $client;
        $this->apiEndpoint = $apiEndpoint;


    }

    /**
     * @param $class
     * @param null $id
     * @param array $parameters
     * @return BaseEntity|BaseEntity[]
     * @throws \ReflectionException
     */
    public function load($class, $id = null, $parameters = [])
    {
        $reflection = new \Nette\Reflection\ClassType($class);

        $url = $this->apiEndpoint . "/" . $this->getEntityCollection($reflection) . "/" . $id . $this->formatParameters($parameters);
        try {
            $data = json_decode($this->client->request("GET", $url)->getBody());
            if ($id == null) {
                $entities = array();
                foreach ($data as $r) {
                    $entities[] = $this->transformToEntity($r, $class);
                }
                return $entities;
            } else {
                return $this->transformToEntity($data, $class);
            }
        } catch (RequestException $e) {
            if ($id == null) {
                return [];
            } else {
                return null;
            }
        }


    }

    /**
     * @param ClassType $r
     * @return \Nette\Reflection\IAnnotation
     */
    private function getEntityCollection(ClassType $r)
    {
        return $r->getAnnotation("Collection");
    }

    /**
     * @param $parameters
     * @return null|string
     */
    private function formatParameters($parameters)
    {
        if (count($parameters) == 0) {
            return null;
        }

        $formattedParameters = array();
        foreach ($parameters as $k => $v) {
            $formattedParameters[] = $k . "=" . urlencode($v);
        }
        return "?" . implode("&", $formattedParameters);


    }

    /**
     * @param $r
     * @param $class
     * @return BaseEntity
     * @throws \ReflectionException
     */
    private function transformToEntity($r, $class)
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