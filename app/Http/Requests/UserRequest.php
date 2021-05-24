<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        switch ( $this->method() ) {
            case 'GET':
            case 'POST': {
                return [
                    'first_name'    => 'required|string',
                    'last_name'     => 'required|string',
                    'username'      => 'required|string|unique:users',
                    'email'         => 'required|string|email|unique:users',
                    'password'      => 'required|min:6',
                    'role'          => 'required|in:Administrator,Manager'
                ];
            }
            case 'PUT':
            case 'PATCH': {
                if (preg_match("/\/(\d+)$/", $this->url(), $mt))
                    $user = User::find($mt[1]);
                return [
                    'first_name'    => 'required|string',
                    'last_name'     => 'required|string',
                    'username'      => 'required|string|unique:users,username,'.$user->id,
                    'email'         => 'required|string|email|unique:users,email,'.$user->id,
                    'password'      => 'sometimes|min:6',
                    'role'          => 'required|in:Administrator,Manager'
                ];
            }
            case 'DELETE': {
                return [];
            }
            default:
                break;
        }
    }
}
