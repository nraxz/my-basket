<?php

namespace Cart;

class Basket
{
    private $catalog;
    private $products = [];
    public $total = 0.0;

    public function beConstructWith(Catalog $catalog)
    {
        $this->catalog = $catalog;

    }

    public function scan($productCode)
    {
        $product = $this->catalog->find($productCode);

        if(array_key_exists($product->productCode, $this->products))
        {
            $this->products[$product->productCode]++;

        }
        else{
            $this->products[$product->productCode] = 1;
        }

    }

    public function priceCalForProductbuyOneGetOne($volume, $price)
    {
        return (floor($volume / 2)  + ($volume % 2) )* $price;

    }
    public function priceCalForProductBulkBuyDiscount($volume, $price)
    {
        $a = ($volume * ($price * 0.9));
        $b = ($volume * $price);
        return ($volume >= 3)? $a : $b;

    }    

    public function total(){

        foreach ($this->products as $productCode => $volume)
        {
            
            $product = $this->catalog->find($productCode);
            var_dump($this->$product->price);
           
            switch ($productCode){
                case 'FR1':
                    $this->total += priceCalForProductbuyOneGetOne($volume, $product->price);
                    break;
                case 'SR1':
                    $this->total += priceCalForProductBulkBuyDiscount($volume, $product->price);
                    break;
                case 'CF1':
                    $this->total += $volume * $product->price;
            }
           return $this->$product->price;         
           
        }

    }
    
}
