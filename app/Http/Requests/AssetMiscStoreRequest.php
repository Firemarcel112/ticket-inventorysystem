<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AssetMiscStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => ['max:8', 'min:4', 'unique:assets,id'],
            'purchasecost' => ['regex:/^(\d*\,?.\d+|\d{1,3}(,\d{3})*(\.\d+)?)$/', 'nullable'],
        ];
    }
    public function messages()
    {
        return [
            'id.min' => [
                'string' => 'Die ID muss mindestens :min Zeichen Lang sein!',
            ],
            'id.max' => [
                'string' => 'Die ID darf maximal :max Zeichen Lang sein!',
            ],
            'id.unique' => 'Die ID ist bereits vergeben!',
            'purchasecost.regex' => 'Der eingegebene Kaufpreis ist ungültig 00.00 oder 00,00 ',
        ];
    }
}
