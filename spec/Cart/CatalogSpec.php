<?php

namespace spec\Cart;

use Cart\Catalog;
use Cart\Product;
use PhpSpec\ObjectBehavior;

class CatalogSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith([
            new Product('FR1', 'Forest Tea', 3.11),
            new Product('SR1', 'Straberries', 5.0),
            new Product('CF1', 'Coffee', 11.23)
        ]);

    }
    function it_is_initializable()
    {
        $this->shouldHaveType(Catalog::class);
        
    }

    function it_should_find_a_product_by_product_code()
    {
        $this->find('FR1')->shouldReturnAnInstanceOf(Product::class);
    }
}
