<?php

namespace App\Http\Requests;

use App\Consultants\LifeStyleTag;
use App\Consultants\PreferredType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FatRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'life_style_tag' => ['required', 'array', Rule::in(LifeStyleTag::getLifeStyleTags())],
            'preferred_types_order' => ['required', 'array', Rule::in(PreferredType::getPreferredTypes())]
        ];
    }
}
