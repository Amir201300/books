<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\BookResource;
use App\Http\Resources\CategoryResource;
use App\Interfaces\UserInterface;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
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
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function singleBook(Request $request){
        $book=Book::where('status',1)->where('id',$request->book_id)->first();
        if(is_null($book)){
            return $this->apiResponseMessage(0,'data not found',200);
        }
        return $this->apiResponseData(new BookResource($book),'success',200);
    }

    /**
     * @param Request $request
     * @param HandleDataReposatry $dataReposatry
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|mixed
     */
    public function booksByCat(Request $request,HandleDataReposatry $dataReposatry){
        $cat=Category::where('status',1)->where('id',$request->cat_id)->first();
        if(is_null($cat)){
            return $this->apiResponseMessage(0,'data not found',200);
        }
        $books=Book::whereHas('cats',function($q) use ($request){
            $q->where('cat_id',$request->cat_id);
        })->where('status',1)->orderBy('id','desc');
        return $dataReposatry->getAllData($books,$request,new BookResource(null));
    }

    /**
     * @param Request $request
     * @param HandleDataReposatry $dataReposatry
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|mixed
     */
    public function booksByAuthors(Request $request,HandleDataReposatry $dataReposatry){
        $cat=Author::where('status',1)->where('id',$request->author_id)->first();
        if(is_null($cat)){
            return $this->apiResponseMessage(0,'data not found',200);
        }
        $books=Book::whereHas('authors',function($q) use ($request){
            $q->where('author_id',$request->author_id);
        })->where('status',1)->orderBy('id','desc');
        return $dataReposatry->getAllData($books,$request,new BookResource(null));
    }

}
