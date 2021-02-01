<?php

namespace OrderBundle\Validators\Test;

use PHPUnit\Framework\TestCase;
use OrderBundle\Entity\Customer;

class CustomerTest extends TestCase
{

    /**
     * @test
     * @dataProvider valueProvider
     */
    public function isAllowedToOrder($isActive, $isBlocked, $expectedResult)
    {

        $costumer = new Customer($isActive, $isBlocked, "Rodrigo", "11977701010");

        $isAllowed = $costumer->isAllowedToOrder();
        $this->assertEquals($expectedResult, $isAllowed);
    }

    public function valueProvider()
    {

        return [
            'AllowedToOrder_CustomerAllowedOnActiveAndNotBlocked_TRUE' => [
                'isActive' => true,
                'isBlocked' => false,
                'expectedValue' => true
            ],
            'AllowedToOrder_CustomerAllowedOnActiveAndBlocked_FALSE' => [
                'isActive' => true,
                'isBlocked' => true,
                'expectedValue' => false
            ],
            'AllowedToOrder_CustomerNotAllowedOnNotActiveAndNotBlocked_FALSE' => [
                'isActive' => false,
                'isBlocked' => false,
                'expectedValue' => false
            ],
            'AllowedToOrder_CustomerNotAllowedOnNotActiveAndAndBlocked_FALSE' => [
                'isActive' => false,
                'isBlocked' => true,
                'expectedValue' => false
            ]
        ];
    }
}
