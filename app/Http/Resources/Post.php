<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
//use GrahamCampbell\Markdown\Facades\Markdown;

class Post extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content, //empty($this->content) ? '' : Markdown::convertToHtml($this->content)
            'image' => $this->image,
            'author' => User::make($this->author),
            'category' => Category::make($this->category),
            'created_at' => $this->created_at->format('Y-m-d')
        ];
    }
}
