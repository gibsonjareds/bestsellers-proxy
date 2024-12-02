<?php

namespace App\Http\Requests;

use App\Rules\Isbn;
use App\Rules\MultipleOfTwenty;
use Illuminate\Foundation\Http\FormRequest;

class NytBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=>'string',
            'author'=>'string',
            'isbn.*'=>['string', new Isbn],
            'offset' =>['integer', new MultipleOfTwenty]
        ];
    }
}
