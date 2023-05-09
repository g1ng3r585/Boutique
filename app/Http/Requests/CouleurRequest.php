<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouleurRequest extends FormRequest
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
            'couleur' => 'required|min:2|max:20',
            'hex' => 'required|min:3|max:10|regex:/^#([A-Fa-f0-9]{3}){1,2}$/',

        ];
    }
    

    public function messages()
    {
            return [
                'couleur.min' => 'La couleur doit avoir minimum 2 caractères.',
                'couleur.max' => 'La couleur a atteint le nombre maximal de caractères.',
                'couleur.required' => 'La couleur est obligatoire.',

                'hex.min' => 'Le Hex doit avoir minimum 3 caractères.',
                'hex.max' => 'Le Hex a atteint le nombre maximal de caractères.',
                'hex.required' => 'Le Hex est obligatoire.',

                'hex.regex' => 'Le Hex n\'est pas sous la forme demandé.',
            ];
    }
}
