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
 * Tax rate class
 *
 * @author Nicolas Macherey <nicolas.macherey@gmail.com>
 */
class TaxRate implements TaxRateInterface
{
    /**
     * Get tax rate id
     *
     * @var mixed
     */
    protected $id;

    /**
     * Name of tax rate.
     *
     * @var string
     */
    protected $name;

    /**
     * Tax amount.
     *
     * @var float
     */
    protected $amount = 0;

    /**
     * Are taxes already included in the price ?
     *
     * @var boolean
     */
    protected $includedInPrice = false;

    /**
     * The associated tax model
     *
     * @var TaxModelInterface
     */
    protected $model;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get tax amount.
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Get the amount as percentage.
     *
     * @return float
     */
    public function getAmountAsPercentage()
    {
        return $this->getAmount() * 100.0;
    }

    /**
     * {@inheritdoc}
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isIncludedInPrice()
    {
        return $this->includedInPrice;
    }

    /**
     * {@inheritdoc}
     */
    public function setIncludedInPrice($includedInPrice)
    {
        $this->includedInPrice = $includedInPrice;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTaxModel()
    {
        return $this->model;
    }

    /**
     * {@inheritdoc}
     */
    public function setTaxModel(TaxModelInterface $model)
    {
        $this->model = $model;

        return $this;
    }
}
