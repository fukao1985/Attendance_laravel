<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisteredUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'email', 'unique:users','string', 'max:191'],
            'password' => ['required', 'string', 'min:8', 'max:191', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '※ 名前は必ず入力してください。',
            'name.string' => '※ 名前は文字列で入力してください。',
            'name.max' => '※ 名前は191文字以内で入力してください。',
            'email.required' => '※ メールアドレスは必ず入力してください。',
            'email.email' => '※ メールアドレスは正しいメールアドレス形式で入力してください。',
            'email.unique' => '※ 入力されたメールアドレスはすでに使用されています。',
            'email.string' => '※ 名前は文字列で入力してください。',
            'email.max' => '※ 名前は191文字以内で入力してください。',
            'password.required' => '※ パスワードは必ず入力してください。',
            'password.string' => '※ パスワードは文字列で入力してください。',
            'password.min' => '※ パスワードは8文字以上191文字以内で入力してください。',
            'password.max' => '※ パスワードは8文字以上191文字以内で入力してください。',
            'password.confirmed' => '※ 入力されたパスワードが異なります。',
        ];
    }
}
