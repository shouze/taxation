<?php

/*
 * This file is part of the UCS package.
 *
 * (c) Nicolas Macherey <nicolas.macherey@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace UCS\Component\Taxation\Tests;

/* imports */
use UCS\Component\Taxation\Strategy\DefaultTaxCalculationStrategy;

/**
 * Unit Test Suite for DefaultTaxCalculationStrategy
 *
 * @author Nicolas Macherey <nicolas.macherey@gmail.com>
 */
class DefaultTaxCaclulationStrategyTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test compute with tax included
     */
    public function testComputeWithTaxIncluded()
    {
        $price = 119.6;
        $taxRate = $this->getMock('UCS\Component\Taxation\TaxRateInterface');

        $taxRate->expects($this->once())
          ->method('isIncludedInPrice')
          ->will($this->returnValue(true));

        $taxRate->expects($this->once())
          ->method('getAmount')
          ->will($this->returnValue(0.196));

        $instance = new DefaultTaxCalculationStrategy();
        $this->assertEquals(19.6, $instance->compute($price, $taxRate));
    }

    /**
     * Test compute with tax not included
     */
    public function testComputeWithTaxNotIncluded()
    {
        $price = 100.0;
        $taxRate = $this->getMock('UCS\Component\Taxation\TaxRateInterface');

        $taxRate->expects($this->once())
          ->method('isIncludedInPrice')
          ->will($this->returnValue(false));

        $taxRate->expects($this->once())
          ->method('getAmount')
          ->will($this->returnValue(0.196));

        $instance = new DefaultTaxCalculationStrategy();
        $this->assertEquals(19.6, $instance->compute($price, $taxRate));
    }
}
