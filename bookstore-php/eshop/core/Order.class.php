<?php
class Order {
    public $customer;
    public $email;
    public $phone;
    public $address;
    public $id;
    public $created;
    public $items;

    public function __construct($customer, $email, $phone, $address, $items = []) {
        $this->customer = $customer;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->items = $items;
        $this->created = date('Y-m-d H:i:s');
    }
}
