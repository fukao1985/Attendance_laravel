<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        return [
            'email' => ['required', 'email', 'varchar', 'max:191'],
            'password' => ['required', 'varchar', 'min:8', 'max:191'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => '※ メールアドレスは必ず入力してください。',
            'email.email' => '※ メールアドレスは正しいメールアドレス形式で入力してください。',
            'email.varchar' => '※ 名前は文字列で入力してください。',
            'email.max' => '※ 名前は191文字以内で入力してください。',
            'password.required' => '※ パスワードは必ず入力してください。',
            'password.varchar' => '※ パスワードは文字列で入力してください。',
            'password.min' => '※ パスワードは8文字以上191文字以内で入力してください。',
            'password.max' => '※ パスワードは8文字以上191文字以内で入力してください。',
        ];
    }
}
