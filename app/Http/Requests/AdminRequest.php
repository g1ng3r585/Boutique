<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Admin as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed> 
     * \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules()
    {
        return [
            'email' => implode('|', [
                'required',
                'email',
                'min:10',
                'max:50',
                'regex:/^([a-zA-ZÀ-ÿ]-?)+(\.([a-zA-Z]-?)+)+\.([0-9]{2})@cegeptr.qc.ca$/',
                Rule::unique('admins', 'email'),
                Rule::unique('usagers', 'email'),
            ]),
            'password' => 'required|min:6|max:255',
            'lastname' => 'required|min:3|max:50',
            'name' => 'required|min:3|max:50',
        ];
    }
    
    
    
    public function messages()
    {
            return [
                'lastname.min' => 'Le nom doit avoir minimum 3 caractères.',
                'lastname.max' => 'Le nom a atteint le nombre maximal de caractères.',
                'lastname.required' => 'Le nom est obligatoire.',
                
                'name.max' => 'Le prenom a atteint le nombre maximal de caractères.',
                'name.min' => 'Le prenom doit avoir minimum 3 caractères.',
                'name.required' => 'Le prenom est obligatoire.',
                
                'password.min' => 'Le mot de passe doit avoir minimum 6 caractères.',
                'password.max' => 'Le mot de passe a atteint le nombre maximal de caractères.',
                'password.required' => 'Le mot de passe est obligatoire.',
                
                'email.min' => 'Le email doit avoir minimum 10 caractères.',
                'email.max' => 'Le email a atteint le nombre maximal de caractères.',
                'email.required' => 'Le email est obligatoire.',
                'email.unique' => 'cette email est déja utilisé.',
                'email.regex' => 'Le courriel doit être identique à celui du cegep, exemple: prenom.nom.01@cegptr.qc.ca.',
            
            ];
    }
    
}
