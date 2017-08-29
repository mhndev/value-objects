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
    protected $neighbourhood;

    /**
     * @var
     */
    protected $detail;

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
     * @param string $neighbourhood
     * @param $detail
     * @param string $block
     * @param string $no
     * @param null $point
     * @param string $country
     * @param string $city
     * @param string $postalCode
     */
    public function __construct(
        $neighbourhood,
        $detail,
        $block,
        $no,
        $point ,
        $country ,
        $city ,
        $postalCode
    )
    {
        $this->country = $country;
        $this->city = $city;
        $this->neighbourhood = $neighbourhood;
        $this->detail = $detail;
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
            $options['neighbourhood'],
            $options['detail'],
            $options['block'],
            $options['no'],
            new Point($options['point']['lat'],$options['point']['lon']),
            !empty($options['country']) ? $options['country'] : 'Iran',
            !empty($options['city']) ? $options['city'] : 'Tehran',
            !empty($options['postalCode']) ? $options['postalCode'] : null
        );
    }


    /**
     * @return string
     */
    function __toString()
    {
        $string = $this->country.' '.$this->city.' '.$this->neighbourhood.' '.$this->detail . ' ' .$this->block.' '.$this->no;

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
    public function getPostalCode()
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
     * @return string
     */
    public function getNeighbourhood(): string
    {
        return $this->neighbourhood;
    }

    /**
     * @return mixed
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'country'       => $this->getCountry(),
            'city'          => $this->getCity(),
            'block'         => $this->getBlock(),
            'no'            => $this->getNo(),
            'postalCode'    => $this->getPostalCode(),
            'point'         => $this->getPoint(),
            'neighbourhood' => $this->getNeighbourhood(),
            'detail'        => $this->getDetail()
        ];

    }

    /**
     * @return array
     */
    public function preview()
    {
        $result = $this->toArray();
        if (!empty($result['point'])){
            $result['point'] = $result['point']->preview();
        }
        return $result;
    }



}
