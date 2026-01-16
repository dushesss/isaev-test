<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductIndexRequest extends FormRequest
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
            'q' => ['nullable', 'string', 'max:255'],
            'price_from' => ['nullable', 'numeric', 'min:0'],
            'price_to' => ['nullable', 'numeric', 'min:0', 'gte:price_from'],
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'in_stock' => ['nullable', 'boolean'],
            'rating_from' => ['nullable', 'numeric', 'min:0', 'max:5'],
            'sort' => ['nullable', 'string', Rule::in(['price_asc', 'price_desc', 'rating_desc', 'newest'])],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
            'page' => ['nullable', 'integer', 'min:1'],
        ];
    }

    /**
     * Get validated data with defaults
     */
    public function getFilters(): array
    {
        return [
            'q' => $this->input('q'),
            'price_from' => $this->input('price_from'),
            'price_to' => $this->input('price_to'),
            'category_id' => $this->input('category_id'),
            'in_stock' => $this->has('in_stock') ? filter_var($this->input('in_stock'), FILTER_VALIDATE_BOOLEAN) : null,
            'rating_from' => $this->input('rating_from'),
            'sort' => $this->input('sort', 'newest'),
            'per_page' => $this->input('per_page', 15),
            'page' => $this->input('page', 1),
        ];
    }
}
