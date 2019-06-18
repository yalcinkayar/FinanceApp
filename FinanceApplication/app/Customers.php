<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $guarded = [];

    static function getPublicName($id)
    {
        $data = Customers::where('id',$id)->get();
        if($data[0]['customerType'] == 0){
            return $data[0]['firstname']." ".$data[0]['lastname'];
        }
        else
        {
            return $data[0]['companyname'];
        }
    }
    static function getPhoto($id)
    {
        $data = Customers::where('id',$id)->get();
        if($data[0]['photo']!="")
        {
            return $data[0]['photo'];
        }
        else
        {
            return "assets/demo/users/user1.jpg";
        }
    }
}
