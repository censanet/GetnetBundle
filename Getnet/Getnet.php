<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Censanet\GetnetBundle\Getnet;

/**
 * Description of Getnet
 *
 * @author tjamancio
 */
class Getnet {

    private $env;
    private $clientId;
    private $clientSecret;
    private $sellerId;
    private $accessToken;
    private $debug;
    private $validate;

    public function __construct($container) {
        $parameters = $container->getParameter('getnet');

        $this->env = $parameters['environment'];

        $this->clientId = $parameters['client_id'];
        $this->clientSecret = $parameters['client_secret'];
        $this->sellerId = $parameters['seller_id'];
        $this->debug = $parameters['debug'];

        return $this->auth();
    }

    public function auth() {
        $request = new Request($this);

        return $request->auth($this);
    }

    public function debug($value) {
        if ($this->debug) {
            echo "<pre>";
            if (!(is_array($value) or is_object($value))) {
                echo $value;
            } else {
                print_r($value);
            }
            echo "</pre>";
        }
    }

    function getEnv() {
        return $this->env;
    }

    function getClientId() {
        return $this->clientId;
    }

    function getClientSecret() {
        return $this->clientSecret;
    }

    function getSellerId() {
        return $this->sellerId;
    }

    function getAccessToken() {
        return $this->accessToken;
    }

    function getDebug() {
        return $this->debug;
    }

    function setEnv($env) {
        $this->env = $env;
    }

    function setClientId($clientId) {
        $this->clientId = $clientId;
    }

    function setClientSecret($clientSecret) {
        $this->clientSecret = $clientSecret;
    }

    function setSellerId($sellerId) {
        $this->sellerId = $sellerId;
    }

    function setAccessToken($accessToken) {
        $this->accessToken = $accessToken;
    }

    function setDebug($debug) {
        $this->debug = $debug;
    }
    
    function getValidate() {
        return $this->validate;
    }

    function setValidate($validate) {
        $this->validate = $validate;
    }

    
    public function generateNumberToken(Token $token) {
        $data = array("card_number" => $token->getCardNumber(), "customer_id" => $token->getCustomerId());

        $request = new Request($this);
        $response = $request->post($this, "/v1/tokens/card", json_encode($data));
        $token->setNumberToken($response["number_token"]);
        return $response;
    }

    function getCustomer($customerId) {
        $request = new Request($this);
        return $request->get($this, "/v1/customers/$customerId");
    }

    public function newCustomer(Customer $customer) {
        $customer->setSellerId($this->getSellerId());
        $request = new Request($this);
        return $request->post($this, "/v1/customers", $customer->toJSON());
    }

    public function saveCard(CardStorage $card) {
        $request = new Request($this);
        return $request->post($this, "/v1/cards", json_encode($card->jsonSerialize()));
    }

    public function getCard($cardId) {
        $request = new Request($this);
        return $request->get($this, "/v1/cards/$cardId");
    }
    
    public function getCards() {
        $request = new Request($this);
        return $request->get($this, "/v1/cards?customer_id=3");
    }

    public function authorize(Transaction $transaction) {
        $transaction->setSellerId($this->getSellerId());
        $request = new Request($this);
        return $request->post($this, "/v1/payments/credit", $transaction->toJSON());
    }
    
    public function cancelCreditPayment($paymentId) {
        $request = new Request($this);
        return $request->post($this, "/v1/payments/credit/$paymentId/cancel");
    }

	public function authorizeDebit(Transaction $transaction) {
        $transaction->setSellerId($this->getSellerId());
        $request = new Request($this);
        return $request->post($this, "/v1/payments/debit", $transaction->toJSON());
    }

}
