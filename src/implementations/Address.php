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
     * @var Point
     */
    protected $point;


    /**
     * Address constructor.
     *
     * @param string $country
     * @param string $city
     * @param string $street
     * @param string $block
     * @param string $no
     * @param string | null $postalCode
     * @param null $point
     */
    public function __construct(
        $country,
        $city,
        $street,
        $block,
        $no,
        $postalCode = null,
        $point = null
    )
    {
        $this->country = $country;
        $this->city = $city;
        $this->street = $street;
        $this->block = $block;
        $this->no = $no;
        $this->postalCode = $postalCode;
        $this->point = $point;
    }



    /**
     * @param array $options
     * @return static
     */
    static function fromOptions(array $options)
    {
        return new static(
            $options['country'],
            $options['city'],
            $options['street'],
            $options['block'],
            $options['no'],
            $options['postalCode'],
            $options['point']
        );
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



    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }


    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getBlock(): string
    {
        return $this->block;
    }

    /**
     * @return string
     */
    public function getNo(): string
    {
        return $this->no;
    }

    /**
     * @return Point
     */
    public function getPoint(): Point
    {
        return $this->point;
    }


    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'country'    => $this->getCountry(),
            'city'       => $this->getCity(),
            'block'      => $this->getBlock(),
            'no'         => $this->getNo(),
            'postalCode' => $this->getPostalCode(),
            'point'      => $this->getPoint(),
            'street'     => $this->getStreet()
        ];

    }

}
