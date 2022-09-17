<?php

namespace App\Http\Requests\Auth;

use App\Repositories\Services\UserResourceDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

/**
 * @property string $name
 * @property string $email
 * @property string $password
 */
class RegisterUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function makeResourceDto(): UserResourceDto
    {
        return new UserResourceDto(
            $this->name,
            $this->email,
            Hash::make($this->password)
        );
    }
}
