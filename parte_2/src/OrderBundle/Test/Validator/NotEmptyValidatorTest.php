<?php

namespace OrderBundle\Validators\Test;

use OrderBundle\Validators\NotEmptyValidator;
use PHPUnit\Framework\TestCase;

class NotEmptyValidatorTest extends TestCase
{

    /**
     * @test
     * @dataProvider valueProvider
     */
    public function isValid($value, $extectedResult)
    {

        $notEmptyValidator = new NotEmptyValidator($value);

        $isValid = $notEmptyValidator->isValid();
        $this->assertEquals($extectedResult, $isValid);
    }

    public function valueProvider()
    {
        return [
            "shouldBeValidWhenValueIsNotEmpty" => [
                "value" => "foo",
                "expectedResult" => true
            ],
            "shouldNotBeValidWhenValueIsEmpty" => [
                "value" => "",
                "expectedResult" => false
            ]
        ];
    }
}
