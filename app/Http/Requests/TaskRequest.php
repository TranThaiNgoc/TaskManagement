<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'name'                 => 'required|string|max:255',
                    'priority'               => 'nullable|numeric|min:0|not_in:0',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name'                 => 'required|string|max:255',
                    'priority'               => 'nullable|numeric|min:0|not_in:0',
                ];
            }
            default:break;
        }
    }
}
