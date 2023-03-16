<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ProfileRequest extends FormRequest
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
        $validator = [
            'email' => ['required', 'string', 'email', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'address' => ['string', 'max:255'],
            'brithdate' => ['date', 'string', 'before:'. now()],
            'city' => ['string', 'max:255'],
            'new_password' => ['nullable', Rules\Password::defaults()]
        ];



        if(!is_null($this->new_password)) {

            $validator = array_merge($validator, ['current_password' => [Rules\Password::defaults(), 'current_password']]);
        }


        return $validator;
    }

    public function updateProfile(){

        $data = $this->validated();

        $user =  $this->user();

        $data['password'] = !is_null($this->new_password) ? 
                                Hash::make($this->new_password)  
                                : $user->password; 

       $user->update($data);

        return $this->user()->fresh();
    }
}
