<?php

/*
 * This file is part of the UCS package.
 *
 * Copyright 2014 Nicolas Macherey <nicolas.macherey@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace UCS\Component\Taxation;

/**
 * This simple class is a generic model for resolving applicable tax rates
 * to taxable items.
 *
 * @author Nicolas Macherey <nicolas.macherey@gmail.com>
 */
interface TaxRateResolverInterface
{
    /**
     * Retrieve the proper tax rate to apply for the given taxable item
     *
     * @param TaxModelAwareInterface $taxable
     *
     * @return TaxRateInterface
     */
    public function resolve(TaxModelAwareInterface $taxable);
}
