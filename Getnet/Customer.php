<?php
namespace Censanet\GetnetBundle\Getnet;


/**
 * Class Customer
 * @package Getnet\API
 */
class Customer implements \JsonSerializable
{
    private $customer_id;
    
    
    function __construct($customer_id) {
        $this->customer_id = (string)$customer_id;
    }

    
    function getSellerId() {
        return $this->seller_id;
    }

    function setSellerId($seller_id) {
        $this->seller_id = $seller_id;
    }

        

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    function __set($name, $value)
    {
        $this->$name = $value;

        return $this;
    }

    /**
     * @param $id
     * @return Address
     */
    public function BillingAddress()
    {
        $this->billing_address = new Address();

        return $this->billing_address;
    }

    /**
     * @param $id
     * @return Address
     */
    public function ShippingAddress($id)
    {
        $this->address = new Address($id);

        return $this->address;
    }

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param mixed $customer
     * @return Customer
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillingAddress()
    {
        return $this->billing_address;
    }

    /**
     * @param mixed $billing_address
     * @return Customer
     */
    public function setBillingAddress($billing_address)
    {
        $this->billing_address = $billing_address;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->customer_id;
    }

    /**
     * @param mixed $customer_id
     * @return Customer
     */
    public function setCustomerId($customer_id)
    {
        $this->customer_id = (string)$customer_id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDocumentNumber()
    {
        return $this->document_number;
    }

    /**
     * @param mixed $document_number
     * @return Customer
     */
    public function setDocumentNumber($document_number)
    {
        $this->document_number = (string)$document_number;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDocumentType()
    {
        return $this->document_type;
    }

    /**
     * @param mixed $document_type
     * @return Customer
     */
    public function setDocumentType($document_type)
    {
        $this->document_type = $document_type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return Customer
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     * @return Customer
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     * @return Customer
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * @param mixed $phone_number
     * @return Customer
     */
    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;

        return $this;
    }
    
    public function mapperJson($json) {

        array_walk_recursive($json, function ($value, $key) {

            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        });

        //$this->setResponseJSON($json);

        return $this;
    }
    
    public function toJSON()
    {

        return json_encode(get_object_vars($this), JSON_PRETTY_PRINT);

    }


}