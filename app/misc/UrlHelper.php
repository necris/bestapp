<?php

namespace App\Misc;

/**
 * Class UrlHelper
 * @package App\Misc
 */
class UrlHelper
{
    /**
     * @param $parameters
     * @return string
     */
    static function formatParameters($parameters): string
    {
        if (count($parameters) == 0) {
            return "";
        }

        $formattedParameters = array();
        foreach ($parameters as $k => $v) {
            $formattedParameters[] = $k . "=" . urlencode($v);
        }
        return "?" . implode("&", $formattedParameters);
    }
}