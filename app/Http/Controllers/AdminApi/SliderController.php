<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Resources\Admin\SliderResource;
use App\Http\Resources\CategoryResource;
use App\Interfaces\UserInterface;
use App\Models\Slider;
use App\Reposatries\HandleDataReposatry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator, Auth, Artisan, Hash, File, Crypt;
use App\Http\Resources\UserResource;
use App\Models\User;

class SliderController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function add_Slider(Request $request)
    {
        $lang = $request->header('lang');
        $Slider = new Slider();
        if($request->image) {
            deleteFile('Slider',$Slider->image);
            $Slider->image=saveImage('Slider',$request->image);
        }
        $Slider->save();
        $msg=$lang=='ar' ? 'تم اضافه الصوره بنجاح' : 'Slider added successfully!';
        return $this->apiResponseData(new SliderResource($Slider),$msg,200);
    }

    /**
     * @param Request $request
     * @param $Slider_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function edit_Slider(Request $request,$Slider_id)
    {
        $lang = $request->header('lang');
        $Slider = Slider::find($Slider_id);
        if($request->image) {
            deleteFile('Slider',$Slider->image);
            $Slider->image=saveImage('Slider',$request->image);
        }
        $Slider->save();
        $msg=$lang=='ar' ? 'تم تعديل الصوره بنجاح' : 'Slider updated successfully!';
        return $this->apiResponseData(new SliderResource($Slider),$msg,200);
    }

    /**
     * @param $Slider_id
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function delete_Slider($Slider_id,Request $request)
    {
        $lang = $request->header('lang');
        $Slider = Slider::find($Slider_id);
        if(is_null($Slider)){
            $msg=$lang=='ar' ? '  الصوره المطلوبه غير موجوده' : 'Slider does not exist';
            return $this->apiResponseMessage(0,$msg,200);
        }
        deleteFile('Slider',$Slider->image);
        $Slider->delete();
        $msg=$lang=='ar' ? 'تم ازاله الصوره بنجاح' : 'Slider deleted successfully!';
        return $this->apiResponseMessage($msg,200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function All_Slider(Request $request)
    {
        $lang = $request->header('lang');
        $Slider = Slider::get();
        $msg=$lang=='ar' ? 'تمت العمليه بنجاح' : 'success!';
        return $this->apiResponseData(SliderResource::collection($Slider),$msg,200 );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function single_Slider(Request $request){
        $lang = $request->header('lang');
        $Slider=Slider::where('id',$request->Slider_id)->first();
        if(is_null($Slider)){
            $msg=$lang=='ar' ? 'عفوا, الصوره المطلوبه غير موجوده' : 'slider does not exist!';
            return $this->apiResponseMessage(0,$msg,200);
        }
        $msg=$lang=='ar' ? 'تمت العمليه بنجاح' : 'success!';
        return $this->apiResponseData(new SliderResource($Slider),$msg,200);
    }

}
