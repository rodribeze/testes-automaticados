<?php

namespace FidelityProgramBundle\Test\Service;

use FidelityProgramBundle\Repository\PointsRepository;
use FidelityProgramBundle\Service\FidelityProgramService;
use FidelityProgramBundle\Service\PointsCalculator;
use MyFramework\LoggerInterface;
use OrderBundle\Entity\Customer;
use PHPUnit\Framework\TestCase;

class FidelityProgramServiceTest extends TestCase
{

    /**
     * @test
     */
    public function shouldSaveWhenReceivePoints()
    {

        $pointsCalculator = $this->createMock(PointsCalculator::class);
        $pointsCalculator->method("calculatePointsToReceive")
            ->willReturn(100);

        $pointsRepository = $this->createMock(PointsRepository::class);
        $pointsRepository->expects($this->once())
            ->method("save");

        $allMessage = [];

        $logger = $this->createMock(LoggerInterface::class);
        $logger->method('log')
            ->will($this->returnCallback(function($message) use(&$allMessage){
                $allMessage[] = $message;
            }));

        $customer = $this->createMock(Customer::class);

        $fidelityProgramService = new FidelityProgramService($pointsRepository, $pointsCalculator, $logger);
        $fidelityProgramService->addPoints($customer, 50);

        $xpectedMessages = [
            'Checking points for customer',
            'Customer received points'
        ];
        $this->assertEquals($xpectedMessages,$allMessage);

    }

    /**
     * @test
     */
    public function shouldSNotaveWhenReceiveZeroPoints()
    {

        $pointsCalculator = $this->createMock(PointsCalculator::class);
        $pointsCalculator->method("calculatePointsToReceive")
            ->willReturn(0);

        $pointsRepository = $this->createMock(PointsRepository::class);
        $pointsRepository->expects($this->never())
            ->method("save");

        $logger = $this->createMock(LoggerInterface::class);
        $customer = $this->createMock(Customer::class);

        $fidelityProgramService = new FidelityProgramService($pointsRepository, $pointsCalculator, $logger);
        $fidelityProgramService->addPoints($customer, 30);


    }
}
