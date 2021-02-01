<?php

namespace OrderBundle\Validators\Test;

use DateTime;
use OrderBundle\Validators\CreditCardExpirationValidator;
use PHPUnit\Framework\TestCase;

class CreditCardExpirationValidatorTest extends TestCase{

    /**
     * @test
     * @dataProvider valueProvider
     */
    public function isValid($value,$expectedValue){

        $creditCardExpiration = new CreditCardExpirationValidator($value);

        $isValid = $creditCardExpiration->isValid();

        $this->assertEquals($expectedValue,$isValid);

    }

    public function valueProvider(){
        return [
            "isValid_dateIsNotExpirad_TRUE" => [
                "value" => new DateTime("2022-04-01"),
                "expectedValue" => true
            ],
            "isValid_dateIsExpired_FALSE" => [
                "value" => new DateTime('now'),
                "expectedValue" => false
            ]
        ];
    }

}