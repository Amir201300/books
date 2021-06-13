<?php

namespace App\Http\Resources;

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
            'titleOfPage' =>getTitleOfBookPage($request),
            'name' =>$lang=='en' ?  $this->nameEn : $this->nameAr,
            'shortDesc' =>$lang=='en' ?  $this->shortDescEn : $this->shortDescAr,
            'numberOfPages' => (int)$this->numberOfPages,
            'download' => (int)$this->download,
            'rate' => (int)$this->rate,
            'isNew' => (int)$this->isNew,
            'link' => $this->linkType == 1 ? $this->link : getImageUrl('Book',$this->link),
            'image' =>  getImageUrl('Book',$this->image),
            'categories' =>  CategoryResource::collection($this->cats),
            'authors' =>  AuthorResource::collection($this->authors),
        ];
    }
}
