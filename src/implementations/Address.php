<?php

namespace mhndev\valueObjects\implementations;

use mhndev\valueObjects\interfaces\iValueObject;

/**
 * Class Address
 * @package mhndev\messagingService\valueObjects
 */
final class Address implements iValueObject
{

    /**
     * @var string
     */
    protected $postalCode;

    /**
     * @var string
     */
    protected $country;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var string
     */
    protected $street;

    /**
     * @var string
     */
    protected $block;

    /**
     * @var string
     */
    protected $no;


    /**
     * Address constructor.
     *
     * @param string $country
     * @param string $city
     * @param string $street
     * @param string $block
     * @param string $no
     * @param string|null $postalCode
     */
    public function __construct($country, $city, $street, $block, $no, $postalCode = null)
    {
        $this->country = $country;
        $this->city = $city;
        $this->street = $street;
        $this->block = $block;
        $this->no = $no;
        $this->postalCode = $postalCode;

    }


    /**
     * @return string
     */
    function __toString()
    {
        $string = $this->country.' '.$this->city.' '.$this->street.' '.$this->block.' '.$this->no;

        if(!empty($this->postalCode)){
            $string .= ' '.$this->postalCode;
        }

        return $string;
    }

    /**
     * @param iValueObject $valueObject
     * @return boolean
     */
    function isEqual(iValueObject $valueObject)
    {

        if(! $valueObject instanceof self){
            return false;
        }

        /** @var Address $valueObject */
        return ($this->__toString() == $valueObject->__toString());
    }
}
