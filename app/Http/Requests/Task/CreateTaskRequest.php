<?php

namespace App\Http\Requests\Task;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreateTaskRequest extends FormRequest
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
            'subject' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'start_date' => ['required', 'date', 'date_format:Y-m-d', 'before_or_equal:end_date'],
            'end_date'=> ['required', 'date', 'date_format:Y-m-d', 'after_or_equal:start_date'],
            'status' => ['required', new Enum(TaskStatus::class)],
            'priority' => ['required', new Enum(TaskPriority::class)],
            'notes' => ['required', 'array'],
            'notes.*.subject' => ['required', 'string', 'max:255'],
            'notes.*.attachments' => ['required', 'array'],
            'notes.*.attachments.*' => ['required', 'file'],
            'notes.*.note' => ['required', 'string']
        ];
    }
}
