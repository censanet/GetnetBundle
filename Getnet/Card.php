<?php
namespace Censanet\GetnetBundle\Getnet;


/**
 * Class Card
 * @package Getnet\API
 */
class Card implements \JsonSerializable
{
    
//    protected $brand;
//    
//    protected $cardholder_name;
//   
//    protected $expiration_month;
//    
//    protected $expiration_year;
//    
//    protected $number_token;
//    
//    protected $security_code;


    /**
     * Card constructor.
     * @param Token $card
     */
    public function __construct($numberToken)
    {
        $this->setNumberToken($numberToken);
    }


    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    /**
     * @return mixed
     */
    public function getSecurityCode()
    {
        return $this->security_code;
    }

    /**
     * @param mixed $security_code
     * @return Card
     */
    public function setSecurityCode($security_code)
    {
        $this->security_code = $security_code;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed $brand
     * @return Card
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCardholderName()
    {
        return $this->cardholder_name;
    }

    /**
     * @param mixed $cardholder_name
     * @return Card
     */
    public function setCardholderName($cardholder_name)
    {
        $this->cardholder_name = $cardholder_name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpirationMonth()
    {
        return $this->expiration_month;
    }

    /**
     * @param mixed $expiration_month
     * @return Card
     */
    public function setExpirationMonth($expiration_month)
    {
        $this->expiration_month = str_pad($expiration_month, 2, "0", STR_PAD_LEFT);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpirationYear()
    {
        return $this->expiration_year;
    }

    /**
     * @param mixed $expiration_year
     * @return Card
     */
    public function setExpirationYear($expiration_year)
    {
        $this->expiration_year = (string)$expiration_year;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumberToken()
    {
        return $this->number_token;
    }


    /**
     * @param Token $token
     * @return $this
     */
    public function setNumberToken($numberToken)
    {
        $this->number_token = $numberToken;

        return $this;
    }
    
    public function setBin($bin){
        $this->bin = $bin;
    }
    
    public function getBin(){
        return $this->bin;
    }
            
    function __set($name, $value)
    {
        $this->$name = $value;

        return $this;
    }


}