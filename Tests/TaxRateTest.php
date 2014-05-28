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
use UCS\Component\Taxation\TaxRate;

/**
 * Unit Test Suite for TaxRate
 *
 * @author Nicolas Macherey (nicolas.macherey@gmail.com)
 */
class TaxRateTest extends \PHPUnit_Framework_TestCase
{
    protected $instance;
    
    protected function setup() {
        $this->instance = new TaxRate();
    }
    
    public function testName() {
        $this->assertNull($this->instance->getName());

        $value = 'name';
        $this->instance->setName($value);
        $this->assertEquals($value, $this->instance->getName());
    }
    
    public function testAmount() {
        $this->assertEquals(0,$this->instance->getAmount(),
          '->getAmount() tax rate must be initialized to 0');

        $value = 0.196;
        $this->instance->setAmount($value);
        $this->assertEquals($value, $this->instance->getAmount());
        $this->assertEquals($value*100, $this->instance->getAmountAsPercentage());
    }
    
    public function testIncludedInPrice() {
        $this->assertFalse($this->instance->isIncludedInPrice());

        $value = true;
        $this->instance->setIncludedInPrice($value);
        $this->assertEquals($value, $this->instance->isIncludedInPrice());
    }
    
    public function testTaxModel() {
        $this->assertNull($this->instance->getTaxModel());

        $value = $this->getMock('UCS\Component\Taxation\TaxModelInterface');
        $this->instance->setTaxModel($value);
        $this->assertEquals($value, $this->instance->getTaxModel());
    }
}
