<?php

namespace Ten24\Tests\Component\Form\Extension\DataTransformer;

use Ten24\Component\Form\Extension\DataTransformer\PhoneNumberViewTransformer;

class PhoneNumberViewTransformerTest extends \PHPUnit_Framework_TestCase
{
    public function testTransform()
    {
        $pn = '+111234567890';
        $f = new PhoneNumberViewTransformer();
        $formatted = $f->transform($pn);
        $this->assertEquals('+11 (123) 456-7890', $formatted);
    }

    public function testReverseTransform()
    {
        $pn = '+(11) 123-456-7890';
        $f = new PhoneNumberViewTransformer();
        $formatted = $f->reverseTransform($pn);
        $this->assertEquals('+111234567890', $formatted);
    }
}