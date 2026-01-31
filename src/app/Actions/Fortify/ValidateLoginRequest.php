<?php

namespace App\Actions\Fortify;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class ValidateLoginRequest
{
    public function __invoke(Request $request)
    {
        /** @var \App\Http\Requests\LoginRequest $form */
        $form = app(LoginRequest::class);

        $request->validate(
            $form->rules(),
            $form->messages()
        );
    }
}
