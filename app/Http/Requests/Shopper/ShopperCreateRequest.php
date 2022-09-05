<?php

namespace App\Http\Requests\Shopper;

use App\Models\Shopper;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ShopperCreateRequest
 * @package App\Http\Requests\Shopper
 */
class ShopperCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //
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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email'
        ];
    }
}
