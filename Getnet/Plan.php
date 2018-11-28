<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Censanet\GetnetBundle\Getnet;

/**
 * Description of Plan
 *
 * @author tjamancio
 */
class Plan {
    
   
    private $plan_id;
    private $name;
    private $description;
    private $amount;
    private $currency;
    private $payment_types = ['credit_card'];
    private $sales_tax = 0;
    private $product_type;
    private $create_date;
    private $status;


    private $period;

    public function Period() {
        $period = new Period();
        $this->setPeriod($period);
        return $period;
    }
    
    /**
     * @return string
     */
    public function toJSON()
    {

        return json_encode(get_object_vars($this), JSON_PRETTY_PRINT);

    }
    
    public function mapperJson($json) {

        array_walk_recursive($json, function ($value, $key) {
            echo "$key => $value <br />";

            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        });

        //$this->setResponseJSON($json);

        return $this;
    }

    public function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function getAmount() {
        return $this->amount;
    }

    function getCurrency() {
        return $this->currency;
    }

    function getPaymentTypes() {
        return $this->payment_types;
    }

    function getSalesTax() {
        return $this->sales_tax;
    }

    function getProductType() {
        return $this->product_type;
    }

    function getPeriod() {
        return $this->period;
    }
    
    function getPlanId() {
        return $this->plan_id;
    }

    function getCreateDate() {
        return $this->create_date;
    }

    function getStatus() {
        return $this->status;
    }

    function setSellerId($seller_id) {
        $this->seller_id = $seller_id;
        return $this;
    }

    function setName($name) {
        $this->name = $name;
        return $this;
    }

    function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    function setAmount($amount) {
        $this->amount = $amount;
        return $this;
    }

    function setCurrency($currency) {
        $this->currency = $currency;
        return $this;
    }

    function setPaymentTypes($payment_types) {
        $this->payment_types = $payment_types;
        return $this;
    }

    function setSalesTax($sales_tax) {
        $this->sales_tax = $sales_tax;
        return $this;
    }

    function setProductType($product_type) {
        $this->product_type = $product_type;
        return $this;
    }

    function setPeriod($period) {
        $this->period = $period;
        return $this;
    }

    function setPlanId($plan_id) {
        $this->plan_id = $plan_id;
        return $this;
    }

    function setCreateDate($create_date) {
        $this->create_date = $create_date;
        return $this;
    }

    function setStatus($status) {
        $this->status = $status;
        return $this;
    }

}
