<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserTableRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'page' => ['nullable', 'integer'],
            'filter' => ['nullable', 'array'],
            'filter.country ' => ['nullable', Rule::exists('countries', 'code')],
            'filter.comment_activity_trend' => Rule::in(['higher', 'lower', 'neutral']),
            'sort' => ['nullable', 'array'],
            'sort.field' => ['required', Rule::in(['created_at', 'comments_count'])],
            'sort.direction' => ['required', Rule::in(['asc', 'desc'])],
        ];
    }
}
