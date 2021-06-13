<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Controllers\Manage\BaseController;


class AuthorResource extends JsonResource
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
            'name' =>$lang=='en' ?  $this->nameEn : $this->nameAr,
            'aboutAuthor' =>$lang=='en' ?  $this->aboutAuthorEn : $this->aboutAuthorAr,
            'death_date' =>$this->death_date,
            'birth_date' => $this->birth_date,
            'image' =>  getImageUrl('Author',$this->image),
        ];
    }
}
