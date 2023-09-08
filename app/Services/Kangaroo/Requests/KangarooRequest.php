<?php

namespace App\Services\Kangaroo\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * KangarooRequest
 *
 * @author Limuel Bassig
 * @since 2023.09.07
 * @package App\Services\Kangaroo\Requests
 */
class KangarooRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules() : array
    {
        $aRules = [
            'name'         => ['required', 'string'],
            'nickname'     => ['nullable', 'string'],
            'weight'       => ['required', 'numeric', 'min:0'],
            'height'       => ['required', 'numeric', 'min:0'],
            'gender'       => ['required', 'string', Rule::in('male', 'female')],
            'color'        => ['nullable', 'string'],
            'friendliness' => ['nullable', 'string', Rule::in('friendly', 'independent')],
            'birthday'     => ['required', 'date'],
        ];

        if ($this->isMethod('PUT') === true) {
            //added validation for update
            $aRules['kangaroo_id'] = ['required', 'int', 'exists:kangaroos,kangaroo_id'];
        }

        return $aRules;
    }
}
