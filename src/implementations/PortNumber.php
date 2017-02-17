<?php
namespace mhndev\valueObjects\implementations;

use mhndev\valueObjects\exceptions\InvalidArgumentException;
use mhndev\valueObjects\interfaces\iValueObject;

final class PortNumber implements iValueObject
{
    /**
     * Returns a PortNumber object.
     *
     * @param int $value
     */
    public function __construct($value)
    {
        $options = array(
            'options' => array(
                'min_range' => 0,
                'max_range' => 65535
            )
        );
        $value = filter_var($value, FILTER_VALIDATE_INT, $options);
        if (false === $value) {
            throw new InvalidArgumentException($value, array('int (>=0, <=65535)'));
        }
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
