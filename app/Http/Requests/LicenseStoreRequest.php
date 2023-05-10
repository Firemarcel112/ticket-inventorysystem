<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LicenseStoreRequest extends FormRequest
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
            'name' => ['required', 'unique:licenses,name'],
            'expirationdate' => ['required'],
            'licensekey' => ['required'],
            'purchaseprice' => ['regex:/^(\d*\,?.\d+|\d{1,3}(,\d{3})*(\.\d+)?)$/'],
            'total' => ['regex:/^[0-9]{1,9}$/'],
            'purchaseDuration' => ['regex:/^[0-9]{1,9}$/'],
            'purchaseMonthPrice' => ['regex:/^(\d*\,?.\d+|\d{1,3}(,\d{3})*(\.\d+)?)$/']
        ];
    }

    public function messages()
    {
        return [
            'purchaseprice.regex' => 'Der eingegebene Kaufpreis ist ungültig 00.00 oder 00,00 ',
            'total.regex' => 'Die Angegebene Anzahl entspricht keiner ganzen zahl!',
            'purchaseDuration.regex' => 'Geben Sie eine Ganze Zahl als Monat an',
            'purchaseMonthPrice.regex' => 'Der eingegebene Monatspreis ist ungültig 00.00 oder 00,00'
        ];
    }
}
