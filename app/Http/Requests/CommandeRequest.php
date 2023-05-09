<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommandeRequest extends FormRequest
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
            'produit_id' => 'required|exists:produits,id',
            'taille_id' => 'required|exists:tailles,id',
            'couleur_id' => 'required|exists:couleurs,id',
            'quantite' => 'required|integer|min:1',
        ];
    }
    
    public function messages()
    {
        return [
            'produit_id.required' => 'Le produit est requis.',
            'produit_id.exists' => 'Le produit sélectionné est invalide.',
            'taille_id.required' => 'La taille est requise.',
            'taille_id.exists' => 'La taille sélectionnée est invalide.',
            'couleur_id.required' => 'La couleur est requise.',
            'couleur_id.exists' => 'La couleur sélectionnée est invalide.',
            'quantite.required' => 'La quantité est requise.',
            'quantite.integer' => 'La quantité doit être un nombre entier.',
            'quantite.min' => 'La quantité doit être au moins de 1.',
        ];
    }
    
}
