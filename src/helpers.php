<?php

if(! function_exists('startWith'))
{
    function startWith($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if ($needle != '' && mb_strpos($haystack, $needle) === 0) {
                return true;
            }
        }

        return false;
    }
}


if(! function_exists('endsWith'))
{
    /**
     * Determine if a given string ends with a given substring.
     *
     * @param  string  $haystack
     * @param  string|array  $needles
     * @return bool
     */
    function endsWith($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if ((string) $needle === h_substr($haystack, -length($needle))) {
                return true;
            }
        }

        return false;
    }
}

/**
 * length function
 */
if(! function_exists('length'))
{
    /**
     * @param $value
     * @return int
     */
    function length($value)
    {
        return mb_strlen($value);
    }
}


/**
 * h_substr function
 */
if(! function_exists('h_substr'))
{
    /**
     * Returns the portion of string specified by the start and length parameters.
     *
     * @param  string  $string
     * @param  int  $start
     * @param  int|null  $length
     * @return string
     */
    function h_substr($string, $start, $length = null)
    {
        return mb_substr($string, $start, $length, 'UTF-8');
    }
}
