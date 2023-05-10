<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class AssetDepartmentStoreRequest extends FormRequest
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
            'name' => ['max:255', 'min:3', 'unique:asset_departments,name'],
        ];
    }
    public function messages()
    {
        return [
            'name.min' => [
                'string' => 'Der Abteilungsname muss mindestens :min Zeichen Lang sein!',
            ],
            'name.unique' => 'Der Abetilungsname ist bereits vergeben!',
        ];
    }
}
