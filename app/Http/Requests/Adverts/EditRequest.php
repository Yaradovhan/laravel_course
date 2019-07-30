<?php

namespace App\Http\Requests\Adverts;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EditRequest
 * @package App\Http\Requests\Adverts
 */

class EditRequest extends FormRequest
{
    public function authorize() :bool
    {
        return true;
    }

    public function rules() :array
    {
        return [
            'title' => 'required|string',
            'content' => 'required|string',
            'price' => 'required|numeric',
            'address' => 'required|string'
        ];
    }
}
