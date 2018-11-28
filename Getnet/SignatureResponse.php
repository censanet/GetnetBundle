<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Censanet\GetnetBundle\Getnet;

/**
 * Description of SignatureResponse
 *
 * @author tjamancio
 */
class SignatureResponse{
    private $seller_id;
    private $order_id;
    
    private $subscription;
    private $device;
    
    private $create_date;
    private $end_date;
    private $payment_date;
    private $next_scheduled_date;
    private $customer;
    private $plan;
    private $status;
    
    function getSellerId() {
        return $this->seller_id;
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

    function getCreateDate() {
        return $this->create_date;
    }

    function getEndDate() {
        return $this->end_date;
    }

    function getPaymentDate() {
        return $this->payment_date;
    }

    function getNextScheduledDate() {
        return $this->next_scheduled_date;
    }

    function getCustomer() {
        return $this->customer;
    }

    function getPlan() {
        return $this->plan;
    }

    function getStatus() {
        return $this->status;
    }
    
    public function mapperJson($json) {

        array_walk_recursive($json, function ($value, $key) {

            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        });

        return $this;
    }


}
