<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Controllers\Manage\BaseController;


class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $lang=$request->header('lang');
        return [
            'id' => $this->id,
            'nameAr' =>$this->nameAr,
            'nameEn' =>$this->nameEn,
            'numberOfPages' => (int)$this->numberOfPages,
            'shortDescAr' =>$this->shortDescAr,
            'shortDescEn' =>$this->shortDescEn,
            'link' =>$this->link,
            'image' =>  getImageUrl('Book',$this->image),
            'categories' =>  CategoryResource::collection($this->cats),
            'authors' =>  AuthorResource::collection($this->authors),
        ];
    }
}
