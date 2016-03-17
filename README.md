# Taxation Component

With the Taxation component its possible to handle taxation models and
associated tax rates. A TaxModel is a concept that can be associated
to an other concept and that represents the type of tax being applied
on this concept. Before being known, the tax rate must be resolved
using a TaxRateResolverInterface implementation. Which means that the
definitive tax rate can only be known on some business parameters that
are not known by the component itself.

The tax rate may be statically computed or dynamically determined
by your application for example by using the currently logged-in
user's country.

## Installation

The component can easily be installed by using composer:

    composer require ucs/taxation

## Usage

The first to do is to create a TaxRateResolver that implements the base
TaxRateResolverInterface class:

    <?php

    namespace Demo;

    use UCS\Component\Taxation\TaxModelAwareInterface;
    use UCS\Component\Taxation\TaxRateInterface;
    use UCS\Component\Taxation\Resolver\TaxRateResolverInterface;

    /**
     * Constant TaxRate resolver
     */
    class ConstatntTaxRateResolver implements TaxRateREsolverInterface
    {
        /**
         * @var float
         */
        private $defaultTaxRate;

        /**
         * @var float[]
         */
        private $taxRates;

        /**
         * @param float $defaultTaxRate
         * @param array $taxRates
         */
        public function __contruct($defaultTaxRate, array $taxRates = [])
        {
            $this->defaultTaxRate = $taxRate;
            $this->taxRates = $taxRates;
        }

        /**
         * {@inheritdoc}
         */
        public function resolver(TaxModelAwareInterface $taxable)
        {
            $modelName = $taxRate->getModel() ? $taxRate->getModel()->getName() : 'default';

            return isset($this->taxRates[$model]) ? $this->taxRates[$model] : $defaultTaxRate;
        }
    }

Any TaxRateAware or taxable objects must implement the "getTaxModel" and "setModel"
method. The taxable is the only concept able to provide the application with the
tax model applied to the taxable concept.

Once created you can use your brand new resolver to retrieve the proper
tax rate on your TaxModelAware instances by using the following snippet:

    <?php

    $resolver = new \Demo\ConstantTaxRateResolver(20, ['vat' => 20,]);
    $calculationStrategy = new \UCS\Component\Taxation\Strategy\DefaultCalculationStrategy();

    // $taxable = ;// implement your logic here

    $taxRate = $resolver->resolve($taxable);
    $taxValue = $calculationStrategy->compute($taxable->getPrice(), $taxRate);

## Implementing your own calculation strategy

UCS Taxation component is bundled with a default calculation strategy that is able
to deduce the tax value from a price. If the tax value is already included into the
price it will extract it from the given price parameter. In any other case the price
is considered tax free. You can implement your own strategy by implementing the
TaxCalculationStrategyInterface:

    <?php

    namespace Demo;

    /* Imports */
    use UCS\Component\Taxation\TaxRateInterface;
    use UCS\Component\Taxation\TaxCalculationStrategyInterface;

    /**
     * Compute tax part of the given price
     */
    class CustomTaxCalculationStrategy implements TaxCalculationStrategyInterface
    {
        /**
         * {@inheritdoc}
         */
        public function compute($price, TaxRateInterface $taxRate)
        {
            if ($taxRate->isIncludedInPrice()) {
                return $price - round($price / (1 + $taxRate->getAmount()), 2);
            }

            return round($price * $taxRate->getAmount(), 2);
        }
    }

## Running the unit test suite

You can run the unit tests with the following command:

    $ cd path/to/UCS/Component/Taxation/
    $ composer.phar install
    $ phpunit
