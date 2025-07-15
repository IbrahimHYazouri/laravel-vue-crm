<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\ProjectStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateProjectRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'client_id' => ['required', 'exists:clients,id'],
            'user_id' => ['required', 'exists:users,id'],
            'deadline' => ['required', 'date'],
            'status' => ['required', Rule::in(ProjectStatus::values())],
            'attachments.*' => [
                'file',
                'mimes:jpg,jpeg,png,doc,docx,pdf',
                'max:10240',
            ],
            'removed_attachments' => ['nullable', 'array'],
            'removed_attachments.*' => ['integer', 'exists:media,id'],
        ];
    }
}
