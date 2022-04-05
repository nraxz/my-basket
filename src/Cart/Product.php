<?php

namespace Cart;

class Product
{
    public function __construct($productCode, $name, $price)
    {
        $this->productCode = $productCode;
        $this->name = $name;
        $this->price = $price;
       
    }

    public function productCode()
    {
        return $this->productCode;
    }

    public function name()
    {
        return $this->name;
    }

    public function price()
    {
        return $this->price;
    }
}
