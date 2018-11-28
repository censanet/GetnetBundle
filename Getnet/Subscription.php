<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Censanet\GetnetBundle\Getnet;

/**
 * Description of Subscription
 *
 * @author tjamancio
 */
class Subscription implements \JsonSerializable {
    //put your code here
    
    private $payment_type;
    
    public function PaymentType()
    {
        $paymentType = new PaymentType();
        $this->setPaymentType($paymentType);

        return $paymentType;
    }
    
    function getPaymentType() {
        return $this->payment_type;
    }

    function setPaymentType($payment) {
        $this->payment_type = $payment;
    }
    
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }


}
