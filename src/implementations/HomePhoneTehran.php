<?php
namespace mhndev\valueObjects\implementations;

use mhndev\valueObjects\exceptions\InvalidArgumentException;
use mhndev\valueObjects\exceptions\InvalidHomePhoneException;
use mhndev\valueObjects\exceptions\InvalidHomePhoneFormatException;
use mhndev\valueObjects\interfaces\iValueObject;

/**
 *
 * Todo change it to HomePhone and use a sqlite database and use all cities code number
 * Class HomePhoneTehran
 * @package mhndev\digipeyk\valueObjects
 */
final class HomePhoneTehran implements iValueObject
{

    /**
     * @var string
     */
    protected $givenValue;

    /**
     * @var string
     */
    protected $city_code;


    /**
     * @var string
     */
    protected $country_code;

    /**
     * @var string
     */
    protected $number;


    const c021 = 1;

    const c21 = 2;

    const withoutCode = 3;

    const c9821 = 4;

    const cp9821 = 5;


    /**
     * Todo Refactor constructor
     *
     * HomePhoneTehran constructor.
     * @param $givenValue
     * @throws InvalidHomePhoneException
     */
    public function __construct($givenValue)
    {
        if(intval($givenValue) == $givenValue){
            $givenValue = (int) $givenValue;
        }

        if(! is_int($givenValue)){
            throw new InvalidArgumentException(sprintf('integer needed given : %s'), gettype($givenValue));
        }

        if(startWith($this->givenValue, '021')){
            if(length($this->givenValue) != 11){
                throw new InvalidHomePhoneException;
            }

            $this->city_code = '021';
            $this->number = h_substr($this->givenValue, 3, 8);
        }

        elseif (startWith($givenValue, '21')){
            if(length($givenValue) != 10){
                throw new InvalidHomePhoneException;
            }

            $this->city_code = '021';
            $this->number = h_substr($givenValue, 2, 8);
        }

        elseif (startWith($givenValue, '+98')){
            if(length($givenValue) != 13){
                throw new InvalidHomePhoneException;
            }

            $this->city_code = '021';
            $this->number = h_substr($givenValue, 5, 8);
        }

        elseif (startWith($givenValue, '98')){
            $this->city_code = '021';
            $this->country_code = '98';
            $this->number = h_substr($givenValue, 4, 8);

        }

        else{
            if(length($givenValue) != 8){
                throw new InvalidHomePhoneException;
            }

            $this->city_code = '021';
            $this->country_code = '98';
            $this->number = $givenValue;
        }

    }


    /**
     * @param $format
     * @return int
     * @throws InvalidHomePhoneFormatException
     */
    public function format($format)
    {
        switch ($format){
            case self::c021:
                $returnValue = $this->city_code . $this->number;
                break;

            case self::c21:
                $returnValue = '21' . $this->number;
                break;

            case self::c9821:
                $returnValue = $this->country_code. '21' . $this->number;
                break;

            case self::cp9821:
                $returnValue = '+'. $this->country_code. '21' . $this->number;
                break;

            case self::withoutCode:
                $returnValue = $this->number;
                break;

            default:
                throw new InvalidHomePhoneFormatException;
        }


        return $returnValue;
    }

    /**
     * @param iValueObject $valueObject
     * @return boolean
     */
    function isEqual(iValueObject $valueObject)
    {
        if(! $valueObject instanceof self::class){
            return false;
        }

        return ($this->__toString()== $valueObject->__toString());
    }

    /**
     * @param bool $associative
     * @return array
     */
    public function toArray($associative = true)
    {
        if($associative){
            $arrayPresentation = [
                'country' => $this->country_code,
                'city'   => $this->city_code,
                'number' => $this->number
            ];
        }
        else{
            $arrayPresentation = [
                $this->country_code,
                $this->city_code,
                $this->number
            ];
        }


        return $arrayPresentation;
    }


    /**
     * @return string
     */
    function __toString()
    {
        return $this->country_code.'21'.$this->number;
    }
}