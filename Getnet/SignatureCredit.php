<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Censanet\GetnetBundle\Getnet;

/**
 * Description of SignatureCredit
 *
 * @author tjamancio
 */
class SignatureCredit implements \JsonSerializable{
    
    private $transaction_type;
    private $number_installments;
    private $soft_descriptor;    
    private $card;
    
    
    public function Card($numberToken)
    {
        $card = new Card($numberToken);
        $this->card = $card;

        return $card;
    }
    
    public function BillingAddress($postalCode)
    {
        $address = new Address($postalCode);
        $this->billing_address = $address;

        return $address;
    }
    
    function getTransactionType() {
        return $this->transaction_type;
    }

    function getNumberInstallments() {
        return $this->number_installments;
    }

    function getSoftDescriptor() {
        return $this->soft_descriptor;
    }

    function getBillingAddress() {
        return $this->billing_address;
    }

    function getCard() {
        return $this->card;
    }

    function setTransactionType($transaction_type) {
        $this->transaction_type = $transaction_type;
        return $this;
    }

    function setNumberInstallments($number_installments) {
        $this->number_installments = $number_installments;
        return $this;
    }

    function setSoftDescriptor($soft_descriptor) {
        $this->soft_descriptor = $soft_descriptor;
        return $this;
    }

    function setBillingAddress($billing_address) {
        $this->billing_address = $billing_address;
        return $this;
    }

    function setCard($card) {
        $this->card = $card;
    }
    
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
    
    function __set($name, $value)
    {
        $this->$name = $value;

        return $this;
    }


}
