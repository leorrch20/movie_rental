<?php

namespace App\Http\Requests;

use App\Movie;
use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
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
                    'code'      => 'required|string|max:10|unique:movies',
                    'title'     => 'required|string',
                    'category'  => 'required|string',
                    'year'      => 'required|date|date_format:Y',
                    'qty'       => 'required|integer'
                ];
            }
            case 'PUT':
            case 'PATCH': {
                if (preg_match("/\/(\d+)$/", $this->url(), $mt))
                    $movie = Movie::find($mt[1]);
                return [
                    'code'      => 'required|string|max:10|unique:movies,code'.$movie->id,
                    'title'     => 'required|string',
                    'category'  => 'required|string',
                    'year'      => 'required|date|date_format:Y',
                    'qty'       => 'required|integer'
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
