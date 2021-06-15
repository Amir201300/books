<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Resources\Admin\UserResource;
use App\Interfaces\UserInterface;
use App\Models\User;
use App\Reposatries\HandleDataReposatry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator, Auth, Artisan, Hash, File, Crypt;

class UserController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @param $User_id
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function delete_User($User_id,Request $request)
    {
        $lang = $request->header('lang');
        $User = User::find($User_id);
        if(is_null($User)){
            $msg=$lang=='ar' ? '  العضو المطلوب غير موجود' : 'User does not exist';
            return $this->apiResponseMessage(0,$msg,200);
        }
        $User->delete();
        $msg=$lang=='ar' ? 'تم ازاله العضو بنجاح' : 'User deleted successfully!';
        return $this->apiResponseMessage($msg,200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function All_User(Request $request)
    {
        $lang = $request->header('lang');
        $User = User::get();
        $msg=$lang=='ar' ? 'تمت العمليه بنجاح' : 'success!';
        return $this->apiResponseData(UserResource::collection($User),$msg,200 );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function single_User(Request $request){
        $lang = $request->header('lang');
        $User=User::where('id',$request->User_id)->first();
        if(is_null($User)){
            $msg=$lang=='ar' ? 'عفوا, العضو المطلوب غير موجود' : 'User does not exist!';
            return $this->apiResponseMessage(0,$msg,200);
        }
        $msg=$lang=='ar' ? 'تمت العمليه بنجاح' : 'success!';
        return $this->apiResponseData(new UserResource($User),$msg,200);
    }

}
