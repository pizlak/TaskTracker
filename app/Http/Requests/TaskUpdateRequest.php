<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends FormRequest
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
    public function rules() : array
    {
        return [
            'title' => 'string|min:3|max:100|required',
            'description' => 'string|required',
            'status' => 'required|in:Выполнено,Выполняется,Не выполнено',
            'type' => 'required',
            'priority' => 'required|in:Высокая,Низкая,Средняя',
            'due_date' => 'after_or_equal:today|required'
        ];
    }
}
