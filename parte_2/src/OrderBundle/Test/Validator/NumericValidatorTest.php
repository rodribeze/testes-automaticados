<?php

namespace OrderBundle\Validators\Test;

use OrderBundle\Validators\NumericValidator;
use PHPUnit\Framework\TestCase;

class NumericValidatorTest extends TestCase
{

    /**
     * @test
     * @dataProvider valueProvider
     */
    public function isValid($value, $extectedResult)
    {

        $numericValidator = new NumericValidator($value);

        $isValid = $numericValidator->isValid();
        $this->assertEquals($extectedResult, $isValid);
    }

    public function valueProvider()
    {
        return [
            // oque testa testando? Valid = se é válido
            // ciscuntancias? Value is A Bumber = Deve ser numero
            // Resultado esperado? sholdBeValid = Deve ser valido
            "isValid_isANumber_TRUE" => [
                "value" => 2,
                "expectedResult" => true
            ],
            // oque testa testando? Valid = se é válido
            // ciscuntancias? Value is A Bumber = Deve ser numero em string
            // Resultado esperado? sholdBeValid = Deve ser valido
            "isValid_isANumberString_TRUE" => [
                "value" => "2",
                "expectedResult" => true
            ],
            // oque testa testando? Valid = se não é válido
            // ciscuntancias? Value is A Bumber = Não de ser numero
            // Resultado esperado? sholdBeValid = Deve ser inválido
            "isValid_isNotANumber_FALSE" => [
                "value" => "bla",
                "expectedResult" => false
            ]
        ];
    }
}
