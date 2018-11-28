<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Censanet\GetnetBundle\Getnet;

/**
 * Description of PaymentType
 *
 * @author tjamancio
 */
class PaymentType implements \JsonSerializable {
    private $credit;
    
    public function Credit()
    {
        $credit = new SignatureCredit();
        $this->setCredit($credit);

        return $credit;
    }
    
    function getCredit() {
        return $this->credit;
    }

    function setCredit($credit) {
        $this->credit = $credit;
    }
    
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
