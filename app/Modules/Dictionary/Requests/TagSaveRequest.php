<?php

namespace App\Modules\Dictionary\Requests;

use App\Models\DictionaryCategory;
use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;

class TagSaveRequest extends FormRequest
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
            Tag::COLUMN_NAME => 'required|string',
            Tag::COLUMN_CODE => 'required|string',
        ];
    }
}
