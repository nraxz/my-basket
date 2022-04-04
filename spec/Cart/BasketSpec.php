<?php

namespace spec\Cart;

use Cart\Basket;
use Cart\Product;
use Cart\Catalog;
use PhpSpec\ObjectBehavior;

class BasketSpec extends ObjectBehavior
{
    function let()
    {

        $this->beConstructWith(
            new Catalog([
                new Product('FR1', 'Forest Tea', 3.11, function ($volume, $price)
                {
                    return (floor($volume / 2)  + ($volume % 2) )* $price;

                }),
                new Product('SR1', 'Strawberries', 5.0, function ($volume, $price)
                {
                    if($volume >= 3)
                    {
                        return $volume * ($price * 0.9);
                    }
                    else{

                        return $volume * $price;
                    }
                }),
                new Product('CF1', 'Coffee', 11.23, function ($volume, $price)
                {
                    return $volume * $price;
                })
            ])
        );      
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Basket::class);
    }

    function it_calculates_the_total_of_a_scanned_product()
    {
        $this->scan('FR1');
        $this->total()->shouldReturn(3.11);
    }

    function it_calculates_the_total_of_product_with_buy_one_get_one()
    {
        $this->scan('FR1');
        $this->scan('FR1');
        $this->scan('FR1');
        $this->total()->shouldReturn(6.22);
    }

    function it_calculates_the_total_of_product_that_was_scanned_twice()
    {
        $this->scan('CF1');
        $this->scan('CF1');
        $this->total()->shouldReturn(22.46);
    }

    function it_calculates_the_total_of_all_scanne_products(){
        $this->scan('FR1');
        $this->scan('SR1');
        $this->scan('FR1');
        $this->scan('FR1');
        $this->scan('CF1');
        $this->total()->shouldReturn(22.45);

    }

    function it_calculates_the_total_of_bulk_buy(){
        $this->scan('FR1');
        $this->scan('SR1');
        $this->scan('FR1');
        $this->scan('SR1');
        $this->scan('SR1');
        $this->total()->shouldReturn(16.61);

    }
}