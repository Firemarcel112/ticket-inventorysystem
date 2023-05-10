<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TicketCategoryStoreRequest extends FormRequest
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
            'name' => ['max:255', 'min:4', 'unique:ticket_categories,name']
        ];
    }

    public function messages()
    {
        return [
            'name.min' => [
                'string' => 'Die Kategorie muss mindestens :min Zeichen Lang sein!',
            ],
            'name.unique' => 'Die Kategorie ist bereits vergeben!',
        ];
    }
}
