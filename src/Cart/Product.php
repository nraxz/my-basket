<?php

namespace Cart;

class Product
{
    public function __construct($productCode, $name, $price, $calculator = null)
    {
        $this->productCode = $productCode;
        $this->name = $name;
        $this->price = $price;

        if(! is_null($calculator))
        {
            $this->calculator = $calculator;
            
        }
        else{

            $this->calculator = function($volume, $price)
            {
                return $volume * $price;
            };

        }
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

    public function total($volume)
    {
        return call_user_func($this->calculator, $volume, $this->price);
    }
}
