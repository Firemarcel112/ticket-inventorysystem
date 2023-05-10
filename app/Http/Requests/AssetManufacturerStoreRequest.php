<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class AssetManufacturerStoreRequest extends FormRequest
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
            'name' => ['max:255', 'min:2', 'unique:asset_manufacturers,name'],
        ];
    }

    public function messages()
    {
        return [
            'name.min' => [
                'string' => 'Der Hersteller muss mindestens :min Zeichen Lang sein!',
            ],
            'name.unique' => 'Der Hersteller ist bereits vergeben!',
        ];
    }
}
