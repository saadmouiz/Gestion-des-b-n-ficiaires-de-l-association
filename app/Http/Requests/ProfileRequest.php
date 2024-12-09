<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'cin' => 'required|unique:beneficiaries,cin',
        'nom' => 'required',
        'prenom' => 'required',
        'baccalaureat' => 'required',
        'diplome_obtenu' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        'pdf' => 'nullable|mimes:pdf|max:2048',
        ];
    }
}
