<?php

namespace App\Http\Requests\Auth;

use App\Rules\PhoneRule;
use App\Services\AuthCodeService\AuthCodeServiceInterface;
use Illuminate\Foundation\Http\FormRequest;

class CheckCodeRequest extends FormRequest
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
            'phone' => PhoneRule::get(),
            'code' => 'required|integer|min:1000|max:9999'
        ];
    }
}
