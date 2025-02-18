<?php

namespace Tests\Unit;

use App\Models\Account;
use App\Models\Category;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class AccountTest extends TestCase
{
    // @todo debit
    // @todo checkAmount

    #[DataProvider('categoryInArrayProvider')]
    public function test_category_in_array_and_return_bool($data)
    {
        $result = resolve(Account::class)->categoryInArray($data['category']);

        $this->assertEquals($data['expected'], $result);
        $this->assertIsBool($result);
    }

    public static function categoryInArrayProvider()
    {
        return [
            'category food' => [
                [
                    'category' => Category::FOOD,
                    'expected' => true,
                ]
            ],
            'category meal' => [
                [
                    'category' => Category::MEAL,
                    'expected' => true,
                ]
            ],
            'category xpto' => [
                [
                    'category' => 'XTPO',
                    'expected' => false,
                ]
            ],
        ];
    }

    #[DataProvider('amountLessThanAmountAccountProvider')]
    public function test_amount_less_than_amountAccount_and_return_bool($data)
    {
        $result = resolve(Account::class)->amountLessThanAmountAccount(
            $data['amount'], 
            $data['amountAccount']
        );

        $this->assertEquals($data['expected'], $result);
        $this->assertIsBool($result);
    }

    public static function amountLessThanAmountAccountProvider()
    {
        return [
            'less than' => [
                [
                    'amount' => 10,
                    'amountAccount' => 11,
                    'expected' => true,
                ]
            ],
            'equals' => [
                [
                    'amount' => 10,
                    'amountAccount' => 10,
                    'expected' => false,
                ]
            ],
            'more than' => [
                [
                    'amount' => 11,
                    'amountAccount' => 10,
                    'expected' => false,
                ]
            ],
        ];
    }

    // @todo debitAccountCash
}
