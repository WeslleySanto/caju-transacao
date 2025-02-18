<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Account extends Model
{
    use HasFactory;

    protected $fillable = ['food', 'meal', 'cash'];
    protected $account;

    // public function __construct($accountId)
    // {
    //     $this->account = Account::find($accountId);
    // }

    public function debit($request)
    {
        $amount = $request['amount'];
        // @todo validar esse parametro
        $this->account = Account::find($request['accountId']);

        switch ((new Mcc())->get($request['mcc'])) {
            case Category::FOOD:
                $this->checkAmount($amount, $this->account->food, Category::FOOD);
                $this->account->food -= $amount;
                break;
            case Category::MEAL:
                $this->checkAmount($amount, $this->account->meal, Category::MEAL);
                $this->account->meal -= $amount;
                break;
            default:
                $this->debitAccountCash($amount);
                break;
        }

        $this->account->save();
    }

    public function checkAmount($amount, $amountAccount, $category)
    {
        if ($this->amountLessThanAmountAccount($amount, $amountAccount) && $this->categoryInArray($category)) {
            $this->debitAccountCash($amount);
        }
    }

    /**
     * Has a category in Array?
     *
     * @param string $category
     * @return boolean
     * @covers tests/Unit/AccountTest@test_category_in_array_and_return_bool
     */
    public function categoryInArray(string $category): bool
    {
        return in_array($category, [Category::FOOD, Category::MEAL]);
    }

    /**
     * Amount Less THan Amount Account
     *
     * @param float $amount
     * @param float $amountAccount
     * @return boolean
     * @covers tests/Unit/AccountTest@test_amount_less_than_amountAccount_and_return_bool
     */
    public function amountLessThanAmountAccount(float $amount, float $amountAccount): bool
    {
        return $amount < $amountAccount;
    }

    public function debitAccountCash($amount)
    {
        if (!$this->amountLessThanAmountAccount($amount, $this->account->cash)) {
            $this->account->cash -= $amount;
        }
        return false;
    }
}
