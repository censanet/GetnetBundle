<?php
namespace Censanet\GetnetBundle\Getnet;


/**
 * Class Card
 * @package Getnet\API
 */
class CardStorage extends Card
{  
    
    private $customer_id;
    
    private $cardholder_identification;
    private $verify_card = 'false';      
    
    
    function getCustomerId() {
        return $this->customer_id;
    }

    function getCardholderIdentification() {
        return $this->cardholder_identification;
    }

    function getVerifyCard() {
        return $this->verify_card;
    }

    function setCustomerId($customer_id) {
        $this->customer_id = $customer_id;
    }

    function setCardholderIdentification($cardholder_identification) {
        $this->cardholder_identification = $cardholder_identification;
    }

    function setVerifyCard($verify_card) {
        $this->verify_card = $verify_card;
    }
    
    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}