<?php

namespace App\Modules\Dictionary\Requests;

use App\Models\DictionaryCategory;
use Illuminate\Foundation\Http\FormRequest;

class DictionaryRequest extends FormRequest
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
            DictionaryCategory::COLUMN_NAME => 'required|string',
        ];
    }
}
