<?php

namespace Censanet\GetnetBundle\Getnet;

class Debit extends Credit
{
    /**
     * @return mixed
     */
    public function getCardholderMobile()
    {
        return $this->cardholder_mobile;
    }

    /**
     * @param mixed $cardholder_mobile
     * @return Card
     */
    public function setCardholderMobile($cardholder_mobile)
    {
        $this->cardholder_mobile = $cardholder_mobile;

        return $this;
    } 
    
}

