<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class StoreMovieRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['max:255', 'required'],
            'year' => ['required', 'integer', 'min:1888', 'max:' . (date('Y') + 5)],
            'director' => ['required', 'string', 'max:180'],
            'genre' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'cast' => ['required', 'array', 'min:1'],
            'cast.*' => ['required', 'string', 'max:255'],
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            'title.required' => "Il titolo è obbligatorio",
            'year.required' => "L'anno di uscita è obbligatorio",
            'year.integer' => "L'anno deve essere un numero",
            'year.min' => "L'anno inserito non è valido",
            'year.max' => "L'anno inserito è troppo futuristico",
            'director.required' => "Il regista è obbligatorio",
            'director.max' => "Il regista non può essere lungo più di 180 caratteri",
            'genre.required' => "Il genere è obbligatorio",
            'genre.max' => "Il genere non può essere lungo più di 150 caratteri",
            'cast.required' => 'Il cast è obbligatorio. Inserisci una o più righe.',
            'cast.min' => 'Devi inserire almeno un membro del cast.',
            'cast.*.required' => 'Il nome dell\'attore non può essere vuoto.',
            'cast.*.string' => 'Il nome dell\'attore deve essere un testo valido.',
        ];
    }
}
