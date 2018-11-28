<?php
namespace Censanet\GetnetBundle\Getnet;

/**
 * Class Exception
 * @package Getnet\API
 */
class Exception extends \ErrorException
{


    // custom string representation of object
    /**
     * @return string
     */
    public function __toString()
    {
        return "[{$this->code}]: {$this->message}\n";
    }


}