<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Isbn implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $subject = trim(str_replace('-', '',$value));
        if(!is_numeric($subject)){
            $fail('The :attribute must only contain numbers and the - character');
        }
        $subject_length = strlen($subject);
        if(false === ($subject_length === 10 || $subject_length === 13)){
            $fail('The :attribute value must be exactly 10 or 13 characters');
        }
    }
}
