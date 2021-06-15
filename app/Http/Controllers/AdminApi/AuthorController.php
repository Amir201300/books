<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Resources\AuthorResource;
use App\Http\Resources\CategoryResource;
use App\Interfaces\UserInterface;
use App\Models\Author;
use App\Reposatries\HandleDataReposatry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator, Auth, Artisan, Hash, File, Crypt;
use App\Http\Resources\UserResource;
use App\Models\User;

class AuthorController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
public function add_Author(Request $request)
{
    $lang = $request->header('lang');
    $Author = new Author();
    $Author->nameAr = $request->nameAr;
    $Author->nameEn = $request->nameEn;
    $Author->birth_date = $request->birth_date;
    $Author->death_date = $request->death_date;
    $Author->status = $request->status;
    $Author->aboutAuthorEn = $request->aboutAuthorEn;
    $Author->aboutAuthorAr = $request->aboutAuthorAr;
    if($request->image) {
        deleteFile('Author',$Author->image);
        $Author->image=saveImage('Author',$request->image);
    }
    $Author->save();
    $msg=$lang=='ar' ? 'تم اضافه المؤلف بنجاح' : 'Author added successfully!';
    return $this->apiResponseData(new AuthorResource($Author),$msg,200);
}

    /**
     * @param Request $request
     * @param $Author_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
public function edit_Author(Request $request,$Author_id)
{
    $lang = $request->header('lang');
    $Author = Author::find($Author_id);
    $Author->nameAr = $request->nameAr;
    $Author->nameEn = $request->nameEn;
    $Author->birth_date = $request->birth_date;
    $Author->death_date = $request->death_date;
    $Author->status = $request->status;
    $Author->aboutAuthorEn = $request->aboutAuthorEn;
    $Author->aboutAuthorAr = $request->aboutAuthorAr;
    if($request->image) {
        deleteFile('Author',$Author->image);
        $Author->image=saveImage('Author',$request->image);
    }
    $Author->save();
    $msg=$lang=='ar' ? 'تم تعديل المؤلف بنجاح' : 'Author updated successfully!';
    return $this->apiResponseData(new AuthorResource($Author),$msg,200);
}

    /**
     * @param $Author_id
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
 public function delete_Author($Author_id,Request $request)
 {
     $lang = $request->header('lang');
     $Author = Author::find($Author_id);
     if(is_null($Author)){
         $msg=$lang=='ar' ? '  المؤلف المطلوب غير موجود' : 'author does not exist';
         return $this->apiResponseMessage(0,$msg,200);
     }
     deleteFile('Author',$Author->image);
     $Author->delete();
     $msg=$lang=='ar' ? 'تم ازاله المؤلف بنجاح' : 'Author deleted successfully!';
     return $this->apiResponseMessage($msg,200);
 }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
public function All_Authors(Request $request)
{
    $lang = $request->header('lang');
    $Author = Author::get();
    $msg=$lang=='ar' ? 'تمت العمليه بنجاح' : 'success!';
    return $this->apiResponseData(AuthorResource::collection($Author),$msg,200 );
}

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function single_Author(Request $request){
        $lang = $request->header('lang');
        $Author=Author::where('status',1)->where('id',$request->Author_id)->first();
        if(is_null($Author)){
            $msg=$lang=='ar' ? 'عفوا, المؤلف المطلوب غير موجود' : 'author does not exist!';
            return $this->apiResponseMessage(0,$msg,200);
        }
        $msg=$lang=='ar' ? 'تمت العمليه بنجاح' : 'success!';
        return $this->apiResponseData(new AuthorResource($Author),$msg,200);
    }

}
