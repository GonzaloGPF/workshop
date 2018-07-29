<?php

/**
 * Used By Filter class. It gets underscore code style and converts it to camelCase.
 *
 * @param string $value
 *
 * @return string string
 */
function underscoreToCamelCase(string $value)
{
    if (strpos($value, '_') === false) {
        return $value;
    }

    $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $value)));
    $str[0] = strtolower($str[0]);

    return $str;
}
