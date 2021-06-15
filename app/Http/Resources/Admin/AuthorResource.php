<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;


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
        return [
            'id' => $this->id,
            'nameAr' => $this->nameAr,
            'nameEn' => $this->nameEn,
            'birth_date' => $this->birth_date,
            'death_date' => $this->death_date,
            'status' => $this->status,
            'aboutAuthorEn' => $this->aboutAuthorEn,
            'aboutAuthorAr' => $this->aboutAuthorAr,
            'image' => getImageUrl('Author',$this->image),
        ];
    }
}
