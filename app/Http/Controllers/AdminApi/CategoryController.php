<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Resources\Admin\CategoryResource;
use App\Interfaces\UserInterface;
use App\Models\Category;
use App\Reposatries\HandleDataReposatry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator, Auth, Artisan, Hash, File, Crypt;
use App\Http\Resources\UserResource;
use App\Models\User;

class CategoryController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function add_Category(Request $request)
    {
        $lang = $request->header('lang');
        $Category = new Category();
        $Category->nameAr = $request->nameAr;
        $Category->nameEn = $request->nameEn;
        $Category->status = $request->status;
        $Category->save();
        $msg=$lang=='ar' ? 'تم اضافه القسم بنجاح' : 'Category added successfully!';
        return $this->apiResponseData(new CategoryResource($Category),$msg,200);
    }

    /**
     * @param Request $request
     * @param $Category_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function edit_Category(Request $request,$Category_id)
    {
        $lang = $request->header('lang');
        $Category = Category::find($Category_id);
        $Category->nameAr = $request->nameAr;
        $Category->nameEn = $request->nameEn;
        $Category->status = $request->status;
        $Category->save();
        $msg=$lang=='ar' ? 'تم تعديل القسم بنجاح' : 'Category updated successfully!';
        return $this->apiResponseData(new CategoryResource($Category),$msg,200);
    }

    /**
     * @param $Category_id
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function delete_Category($Category_id,Request $request)
    {
        $lang = $request->header('lang');
        $Category = Category::find($Category_id);
        if(is_null($Category)){
            $msg=$lang=='ar' ? '  القسم المطلوب غير موجود' : 'Category does not exist';
            return $this->apiResponseMessage(0,$msg,200);
        }
        $Category->delete();
        $msg=$lang=='ar' ? 'تم ازاله القسم بنجاح' : 'Category deleted successfully!';
        return $this->apiResponseMessage($msg,200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function All_Category(Request $request)
    {
        $lang = $request->header('lang');
        $Category = Category::get();
        $msg=$lang=='ar' ? 'تمت العمليه بنجاح' : 'success!';
        return $this->apiResponseData(CategoryResource::collection($Category),$msg,200 );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function single_Category(Request $request){
        $lang = $request->header('lang');
        $Category=Category::where('status',1)->where('id',$request->Category_id)->first();
        if(is_null($Category)){
            $msg=$lang=='ar' ? 'عفوا, القسم المطلوب غير موجود' : 'Category does not exist!';
            return $this->apiResponseMessage(0,$msg,200);
        }
        $msg=$lang=='ar' ? 'تمت العمليه بنجاح' : 'success!';
        return $this->apiResponseData(new CategoryResource($Category),$msg,200);
    }

}
