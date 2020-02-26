<?php

namespace Ares\Utility;

class Data
{
    /**
     * @param \stdClass[]|array $results
     * @param bool              $returnFalse If true, false returned on false results, [] otherwise
     *
     * @return array|bool
     */
    public static function resultsToArray(?array $results = null, bool $returnFalse = false)
    {
        if ($returnFalse && $results === false) {
            return false;
        }
        if (empty($results)) {
            return [];
        }
        $array = [];
        foreach ($results ?? [] as $result) {
            if ($result instanceof \stdClass || is_array($result) || is_object($result)) {
                $array[] = (array)$result;
            }
        }
        return $array;
    }
}
