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
}
