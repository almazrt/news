<?php

namespace App\Modules\Article\Http\Resources;

use App\Modules\Article\Models\Article;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var Article $this */
        return [
            'id' => $this->id,
            'title' => $this->title,
            'short_description' => $this->short_description,
            'published_at' => $this->published_at,
            'author' => $this->author,
            'image' => $this->image,
        ];
    }
}
