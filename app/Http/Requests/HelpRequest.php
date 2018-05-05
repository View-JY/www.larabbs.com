<?php

namespace App\Http\Requests;

class ReplyRequest extends Request
{
    public function rules()
    {
        return [
            'type'    => 'required',
            'content' => 'required|min:2',
            'image'   => 'required',
            'tel'     => 'required',
            'address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            // Validation messages
        ];
    }
}
