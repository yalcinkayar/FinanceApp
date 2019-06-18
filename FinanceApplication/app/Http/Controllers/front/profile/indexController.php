<?php

namespace App\Http\Controllers\front\profile;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class indexController extends Controller
{
    public function index()
    {
        return view('front.profile.index');
    }
    public function update(Request $request)
    {
        $all = $request->except('_token');
        if($all['password']==""){
            unset($all['password']);
        }
        else
        {
            $all['password'] = md5($all['password']);
        }
        $data = User::where('id',Auth::id())->get();
        $all['photo'] = fileUpload::changeUpload(rand(1,9000),"profile",$request->file('photo'),0,$data,"photo");
        $update = User::where('id',Auth::id())->update($all);
        return redirect()->back();
    }
}