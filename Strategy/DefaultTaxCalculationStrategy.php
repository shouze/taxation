<?php

/*
 * This file is part of the UCS package.
 *
 * Copyright 2014 Nicolas Macherey (nicolas.macherey@gmail.com)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace UCS\Component\Taxation\Strategy;

/* Imports */
use UCS\Component\Taxation\TaxRateInterface;

/**
 * Compute tax part of the given price
 *
 * @author Nicolas Macherey (nicolas.macherey@gmail.com)
 */
class DefaultTaxCalculationStrategy implements TaxCalculationStrategyInterface
{
    /**
     * Return tax value for the given price
     * 
     * @param float $price
     * @param TaxRateInterface $taxRate
     */
    public function compute($price, TaxRateInterface $taxRate) {
        if ($taxRate->isIncludedInPrice()) {
            return $price - round($price / (1 + $taxRate->getAmount()),2);
        }

        return round($price * $taxRate->getAmount(),2);
    }
}
