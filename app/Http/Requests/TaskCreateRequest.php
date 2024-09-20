<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TaskCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'title' => 'string|min:3|max:100|required',
            'description' => 'string|required',
            'priority' => 'required|in:Высокая,Низкая,Средняя',
            'due_date' => 'after_or_equal:today|required'
        ];
    }

}
