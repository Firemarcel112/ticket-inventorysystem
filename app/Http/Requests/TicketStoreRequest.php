<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TicketStoreRequest extends FormRequest
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
            'headline' => 'min:10|max:40',
            'content' => 'min:20',
            'category_id' => 'required'
        ];
    }

    /**
     * @return \string[][]
     */
    public function messages() {
        return [
            'headline.min' => [
                'string' => 'Der Betreff muss mindestens :min Zeichen beinhalten!'
            ],
            'headline.max' => [
                'string' => 'Dein Betreff ist zu lang!'
            ],
            'content.min' => [
                'string' => 'Um dein Problem besser zu bearbeiten schreibe mindestens :min Zeichen!',
            ],

        ];
    }
}
