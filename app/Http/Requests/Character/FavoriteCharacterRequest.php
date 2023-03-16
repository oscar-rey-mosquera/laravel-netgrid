<?php

namespace App\Http\Requests\Character;

use Illuminate\Foundation\Http\FormRequest;

class FavoriteCharacterRequest extends FormRequest
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
            'character_name' => ['required', 'string', 'max:255'],
            'character_id' => ['required', 'numeric']
        ];
    }


    public function characterData()
    {
        return array_merge($this->validated(), [
              'user_id' => $this->user()->id
        ]);
    }
}
