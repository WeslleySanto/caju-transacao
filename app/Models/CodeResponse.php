<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodeResponse extends Model
{
    const REJEITADA = '51';
    const APROVADA = '00';
    const ERRO = '07';

    const CODERESPONSE = [
        self::REJEITADA,
        self::APROVADA,
        self::ERRO
    ];

    public function sendRequest()
    {
        return CodeResponse::CODERESPONSE[rand(0, 2)];
    }
}
