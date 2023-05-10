<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserUpdateSettingsRequest extends FormRequest
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
            'password' => ['min:8', 'max:255', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/', 'confirmed']
        ];
    }

    public function messages() {
        return [
            'password.confirmed' => 'Die Passwörter stimmen nicht überein!',
            'password.min' => [
                'string' => 'Das Passwort muss mindestens :min Zeichen enthalten!'
            ],
            'password.regex' => 'Das Passwort entspricht nicht den Sicherheitsanforderungen (Sonderzeichen, Groß und Kleinschreibung)',

        ];
    }
}
