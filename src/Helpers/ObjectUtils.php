<?php

namespace App\Helpers;

class ObjectUtils
{
    /**
     * 
     * @param Quote $obj
     * @param array $data
     * @param array $exclude
     * @return Quote
     */
    public function initialize($obj, $data, array $exclude = [])
    {
        foreach ($data as $key => $value)
        {
            if (!in_array($key, $exclude))
            {
                $functionName = 'set' . ucfirst($key);
                if (method_exists($obj, $functionName))
                {
                    $obj->$functionName($value);
                }
            }
        }
        return $obj;
    }
}
