<?php

namespace Ten24\Tests\Component\Form\Extension\DataTransformer;

use PHPUnit\Framework\TestCase;
use Ten24\Component\Form\Extension\DataTransformer\PostalCodeViewTransformer;

class PostalCodeViewTransformerTest extends TestCase
{
    public function testTransform()
    {
        $postalCode = 'S4p0H0';
        $formatter  = new PostalCodeViewTransformer();
        $this->assertEquals('S4P 0H0', $formatter->transform($postalCode));
    }

    public function testReverseTransform()
    {
        $postalCode = 'S4p 0H0 ';
        $formatter  = new PostalCodeViewTransformer();
        $this->assertEquals('S4P0H0', $formatter->reverseTransform($postalCode));
    }
}