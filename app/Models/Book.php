<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cats(){
        return $this->belongsToMany(Category::class,'book_cats','book_id','cat_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function authors(){
        return $this->belongsToMany(Author::class,'book_authors','book_id','author_id');
    }
}
