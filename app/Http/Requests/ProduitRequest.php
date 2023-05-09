<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProduitRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'titre' => 'required|string|min:3|max:50',
            'prix' => 'required|numeric|min:0.01|max:1000000',
            'nombreMax' => 'required|integer|min:1|max:10',
            'caracteristiques' => 'nullable|min:3|max:100',
            'image' => 'nullable|image|mimes:png,jpeg,jpg,gif,webp,JPG|max:1000000|min:4',
        ];
    }
    
    public function messages()
    {
        return [
            'titre.required' => 'Le titre est requis.',
            'titre.string' => 'Le titre doit être une chaîne de caractères.',
            'titre.min' => 'Le titre doit avoir un minimum de 3 caractères.',
            'titre.max' => 'Le titre ne doit pas dépasser 50 caractères.',
            'prix.required' => 'Le prix est requis.',
            'prix.numeric' => 'Le prix doit être un nombre.',
            'prix.min' => 'Le prix doit être supérieur à 0.',
            'prix.max' => 'Le prix ne doit pas dépasser 1000000.',
            'nombreMax.required' => 'Le nombre maximum est requis.',
            'nombreMax.integer' => 'Le nombre maximum doit être un entier.',
            'nombreMax.min' => 'Le nombre maximum doit être au moins 1.',
            'nombreMax.max' => 'Le nombre maximum ne doit pas dépasser 10.',
            'caracteristiques.string' => 'Les caractéristiques doivent être une chaîne de caractères.',
            'caracteristiques.min' => 'Les caractéristiques doivent avoir un minimum de 3 caractères.',
            'caracteristiques.max' => 'Les caractéristiques ne doivent pas dépasser 100 caractères.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'Le fichier doit être au format png, jpeg, jpg, gif, webp ou JPG.',
            'image.max' => 'L\'image ne doit pas dépasser 1000000 octets.',
            'image.min' => 'L\'image doit avoir un minimum de 4 octets.'
        ];
    }
    
    
    
    
}
