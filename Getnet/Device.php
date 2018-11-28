<?php
namespace Censanet\GetnetBundle\Getnet;


class Device implements \JsonSerializable
{
    private $device_id;
    private $ip_address;

    /**
     * Device constructor.
     * @param $device_id
     */
    public function __construct($device_id)
    {
        $this->device_id = $device_id;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    /**
     * @return mixed
     */
    public function getDeviceId()
    {
        return $this->device_id;
    }

    /**
     * @param mixed $device_id
     * @return Device
     */
    public function setDeviceId($device_id)
    {
        $this->device_id = $device_id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIpAddress()
    {
        return $this->ip_address;
    }

    /**
     * @param mixed $ip_address
     * @return Device
     */
    public function setIpAddress($ip_address)
    {
        $this->ip_address = $ip_address;

        return $this;
    }


}