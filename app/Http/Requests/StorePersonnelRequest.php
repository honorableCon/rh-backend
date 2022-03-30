<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonnelRequest extends FormRequest
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
            'cni' => 'required|string|max:64|unique:personnels',
            'nom' => 'required|string|max:64',
            'prenom' => 'required|string|max:64',
            'dateDeNaissance' => 'required|date',
            'sexe' => 'required|string|max:8',
            'nationalite' => 'required|string|max:64',
            'tel' => 'required|string|max:14',
            'email' => 'required|email|max:64|unique:personnels',
            'enfant' => 'required|numeric',
            'conjoint' => 'required|numeric',
            'matrimoniale' => 'required|numeric',
            'filiereId' => 'required|numeric',
            'debut' => 'required|date',
            'fin' => 'required|date',
            'statutId' => 'required|numeric',
            'typeContratId' => 'required|numeric',
        ];
    }
}
