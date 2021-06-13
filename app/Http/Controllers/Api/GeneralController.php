<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\AuthorResource;
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

class GeneralController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function home()
    {
        $new = Book::where('isNew', 1)->where('status', 1)->take(20)->get();
        $mostDownload = Book::where('download', '>', 5)->orderBy('download', 'desc')->take(20)->get();
        $data = [
            'new' => BookResource::collection($new),
            'mostDownload' => BookResource::collection($mostDownload)
        ];
        return $this->apiResponseData($data, 'success', 200);
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function cats(){
        $cats=Category::where('status',1)->get();
        return $this->apiResponseData(CategoryResource::collection($cats),'success',200);
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function authors(){
        $authors=Author::where('status',1)->get();
        return $this->apiResponseData(AuthorResource::collection($authors),'success',200);
    }

}
