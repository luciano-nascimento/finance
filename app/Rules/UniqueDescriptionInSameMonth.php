<?php

namespace App\Rules;

use App\Models\Expense;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueDescriptionInSameMonth implements ValidationRule
{
    
    public function __construct(private string $descriptionMonth) {}

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail) : void
    {
        $alreadyCreatedExpenseWithSameDescriptionAndMonth = Expense::where([
            ['description', $value]
        ])->whereMonth('date', $this->descriptionMonth)->get();
        
        if (count($alreadyCreatedExpenseWithSameDescriptionAndMonth) > 0) {
            $fail('The :attribute must be unique in same month.');
        }
    }

}
