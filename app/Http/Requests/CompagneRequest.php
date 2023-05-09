<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Compagne as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class CompagneRequest extends FormRequest
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
            'dateDebut' => 'required|date_format:Y-m-d',
            'dateFin' => 'required|date_format:Y-m-d|after:dateDebut',

            'debutPaiement' => 'required|date_format:Y-m-d|after:dateDebut',
            'finPaiement' => 'required|date_format:Y-m-d|after:debutPaiement',
            
            'debutDistribution' => 'required|date_format:Y-m-d|after:finPaiement',
            'finDistribution' => 'required|date_format:Y-m-d|after:debutDistribution',
            
        ];
    }
    

    public function messages()
    {
        return [
            'dateDebut.required' => 'La Date de Debut est obligatoire.',
            'dateDebut.min' => 'La Date de Debut doit avoir au minimum :min caractères.',
            'dateDebut.max' => 'La Date de Debut ne doit pas dépasser :max caractères.',
            'dateDebut.date_format' => 'La Date de Debut doit être au format yyyy-mm-dd.',
            
            'dateFin.min' => 'La Date de Fin doit avoir au minimum :min caractères.',
            'dateFin.max' => 'La Date de Fin ne doit pas dépasser :max caractères.',
            'dateFin.date_format' => 'La Date de Fin doit être au format yyyy-mm-dd.',
            
            'debutPaiement.min' => 'La Date de Debut de Paiement doit avoir au minimum :min caractères.',
            'debutPaiement.max' => 'La Date de Debut de Paiement ne doit pas dépasser :max caractères.',
            'debutPaiement.date_format' => 'La Date de Debut de Paiement doit être au format yyyy-mm-dd.',
            
            'finPaiement.min' => 'La Date de Fin de Paiement doit avoir au minimum :min caractères.',
            'finPaiement.max' => 'La Date de Fin de Paiement ne doit pas dépasser :max caractères.',
            'finPaiement.date_format' => 'La Date de Fin de Paiement doit être au format yyyy-mm-dd.',
            
            'debutDistribution.min' => 'La Date de Debut de Distribution doit avoir au minimum :min caractères.',
            'debutDistribution.max' => 'La Date de Debut de Distribution ne doit pas dépasser :max caractères.',
            'debutDistribution.date_format' => 'La Date de Debut de Distribution doit être au format yyyy-mm-dd.',
            
            'finDistribution.min' => 'La Date de Fin de Distribution doit avoir au minimum :min caractères.',
            'finDistribution.max' => 'La Date de Fin de Distribution ne doit pas dépasser :max caractères.',
            'finDistribution.date_format' => 'La Date de Fin de Distribution doit être au format yyyy-mm-dd.',


            'dateFin.after' => 'La date de fin doit être supérieure  à la date de début.',
            'debutPaiement.after' => 'La date de début de paiement doit être inférieure à la date de fin de paiement et superieur a la date de debut de campagne.',
            'finPaiement.after' => 'La date de fin de paiement doit être supérieure  à la date de début de paiement .',
            'debutDistribution.after' => 'La date de début de distribution doit être inférieure  à la date de fin de distribution et superieur a la date de debut de paiement.',
            'finDistribution.after' => 'La date de fin de distribution doit être supérieure  à la date de début de distribution.',





            
        ];
    }

}
