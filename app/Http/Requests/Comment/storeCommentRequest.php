<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;
use App\Exceptions\ValidationFailedException;
use Illuminate\Contracts\Validation\Validator;

class storeCommentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'comment' => 'required|string',
            'commentable_type' => 'required|string',
            'commentable_id' => 'required|integer',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new ValidationFailedException($validator);
    }

}
