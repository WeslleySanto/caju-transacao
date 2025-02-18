<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mcc extends Model
{

    const FOOD = ['5411', '5412'];
    const MEAL = ['5811', '5812'];

    /**
     * Get Category by MCC
     *
     * @param [type] $mcc
     * @return void
     * @covers tests/Unit/MccTest@test_get_and_return_string
     */
    public function get($mcc)
    {
        if (in_array($mcc, self::FOOD)) return Category::FOOD;

        if (in_array($mcc, self::MEAL)) return Category::MEAL;

        return Category::CASH;
    }
}
