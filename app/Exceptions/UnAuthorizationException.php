<?php

namespace App\Exceptions;

use Illuminate\Http\Request;
use Exception;

class UnAuthorizationException extends Exception
{

    public function __construct(string $message = "", int $code = 403)
    {
        parent::__construct($message, $code);
    }

    public function render(Request $request)
    {
        return view('errors.403', ['exception' => $this]);//自定义403错误信息
    }

}