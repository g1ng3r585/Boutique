<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Client as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
                'min:10',
                'max:50',
                Rule::unique('clients', 'email'),
                Rule::unique('usagers', 'email'),
            ],            
            'password' => 'required|min:6|max:255',
            'lastName' => 'required|min:3|max:50',
            'name' => 'required|min:3|max:50',
        ];
    }

    public function messages()
    {
            return [
                'lastName.min' => 'Le nom doit avoir minimum 3 caractères.',
                'lastName.max' => 'Le nom a atteint le nombre maximal de caractères.',
                'lastName.required' => 'Le nom est obligatoire.',
                
                'email.min' => 'Le email doit avoir minimum 10 caractères.',
                'email.max' => 'Le email a atteint le nombre maximal de caractères.',
                'email.required' => 'Le email est obligatoire.',
                'email.unique' => 'cette email est déja utilisé.',
              
                
                'password.min' => 'Le mot de passe doit avoir minimum 6 caractères.',
                'password.max' => 'Le mot de passe a atteint le nombre maximal de caractères.',
                'password.required' => 'Le mot de passe est obligatoire.',
                
                'name.max' => 'Le prenom a atteint le nombre maximal de caractères.',
                'name.min' => 'Le prenom doit avoir minimum 3 caractères.',
                'name.required' => 'Le prenom est obligatoire.',


            ];
    }
}
