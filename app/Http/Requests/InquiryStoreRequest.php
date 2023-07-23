<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\InquiryType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InquiryStoreRequest extends FormRequest
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
            'name' => ['required', 'unique:inquiries,name', 'max:255'],
            'email' => ['required', 'unique:inquiries,email', 'max:255'],
            'content' => ['required', 'max:1000'],
            'type' => [
                'required',
                Rule::in(InquiryType::values())
            ],
        ];
    }

    public function attributes()
    {
        return [
            'name' => '名前の入力',
            'email' => 'メールアドレスの入力',
            'content' => 'お問い合わせ内容の入力',
            'type' => '選択',
        ];
    }
}
