<?php
namespace mhndev\valueObjects\implementations;

use mhndev\valueObjects\exceptions\InvalidMobileFormatException;
use mhndev\valueObjects\exceptions\InvalidMobileNumberException;
use mhndev\valueObjects\interfaces\iValueObject;

/**
 * Class MobilePhone
 * @package mhndev\digipeyk\valueObjects
 */
final class MobilePhone implements iValueObject
{
    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $number;


    const WithZero = 1;

    const WithoutZero = 2;

    const WithCode = 3;


    /**
     * MobilePhone constructor.
     * @param $number
     * @param string $code
     * @throws InvalidMobileNumberException
     */
    public function __construct($number, $code = '+98')
    {
        $number = static::isValid($number);

        $this->number = $number;
        $this->code   = $code;
    }


    /**
     * @param $number
     * @return string
     * @throws InvalidMobileNumberException
     */
    public static function isValid($number)
    {
        if(startWith($number, '0')){

            if($length = strlen($number) != 11){
                throw new InvalidMobileNumberException(sprintf('mobile number which starts with zero 
                should have 11 characters, given mobile has %s numbers of characters', $length));
            }

            if(!in_array(substr($number, 2, 1), ['0', '1', '2', '3'])){
                throw new InvalidMobileNumberException(sprintf('Third part of mobile number should be 0,1,2 or 3, given %s', substr($number, 2, 1)));
            }
            $number = ltrim($number, 0);
        }

        elseif(startWith($number, '+98') || startWith($number, '098') ){
            $number  = substr($number, 3, strlen($number) - 3);
        }

        elseif(startWith($number, '98')){
            $number  = substr($number, 2, strlen($number) - 2);
        }

        else{
            if($length = strlen($number) != 10){

                throw new InvalidMobileNumberException(sprintf('mobile number which starts with zero 
                should have 10 characters, given mobile has %s numbers of characters', $length));
            }
        }

        return $number;
    }

    /**
     * @param $format
     * @return string
     * @throws InvalidMobileFormatException
     */
    public function format($format)
    {
        switch ($format){
            case self::WithZero:
                $result = '0'.$this->number;
                break;

            case self::WithoutZero:
                $result = $this->number;
                break;


            case self::WithCode:
                $result = $this->code . $this->number;
                break;

            default:
                throw new InvalidMobileFormatException;
        }

        return $result;
    }


    /**
     * @param bool $associative
     * @return array
     */
    public function toArray($associative = true)
    {
        if($associative){
            $arrayPresentation = [
                'code' => $this->code,
                'number' => $this->number
            ];
        }
        else{
            $arrayPresentation = [
                $this->code,
                $this->number
            ];
        }


        return $arrayPresentation;
    }

    /**
     * @return string
     */
    public function preview()
    {
        return '0'. $this->number;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->code . $this->number;
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

        /** @var MobilePhone $valueObject */
        return ($this->__toString() == $valueObject->__toString());
    }

    /**
     * @param $value
     * @return static
     */
    public static function fromOptions($value)
    {
        if (!empty($value)){
            return new static($value);
        }
        return null;
    }
}
