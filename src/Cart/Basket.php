<?php

namespace Cart;

class Basket
{
    private $catalog;
    private $products = [];

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

    public function total()
    {
        return array_reduce(array_keys($this->products), function($total, $productCode) {
            $product = $this->catalog->find($productCode);
            return $total += $product->total($this->products[$productCode]);
        }, 0);
    }
}
