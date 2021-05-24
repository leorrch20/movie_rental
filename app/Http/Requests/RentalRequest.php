<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RentalRequest extends FormRequest
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
            'customer_id'   => 'required|exists:customers,id',
            'movie_id'      => 'required|exists:movies,id',
            'start_date'    => 'required|date|date_format:Y-m-d',
            'end_date'      => 'date|date_format:Y-m-d'
        ];
    }
}
