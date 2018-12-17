<?php

namespace arueckauer\HarvestApi\Utilities;

class StringConverter
{
    /**
     * Convert camelCase string to snake_case string.
     *
     * @param string $input
     * @return string
     */
    public static function fromCamelCaseToSnakeCase($input): string
    {
        preg_match_all('/([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)/', $input, $matches);
        $ret = $matches[0];

        foreach ($ret as &$match) {
            $match = $match === strtoupper($match) ? strtolower($match) : lcfirst($match);
        }

        return implode('_', $ret);
    }

    /**
     * Convert snake_case to camelCase.
     *
     * @param string $string
     * @param bool $capitalizeFirstCharacter
     * @return string
     */
    public static function snakeCaseToCamelCase($string, $capitalizeFirstCharacter = false): string
    {
        $str = str_replace('_', '', ucwords($string, '_'));

        if (!$capitalizeFirstCharacter) {
            $str = lcfirst($str);
        }

        return $str;
    }
}
