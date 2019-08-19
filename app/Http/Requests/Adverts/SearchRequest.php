<?php

namespace App\Http\Requests\Adverts;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    public function authorize()
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'text' => 'nullable|string',
            'attrs.*.equals' => 'nullable|string',
            'attrs.*.from' => 'nullable|numeric',
            'attrs.*.to' => 'nullable|numeric',
        ];
    }
}