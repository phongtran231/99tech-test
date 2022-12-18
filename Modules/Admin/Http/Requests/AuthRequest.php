<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    public function rules(): array
    {
        return [
           'email' => 'email|required',
           'password' => 'min:5|required'
        ];
    }
}
