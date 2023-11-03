<?php

namespace App\Http\Requests\Task;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class FilterTaskRequest extends FormRequest
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
            'status' => ['nullable', new Enum(TaskStatus::class)],
            'due_date' => ['nullable', 'date_format:Y-m-d'],
            'priority' => ['nullable', new Enum(TaskPriority::class)],
            'notes' => ['nullable', 'string'],
            'has_notes' => ['nullable', 'boolean']
        ];
    }
}
