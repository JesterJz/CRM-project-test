<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactBulkUpdateRequest extends FormRequest
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
            '*.id' => 'required|integer|exists:contacts,id',
            '*.name' => 'required|string',
            '*.email' => 'required|email',
            '*.phone' => 'required|string|max:11|min:10',
            '*.tags' => 'required|array',
            '*.tags.*' => 'integer|exists:tags,id',
            '*.manager_ids' => 'required|array',
            '*.manager_ids.*' => 'integer|exists:users,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, mixed>
     */
    public function messages(): array
    {
        return [
            '*.id.required' => 'The id field is 12123.',
            '*.id.integer' => 'The id field must be an integer.',
            '*.id.exists' => 'The selected id is invalid.',
            '*.name.required' => 'The name field is required.',
            '*.name.string' => 'The name field must be a string.',
            '*.email.required' => 'The email field is required.',
            '*.email.email' => 'The email field must be a valid email address.',
            '*.phone.required' => 'The phone field is required.',
            '*.phone.string' => 'The phone field must be a string.',
            '*.phone.max' => 'The phone field must be at most 11 characters.',
            '*.phone.min' => 'The phone field must be at least 10 characters.',
            '*.tags.required' => 'The tags field is required.',
            '*.tags.array' => 'The tags field must be an array.',
            '*.tags.*.integer' => 'The tags field must contain only integers.',
            '*.tags.*.exists' => 'The selected tags is invalid.',
            '*.manager_ids.required' => 'The manager ids field is required.',
            '*.manager_ids.array' => 'The manager ids field must be an array.',
            '*.manager_ids.*.integer' => 'The manager ids field must contain only integers.',
            '*.manager_ids.*.exists' => 'The selected manager ids is invalid.',
        ];
    }
}
