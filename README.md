# UCS Taxation Component

The UCS Taxation Component makes it possible to handle taxation models and
associated tax rates. A TaxModel is a concept that can be associated
to another concept and represents the type of tax being applied
to this concept. Before being known, the tax rate must be resolved
using a TaxRateResolverInterface implementation. This means that the
definitive tax rate can only be known on some business parameters that
are not known by the component itself.

The tax rate may be statically computed or dynamically determined
by your application, for example by using the country of the currently logged-in
user.

## Installation

The component is available via composer with the following command:

    composer require ucs/taxation

# Basic usage

## Implementing a TaxRateResolver

The first thing to do is to create a TaxRateResolver that implements the base
TaxRateResolverInterface class:

    <?php

    namespace Demo;

    use UCS\Component\Taxation\TaxModelAwareInterface;
    use UCS\Component\Taxation\TaxRateInterface;
    use UCS\Component\Taxation\Resolver\TaxRateResolverInterface;

    /**
     * Constant TaxRate resolver
     */
    class ConstantTaxRateResolver implements TaxRateREsolverInterface
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

A TaxRateAware or Taxable object must implement the "getTaxModel" and "setModel"
method. Only a Taxable object can provide the application with the
tax model applied to the Taxable object.

Once created, you can use your brand new resolver to retrieve the proper
tax rate on your TaxModelAware instances by using the following snippet:

    <?php

    $resolver = new \Demo\ConstantTaxRateResolver(20, ['vat' => 20,]);
    $calculationStrategy = new \UCS\Component\Taxation\Strategy\DefaultCalculationStrategy();

    // $taxable = ;// implement your logic here

    $taxRate = $resolver->resolve($taxable);
    $taxValue = $calculationStrategy->compute($taxable->getPrice(), $taxRate);

## Implementing your own calculation strategy

The UCS Taxation Component is bundled with a default calculation strategy that can
deduce the tax value from a price. If the tax value is already included into the
price it will extract it from the given price parameter. In any other case, the price
is considered to be tax-free. You can implement your own strategy by implementing the
TaxCalculationStrategyInterface:

    <?php

    namespace Demo;

    /* Imports */
    use UCS\Component\Taxation\TaxRateInterface;
    use UCS\Component\Taxation\TaxCalculationStrategyInterface;

    /**
     * compute the tax part of the given price
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

# Tests

## Running the unit test suite

You can run the unit tests with the following command:

    $ cd path/to/UCS/Component/Taxation/
    $ composer.phar install
    $ phpunit
