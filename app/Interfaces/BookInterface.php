<?php

namespace App\Interfaces;

use http\Env\Request;

interface BookInterface {
    /**
     * @param $request
     * @return mixed
     */
    public function add_Book($request);

    /**
     * @param $request
     * @param $Book_id
     * @return mixed
     */
    public function edit_Book($request,$Book_id);

}
