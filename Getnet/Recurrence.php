<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Censanet\GetnetBundle\Getnet;

/**
 * Description of Recurrence
 *
 * @author tjamancio
 */
class Recurrence {

    private $getnet;

    public function __construct(Getnet $getnet) {
        $this->getnet = $getnet;
    }

    public function newPlan(Plan $plan) {
        $request = new Request($this->getnet);
        //$plan->setSellerId($this->getSellerId());

        $data = [];
        $data['seller_id'] = $this->getnet->getSellerId();
        $data['name'] = $plan->getName();
        $data['description'] = $plan->getDescription();
        $data['amount'] = $plan->getAmount();
        $data['currency'] = $plan->getCurrency();
        $data['payment_types'] = $plan->getPaymentTypes();
        $data['sales_tax'] = $plan->getSalesTax();
        $data['product_type'] = $plan->getProductType();
        $data['period'] = $plan->getPeriod()->jsonSerialize();

        $response = $request->post($this->getnet, "/v1/plans", json_encode($data));
        $plan->mapperJson($response);
        return $plan;
    }

    private function plans2Obj($plans) {
        foreach ($plans as $key => $item) {
            $plan = new Plan();
            $plan->mapperJson($item);
            $plans[$key] = $plan;
        }
        return $plans;
    }

    public function findPlans($page = 1, $limit = 9999, $sortType = 'asc') {
        $data = ['page' => $page, 'limit' => $limit, 'sort_type' => $sortType];
        $querystring = http_build_query($data);
        $request = new Request($this->getnet);
        $response = $request->get($this->getnet, "/v1/plans?" . $querystring);
        return $response['plans'];
    }

    public function findPlansByName($name, $page = 1, $limit = 9999, $sortType = 'asc') {
        $data = ['name' => $name, 'page' => $page, 'limit' => $limit, 'sort_type' => $sortType];
        $querystring = http_build_query($data);
        $request = new Request($this->getnet);
        $response = $request->get($this->getnet, "/v1/plans?" . $querystring);
        return $response['plans'];
    }

    public function updatePlanStatus($planId, $status) {
//        $data = ['plan_id' => $planId, 'status' => $status];
//        $querystring = http_build_query($data);
        $request = new Request($this->getnet);
        return $request->patch($this->getnet, "/v1/plans/{$planId}/status/$status");
    }

    public function newSignature(Signature $signature) {
        $signature->setSellerId($this->getnet->getSellerId());
        $request = new Request($this->getnet);
        $response = $request->post($this->getnet, "/v1/subscriptions", $signature->toJSON());
        return $response;
    }

    public function getSignature($subscriptionId) {
        $request = new Request($this->getnet);
        return $request->get($this->getnet, "/v1/subscriptions/$subscriptionId");
    }

    public function cancelSignature($subscriptionId, $details) {
        $data = ['seller_id' => $this->getnet->getSellerId(), 'status_details' => $details];
        $request = new Request($this->getnet);
        return $request->post($this->getnet, "/v1/subscriptions/{$subscriptionId}/cancel", json_encode($data));
    }

    public function getSignatureCharges($subscriptonId, $scheduledDate = null, $page = 1, $limit = 9999) {
        $data = ['subscription_id' => $subscriptonId, 'scheduled_date' => $scheduledDate, 'page' => $page, 'limit' => $limit];
        $querystring = http_build_query($data);
        $request = new Request($this->getnet);
        return $request->get($this->getnet, "/v1/charges?" . $querystring);
    }
    
    public function updateSignaturePaymentType($subscriptionId, Card $card){
        $request = new Request($this->getnet);
        $data = $card->jsonSerialize();
        $querystring = http_build_query($data);
        return $request->patch($this->getnet, "/v1/subscriptions/$subscriptionId/paymentType/credit/card", json_encode($data));
    }
    

}
