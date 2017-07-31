<?php
namespace mhndev\valueObjects\implementations;

use mhndev\valueObjects\interfaces\iValueObject;

/**
 * Class Point
 * @package mhndev\valueObjects\implementations
 */
final class Point implements iValueObject
{

    /**
     * @var float
     */
    protected $lat;

    /**
     * @var float
     */
    protected $lon;


    /**
     * Point constructor.
     * @param float $lat
     * @param float $lon
     */
    public function __construct(float $lat, float $lon)
    {
        $this->lat = $lat;
        $this->lon = $lon;
    }


    /**
     * @param iValueObject $valueObject
     * @return boolean
     */
    function isEqual(iValueObject $valueObject)
    {
        return ($this->lat == $valueObject->getLat() && $this->lon == $valueObject->getLon());
    }

    /**
     * @return float
     */
    public function getLat(): float
    {
        return $this->lat;
    }

    /**
     * @return float
     */
    public function getLon(): float
    {
        return $this->lon;
    }
}
