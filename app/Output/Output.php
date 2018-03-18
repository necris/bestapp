<?php

namespace App\Output;

use App\Entity\BaseEntity;
use App\Output\Writer\IWriter;

/**
 * Class Output
 * @package App\Output
 */
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
    public function addWriter(IWriter $w): self
    {
        $this->writers[] = $w;
        return $this;
    }

    /**
     * @param $dir
     * @param BaseEntity $e
     */
    public function save($dir, BaseEntity $e): void
    {
        $name = uniqid();
        foreach ($this->writers as $writer) {
            $writer->write($e, $dir . "/" . $name);
        }
    }
}