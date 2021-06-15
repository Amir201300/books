<?php

namespace App\Reposatries;

use App\Http\Resources\UserResource;
use App\Interfaces\BookInterface;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookAuthor;
use App\Models\BookCat;
use Illuminate\Http\Request;
use Validator,Auth,Artisan,Hash,File,Crypt;

class BookReposatry implements BookInterface {
    use \App\Traits\ApiResponseTrait;

    public function add_Book($request){
    $book = new Book();
    $book->nameAr = $request->nameAr;
    $book->nameEn = $request->nameEn;
    $book->numberOfPages = $request->numberOfPages;
    $book->shortDescAr = $request->shortDescAr;
    $book->shortDescEn = $request->shortDescEn;
    $book->link = $request->link;
        if($request->image) {
            deleteFile('Book',$book->image);
            $book->image=saveImage('Book',$request->image);
        }
        $book->save();
        if(isset($request->authersIds)) {
           // BookAuthor::where('book_id',$book->id)->delete();
            foreach ($request->authersIds as $row) {
                $this->Book_author($book->id, $row);
            }
        }
        if (isset($request->catIds)) {
            foreach ($request->catIds as $row) {
                $this->Book_cat($book->id, $row);
            }
        }
    return $book;
    }

    /**
     * @param $request
     * @param $Book_id
     * @return mixed
     */
    public function edit_Book($request,$Book_id)
    {
        $book = Book::find($Book_id);
        $book->nameAr = $request->nameAr;
        $book->nameEn = $request->nameEn;
        $book->numberOfPages = $request->numberOfPages;
        $book->shortDescAr = $request->shortDescAr;
        $book->shortDescEn = $request->shortDescEn;
        $book->link = $request->link;
        if($request->image) {
            deleteFile('Book',$book->image);
            $book->image=saveImage('Book',$request->image);
        }
        $book->save();
        if(isset($request->authersIds)) {
            BookAuthor::where('book_id',$book->id)->delete();
            foreach ($request->authersIds as $row) {
                $this->Book_author($book->id, $row);
            }
        }
        if (isset($request->catIds)) {
            BookCat::where('book_id',$book->id)->delete();
            foreach ($request->catIds as $row) {
                $this->Book_cat($book->id, $row);
            }
        }
        return $book;

    }

    /**
     * @param $book_id
     * @param $author_id
     */
    public function Book_author($book_id,$author_id)
    {
            $book_author = new BookAuthor();
            $book_author->book_id = $book_id;
            $book_author->author_id = $author_id;
            $book_author->save();
    }

    /**
     * @param $book_id
     * @param $cat_id
     */
    public function Book_cat($book_id,$cat_id)
    {
        $BookCat = new BookCat();
        $BookCat->book_id = $book_id;
        $BookCat->cat_id = $cat_id;
        $BookCat->save();
    }

}
