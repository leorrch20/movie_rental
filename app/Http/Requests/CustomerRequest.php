<?php

namespace App\Http\Requests;

use App\Customer;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
                    'name'      => 'required|string',
                    'last_name' => 'required|string',
                    'dni'       => 'required|string|unique:customers',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                if (preg_match("/\/(\d+)$/", $this->url(), $mt))
                    $customer = Customer::find($mt[1]);
                return [
                    'name'      => 'required|string',
                    'last_name' => 'required|string',
                    'dni'       => 'required|string|unique:customers,dni,'.$customer->id,
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
