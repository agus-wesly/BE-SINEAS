<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'desc' => 'required|string',
            'genre_id' => 'required|array',
            'genre_id.*' => 'required|string',
            'actor' => 'required|array',
            'actor_id.*' => 'required|string',
            'thumbnail' => 'required|image',
            'background' => 'required|image',
            'duration' => 'required|string',
            'date' => 'date',
            'url_trailer' => 'required|string',
            'url_film' => 'required|string',
            'information' => 'required|array',
        ];
    }
}
