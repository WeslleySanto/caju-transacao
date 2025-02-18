<?php

namespace Tests\Unit;

use App\Models\Mcc;
use App\Models\Category;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\DataProvider;

class MccTest extends TestCase
{
    #[DataProvider('getProvider')]
    public function test_get_and_return_string($data)
    {
        $result = resolve(Mcc::class)->get($data['mcc']);

        $this->assertEquals($data['expected'], $result);
        $this->assertIsString($result);
    }

    public static function getProvider()
    {
        return [
            'food with mcc 5411' => [
                [
                    'mcc' => 5411,
                    'expected' => Category::FOOD,
                ]
            ],
            'food with mcc 5412' => [
                [
                    'mcc' => 5412,
                    'expected' => Category::FOOD,
                ]
            ],
            'meal with mcc 5811' => [
                [
                    'mcc' => 5811,
                    'expected' => Category::MEAL,
                ]
            ],
            'meal with mcc 5812' => [
                [
                    'mcc' => 5812,
                    'expected' => Category::MEAL,
                ]
            ],
            'cash with another mcc 1111' => [
                [
                    'mcc' => 1111,
                    'expected' => Category::CASH,
                ]
            ],
            
        ];
    }
}
