<?php

namespace Marvel;

use Illuminate\Support\Facades\App;

class Shop
{
    public $request;

    public function __construct()
    {
        $this->request = app()->request;
    }

    /**
     * @param $action string
     * @param $data array
     * @return array
     */
    public function call($action, $data)
    {
        if (!is_array($data)) {
            return [];
        }
        if (!empty($data) && is_array($data)) {
            $this->request->request->add($data);
        }
        return App::call(config('shop.controllers') . $action);
    }
}
