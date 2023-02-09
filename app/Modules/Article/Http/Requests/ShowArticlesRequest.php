<?php

namespace App\Modules\Article\Http\Requests;

use App\Modules\Article\Models\Article;
use App\Modules\System\Data\OrderByDirectionEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class ShowArticlesRequest extends FormRequest
{
    public const SELECTABLE_FIELDS = [
        Article::FIELD_TITLE,
        Article::FIELD_SHORT_DESCRIPTION,
        Article::FIELD_PUBLISHED_AT,
        Article::FIELD_AUTHOR,
        Article::FIELD_IMAGE,
    ];

    public const SORTABLE_FIELDS = [
        Article::FIELD_PUBLISHED_AT,
    ];

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'page' => ['sometimes', 'integer'],
            'select_fields' => ['sometimes', 'array'],
            'select_fields.*' => Rule::in(self::SELECTABLE_FIELDS),
            'sort' => ['sometimes', 'array'],
            'sort.*.field' => Rule::in(self::SORTABLE_FIELDS),
            'sort.*.direction' => [new Enum(OrderByDirectionEnum::class)],
        ];
    }
}
