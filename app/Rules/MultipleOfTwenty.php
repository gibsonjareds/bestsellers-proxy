<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MultipleOfTwenty implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(is_numeric($value)){
            if((int) $value % 20 !== 0){
                $fail(":attribute must be a multiple of 20");
            }
        }else{
            $fail(":attribute must be numeric and a multiple of 20");
        }
    }
}
