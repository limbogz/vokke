<?php

namespace App\Services\Kangaroo\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * KangarooIdRequest
 *
 * @author Limuel Bassig
 * @since 2023.09.07
 * @package App\Services\Kangaroo\Requests
 */
class KangarooIdRequest extends FormRequest
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
        return [
            'kangaroo_id' => ['required', 'int', 'exists:kangaroos,kangaroo_id']
        ];
    }

    /**
     * all
     * @param array|mixed|null $keys
     * @return array
     */
    public function all($keys = null) : array
    {
        $aData = parent::all();
        $aData['kangaroo_id'] = $this->route('iId');

        return $aData;
    }
}
