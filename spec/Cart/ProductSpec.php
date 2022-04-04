<?php

namespace spec\Cart;

use Cart\Product;
use PhpSpec\ObjectBehavior;

class ProductSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('FR1', 'Fruit Tea', 3.11);
        $this->shouldHaveType(Product::class);
    }

    function it_has_a_product_code()
    {
        $this->beConstructedWith('FR1', 'Fruit Tea', 3.11);
        $this->productCode()->shouldReturn('FR1');        

    }

    function it_has_a_name()
    {
        $this->beConstructedWith('FR1', 'Fruit Tea', 3.11);
        $this->name()->shouldReturn('Fruit Tea');        

    }

    function it_has_a_price()
    {
        $this->beConstructedWith('FR1', 'Fruit Tea', 3.11);
        $this->price()->shouldReturn(3.11);        

    }

    function it_calculates_a_total_price()
    {
        $this->beConstructedWith('CF1', 'Coffee', 11.23);
        $this->total(3)->shouldReturn(33.69);
    }

    function it_calculates_a_total_price_for_buy_one_get_one_Offer()
    {
        $this->beConstructedWith('FR1', 'Fruit Tea', 3.11, function($volume, $price){
            return (floor($volume / 2) + ($volume % 2)) * $price;
        });

        $this->total(7)->shouldReturn(12.44);
    }

    function it_calculates_a_price_for_bulk_buy_discount()
    {
        $this->beConstructedWith('SR1', 'Strawberries', 5.0, function($volume, $price){
            if($volume >= 3)
            {
                return $volume * ($price * 0.9);
            }
            else{
                return $volume * $price;
            }
        });

    }
}
