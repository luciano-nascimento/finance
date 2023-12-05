<?php

namespace App\Http\Requests;

use App\Rules\UniqueDescriptionInSameMonth;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
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
        $descriptionMonth = Carbon::createFromFormat('Y-m-d', $this->request->get('date'))
            ->month;

        return [
            'date' => ['required', 'date'],
            'description' => [
                'required',
                new UniqueDescriptionInSameMonth($descriptionMonth),
                'max:500'
            ],  
            'amount'  => ['required', 'decimal:0,10']
        ];
    }
}
