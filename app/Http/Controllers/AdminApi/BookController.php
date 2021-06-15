<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Resources\Admin\BookResource;
use App\Http\Resources\CategoryResource;
use App\Interfaces\BookInterface;
use App\Models\Book;
use App\Reposatries\HandleDataReposatry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator, Auth, Artisan, Hash, File, Crypt;
use App\Http\Resources\UserResource;
use App\Models\User;

class BookController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function add_Book(Request $request,BookInterface $book)
    {
        $lang = $request->header('lang');
        $new_book=$book->add_Book($request);
        $msg=$lang=='ar' ? 'تم اضافه الكتاب بنجاح' : 'Book added successfully!';
        return $this->apiResponseData(new BookResource($new_book),$msg,200);
    }

    /**
     * @param Request $request
     * @param BookInterface $book
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function edit_Book(Request $request,BookInterface $book,$Book_id)
    {
        $lang = $request->header('lang');
        $new_book=$book->edit_Book($request,$Book_id);
        $msg=$lang=='ar' ? 'تم تعديل الكتاب بنجاح' : 'Book updated successfully!';
        return $this->apiResponseData(new BookResource($new_book),$msg,200);
    }

}
