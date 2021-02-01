<?php

namespace OrderBundle\Validators\Test;

use OrderBundle\Validators\CreditCardNumberValidator;
use PHPUnit\Framework\TestCase;

class CreditCardNumberValidatorTest extends TestCase
{

    /**
     * @test
     * @dataProvider valueProvider
     */
    public function isValid($value, $expectedResult)
    {

        $creditCardNumber = new CreditCardNumberValidator($value);

        $isValid = $creditCardNumber->isValid();

        $this->assertEquals($expectedResult, $isValid);
    }

    public function valueProvider()
    {
        return [
            "isValid_validCard_TRUE" => [
                "value" => "5567791211904626",
                "expectedResult" => true
            ],
            "isValid_notValidCard_FALSE" => [
                "value" => "foo",
                "expectedResult" => false
            ],
            "isValid_emptyNumberCard_FALSE" => [
                "value" => "",
                "expectedResult" => false
            ]
        ];
    }
}
