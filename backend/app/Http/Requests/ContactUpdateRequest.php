<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:contacts,id',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string|max:11|min:10',
            'manager_id' => 'required|integer|exists:users,id',
        ];
    }
}
