<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TailleRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules()
    {
        return [
            'taille' => 'required|min:5|max:50|regex:/^[A-Z][\p{L}\s]+$/u',
        ];
    }
    

    public function messages()
    {
            return [
                'taille.min' => 'La taille doit avoir minimum 5 caractères.',
                'taille.max' => 'La taille a atteint le nombre maximal de caractères.',
                'taille.required' => 'La taille est obligatoire.',

                'taille.regex' => 'La première lettre de la taille doit être en majuscule.',
            ];
    }
}
