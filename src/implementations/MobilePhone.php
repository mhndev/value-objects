<?php

namespace mhndev\valueObjects\implementations\valueObjects;

use mhndev\messagingService\exceptions\InvalidMobileFormatException;
use mhndev\messagingService\exceptions\InvalidMobileNumberException;
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
        if(startWith($number, '0')){

            if($length = strlen($number) != 11){
                throw new InvalidMobileNumberException(sprintf('mobile number which starts with zero 
                should have 11 characters, given mobile has %s numbers of characters', $length));
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

        $this->number = $number;
        $this->code   = $code;
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
     * @param iValueObject $valueObject
     * @return boolean
     */
    function isEqual(iValueObject $valueObject)
    {
        // TODO: Implement isEqual() method.
    }
}
