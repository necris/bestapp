<?php

namespace App\Misc;


/**
 * Trait PropertyLoader
 * @package App\Misc
 */
trait PropertyLoader
{

    /**
     * Method is called, when is accessed to unaccessible property and tries to call
     * load<Property> method to fill it and then return value
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        // TODO: check, if property exists, throw proper exception

        if ($this->$name === null) {
            $loaderMethod = "load" . ucfirst($name);
            $this->$name = $this->$loaderMethod();
        }
        return $this->$name;

    }
}