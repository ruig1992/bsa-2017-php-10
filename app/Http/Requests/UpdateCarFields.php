<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateCarFields
 * @package App\Http\Requests
 */
class UpdateCarFields extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'model' => 'max:255',
            'registration_number' => 'bail|alpha_num|size:6',
            'year' => 'bail|integer|between:1000,' . date('Y'),
            'color' => 'bail|alpha|max:255',
            'mileage' => 'bail|integer|min:0',
            'price' => 'bail|numeric|min:0',
            'user_id' => 'bail|integer|exists:users,id',
        ];
    }
}
