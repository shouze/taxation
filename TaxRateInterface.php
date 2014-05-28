<?php

/*
 * This file is part of the UCS package.
 *
 * Copyright 2014 Nicolas Macherey (nicolas.macherey@gmail.com)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace UCS\Component\Taxation;

/**
 * Tax rate class
 *
 * @author Nicolas Macherey (nicolas.macherey@gmail.com)
 */
interface TaxRateInterface extends TaxModelAwareInterface
{
    /**
     * @return string
     */
    public function getName();
    
    /**
     * @param string
     */
    public function setName($name);
    
    /**
     * Get tax amount.
     *
     * @return float
     */
    public function getAmount();

    /**
     * Get the amount as percentage.
     *
     * @return float
     */
    public function getAmountAsPercentage();

    /**
     * Set tax amount.
     *
     * @param float $amount
     */
    public function setAmount($amount);

    /**
     * Is included in price?
     *
     * @return Boolean
     */
    public function isIncludedInPrice();

    /**
     * Set as included in price or not.
     *
     * @param Boolean $includedInPrice
     */
    public function setIncludedInPrice($includedInPrice);
}
