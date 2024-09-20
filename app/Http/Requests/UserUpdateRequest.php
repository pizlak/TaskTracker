<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email',
        ];
    }
    public function messages(): array
    {
        return [
            'required' => 'Данное поле не может быть пустым.',
            'name.string' => 'Поле "Имя" должо состоять из букв =).',
            'email.email' => 'Емаил не соответсвует типу.',
        ];
    }
}
