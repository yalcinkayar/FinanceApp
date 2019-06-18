<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];
    static function getList($type)
    {
        $list = Item::where('itemtype',$type)->get();
        return $list;
    }
}
