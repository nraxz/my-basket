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
                new Product('FR1', 'Forest Tea', 3.11),
                new Product('SR1', 'Strawberries', 5.0),
                new Product('CF1', 'Coffee', 11.23)
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
        $this->scan('SR1');
        $this->scan('SR1');
        $this->total()->shouldReturn(10);
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