<?php

namespace OrderBundle\Test\Service;

use OrderBundle\Service\BadWordsValidator;
use OrderBundle\Repository\BadWordsRepository;

use PHPUnit\Framework\TestCase;

class BadWordsValidatorTest extends TestCase
{
    /**
     * @test
     * @dataProvider valueProvider
     */
    public function hasBadWords($badwords,$value, $expectedResult)
    {

        $badWordsRepository = $this->createMock(BadWordsRepository::class);
        $badWordsRepository->method("findAllAsArray")
            ->willReturn($badwords);

        $badWordsValidator = new BadWordsValidator($badWordsRepository);
        $hasBadWords = $badWordsValidator->hasBadWords($value);

        $this->assertEquals($expectedResult, $hasBadWords);
    }

    public function valueProvider()
    {
        return [
            "hasBadWords_valueNotContainsBadWord_FALSE" => [
                'badWordList' => ['bobo', 'besta', 'trouxa'],
                "value" => "ola quero mais queijo",
                "expectedResult" => false
            ],
            "hasBadWords_valueContainsBadWord_TRUE" => [
                'badWordList' => ['bobo', 'besta', 'trouxa'],
                "value" => "restaurante bobo",
                "expectedResult" => true
            ],
            "hasBadWords_valueEmpty_FALSE" => [
                'badWordList' => [],
                "value" => "",
                "expectedResult" => false
            ],
            "hasBadWords_valueContainsBadWordOnListEmpty_FALSE" => [
                'badWordList' => [],
                "value" => "",
                "expectedResult" => false
            ]
        ];
    }
}
