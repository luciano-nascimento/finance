<?php

namespace App\Http\Requests;

use App\Rules\StoreExpenseUniqueDescriptionInSameMonth;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

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
        $descriptionMonth = '';

        try {
            $descriptionMonth = Carbon::createFromFormat('Y-m-d', $this->request->get('date'))
                ->month;
        } catch (\Exception $e) {
            Log::info('Invalid date sent during income register');
        }

        return [
            'date' => ['required', 'date'],
            'description' => [
                'required',
                new StoreExpenseUniqueDescriptionInSameMonth($descriptionMonth),
                'max:500'
            ],
            'amount'  => ['required', 'decimal:0,10']
        ];
    }
}
