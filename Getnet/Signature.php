<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Censanet\GetnetBundle\Getnet;

/**
 * Description of Signature
 *
 * @author tjamancio
 */
class Signature {
    
    private $seller_id;
    private $customer_id;
    private $plan_id;
    private $order_id;
    
    private $subscription;
    
    
    
    public function Subscription()
    {
        $subscription = new Subscription();
        $this->setSubscription($subscription);

        return $subscription;
    }
    
    public function Device($fingerprint)
    {
        $device = new Device($fingerprint);
        $this->device = $device;

        return $device;
    }
            
    function getSellerId() {
        return $this->seller_id;
    }

    function getCustomerId() {
        return $this->customer_id;
    }

    function getPlanId() {
        return $this->plan_id;
    }

    function getOrderId() {
        return $this->order_id;
    }

    function getSubscription() {
        return $this->subscription;
    }

    function getDevice() {
        return $this->device;
    }

    function setSellerId($seller_id) {
        $this->seller_id = $seller_id;
    }

    function setCustomerId($customer_id) {
        $this->customer_id = $customer_id;
    }

    function setPlanId($plan_id) {
        $this->plan_id = $plan_id;
    }

    function setOrderId($order_id) {
        $this->order_id = (string)$order_id;
    }

    function setSubscription($subscription) {
        $this->subscription = $subscription;
    }

    function setDevice($device) {
        $this->device = $device;
    }
    
    public function toJSON()
    {

        return json_encode(get_object_vars($this), JSON_PRETTY_PRINT);

    }

}
