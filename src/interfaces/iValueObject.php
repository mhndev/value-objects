<?php

namespace mhndev\valueObjects\interfaces;

/**
 * Interface iValueObject
 * @package mhndev\valueObjects\interfaces
 */
interface iValueObject
{

    /**
     * @param iValueObject $valueObject
     * @return boolean
     */
    function isEqual(iValueObject $valueObject);
}
