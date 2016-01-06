<?php

namespace CompanyBundle\Form\Transformer;

use SebastianBergmann\Money\Currency;
use SebastianBergmann\Money\Money;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;


class MoneyTransformer implements DataTransformerInterface
{
    public function transform($freight)
    {
        return $freight->getPrice()->getAmount()/100;
    }

    public function reverseTransform($amount)
    {
        return new Money($amount * 100, new Currency('PLN'));
    }
}