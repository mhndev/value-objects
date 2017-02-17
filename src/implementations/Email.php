<?php

namespace mhndev\valueObjects\implementations;

use mhndev\valueObjects\exceptions\InvalidArgumentException;
use mhndev\valueObjects\interfaces\iValueObject;

/**
 * Class Email
 * @package mhndev\valueObjects\implementations
 */
final class Email implements iValueObject
{

    /**
     * @var string
     */
    protected $value;

    /**
     * @var static
     */
    protected $local;

    /**
     * @var string
     */
    protected $domain;

    /**
     * Returns an EmailAddress object given a PHP native string as parameter.
     *
     * @param string $value
     */
    public function __construct($value)
    {
        $filteredValue = filter_var($value, FILTER_VALIDATE_EMAIL);
        if ($filteredValue === false) {
            throw new InvalidArgumentException($value, array('string (valid email address)'));
        }
        $this->value = $filteredValue;
    }


    /**
     * Returns the local part of the email address
     *
     */
    public function getLocal()
    {
        if(!empty($this->local)){
            return $this->local;
        }

        return $this->local = explode('@', $this->value)[0];
    }
    /**
     * Returns the domain part of the email address
     *
     */
    public function getDomain()
    {
        if(!empty($this->domain)){
            return $this->domain;
        }

        return $this->domain = explode('@', $this->value)[1];
    }


    /**
     * @return mixed|string
     */
    public function __toString()
    {
        return $this->value;
    }

    /**
     * @param iValueObject $valueObject
     * @return boolean
     */
    function isEqual(iValueObject $valueObject)
    {
        if( ! $valueObject instanceof self::class){
            return false;
        }

        return ($this->__toString() == $valueObject->__toString());
    }
}
