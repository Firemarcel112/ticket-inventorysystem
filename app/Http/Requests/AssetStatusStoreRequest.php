<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class AssetStatusStoreRequest extends FormRequest
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
            'name' => ['max:255', 'min:3', 'unique:asset_statuses,name'],
        ];
    }

    public function messages()
    {
        return [
            'name.min' => [
                'string' => 'Der Statusname muss mindestens :min Zeichen Lang sein!',
            ],
            'name.unique' => 'Der Statusname ist bereits vergeben!',
        ];
    }
}
