<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Account;
use App\Models\CodeResponse;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function send(TransactionRequest $request)
    {
        if ((new CodeResponse())->sendRequest() == CodeResponse::APROVADA) {
            (new Account())->debit($request);
        }
    }
}
