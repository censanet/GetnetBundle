<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Censanet\GetnetBundle\Getnet;

/**
 * Description of Period
 *
 * @author tjamancio
 */
class Period implements \JsonSerializable{
    private $type;
    private $billing_cycle;
    private $specific_cycle_in_days = 0;
    
    function getType() {
        return $this->type;
    }

    function getBillingCycle() {
        return $this->billing_cycle;
    }

    function getSpecificCycleInDays() {
        return $this->specific_cycle_in_days;
    }

    function setType($type) {
        $this->type = $type;
        return $this;
    }

    function setBillingCycle($billing_cycle) {
        $this->billing_cycle = $billing_cycle;
        return $this;
    }

    function setSpecificCycleInDays($specific_cycle_in_days) {
        $this->specific_cycle_in_days = $specific_cycle_in_days;
        return $this;
    }
    
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }


}
