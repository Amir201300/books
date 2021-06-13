<?php

/**
 * @return string
 */
function get_baseUrl()
{
    return url('/');
}

/**
 * @return mixed
 */
function get_user_lang()
{
    return Auth::user()->lang;
}

/**
 * @param $request
 * @return mixed
 */
function getTitleOfBookPage($request){
    $data=null;
    if($request->cat_id)
        $data=\App\Models\Category::find($request->cat_id);
    if($request->author_id)
        $data=\App\Models\Author::find($request->author_id);
    if($data)
        return $request->header('lang') =='en' ? $data->nameEn : $data->nameAr;

}