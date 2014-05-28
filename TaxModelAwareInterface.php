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
 * Simple class that can be linked to a tax model
 *
 * @author Nicolas Macherey (nicolas.macherey@gmail.com)
 */
interface TaxModelAwareInterface
{
    /**
     * @return TaxModelInterface
     */
    public function getTaxModel();
    
    /**
     * @param TaxModelInterface $taxModel
     */
    public function setTaxModel(TaxModelInterface $taxModel);
}
