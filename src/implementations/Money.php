<?php
namespace mhndev\valueObjects\implementations;

use mhndev\valueObjects\interfaces\iValueObject;

/**
 * Class Money
 * @package mhndev\messagingService\valueObjects
 */
final class Money implements iValueObject
{

    /**
     * @var
     */
    protected $value;

    /**
     * @param iValueObject $valueObject
     * @return boolean
     */
    function isEqual(iValueObject $valueObject)
    {
        // TODO: Implement isEqual() method.
    }
}
