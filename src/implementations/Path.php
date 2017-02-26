<?php
namespace mhndev\valueObjects\implementations;

use mhndev\valueObjects\exceptions\InvalidArgumentException;
use mhndev\valueObjects\interfaces\iValueObject;

/**
 * Class Path
 * @package mhndev\valueObjects\implementations
 */
final class Path implements iValueObject
{

    protected $value;

    /**
     * Path constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $filteredValue = parse_url($value, PHP_URL_PATH);
        if (null === $filteredValue || strlen($filteredValue) != strlen($value)) {
            throw new InvalidArgumentException($value, array('string (valid url path)'));
        }
        $this->value = $filteredValue;
    }

    /**
     * @param iValueObject $valueObject
     * @return boolean
     */
    function isEqual(iValueObject $valueObject)
    {
        // TODO: Implement isEqual() method.
    }
}
