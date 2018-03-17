<?php
/**
 * Created by PhpStorm.
 * User: necris
 * Date: 02.03.18
 * Time: 20:38
 */

namespace App\Output;


use App\Entity\BaseEntity;
use App\Output\Writer\IWriter;

class Output
{

    /**
     * @var IWriter[]
     *
     */
    private $writers = array();

    /**
     * @param IWriter $w
     * @return $this
     */
    public function addWriter(IWriter $w)
    {
        $this->writers[] = $w;
        return $this;
    }

    public function save($dir, BaseEntity $e)
    {
        $name = uniqid();
        foreach ($this->writers as $writer){
            $writer->write($e, $dir . "/" . $name);
        }
    }
}