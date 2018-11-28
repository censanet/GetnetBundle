<?php

namespace Censanet\GetnetBundle\Getnet;

/**
 * Description of Response
 *
 * @author tjamancio
 */
class Response {
    private $status;
    private $statusCode;
    private $data;
    
    public function __construct($statusCode, $data) {
        $this->status = $statusCode >= 400 ? false : true;
        $this->statusCode = $statusCode;
        $this->data = $data;
    }
    
    function getStatus() {
        return $this->status;
    }

    function getStatusCode() {
        return $this->statusCode;
    }

    function getData() {
        return $this->data;
    }


}
