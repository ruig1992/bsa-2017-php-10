<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ValidatedCar
 * @package App\Http\Requests
 */
class ValidatedCar extends FormRequest
{
    /**
     * Determines if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Gets the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'model' => 'bail|required|max:255',
            'registration_number' => 'bail|required|alpha_num|size:6',
            'year' => 'bail|required|integer|between:1000,' . date('Y'),
            'color' => 'bail|required|alpha|max:255',
            'mileage' => 'bail|required|integer|min:0',
            'price' => 'bail|required|numeric|min:0',
            'user_id' => 'bail|required|integer|exists:users,id',
        ];
    }
}
