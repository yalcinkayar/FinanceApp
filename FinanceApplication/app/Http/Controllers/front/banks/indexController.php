<?php

namespace App\Http\Controllers\front\banks;

use App\Banks;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class indexController extends Controller
{
    public function index()
    {
        return view('front.banks.index');
    }
    public function create()
    {
        return view('front.banks.create');
    }
    public function store(Request $request)
    {
        $all = $request->except('_token');
        $create = Banks::create($all);
        if($create)
        {
            return redirect()->back()->with('status','Bank was successfully added');
        }
        else
        {
            return redirect()->back()->with('status','Bank was not added');
        }
    }
    public function edit($id)
    {
        $c = Banks::where('id',$id)->count();
        if($c !=0)
        {
            $data = Banks::where('id',$id)->get();
            return view('front.banks.edit',['data'=>$data]);
        }
        else
        {
            return redirect('/');
        }
    }
    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = Banks::where('id',$id)->count();
        if($c !=0)
        {
            $all = $request->except('_token');
            $data = Banks::where('id',$id)->get();
            $update = Banks::where('id',$id)->update($all);
            if($update)
            {
                return redirect()->back()->with('status','Bank was edited');
            }
            else
            {
                return redirect()->back()->with('status','Bank was not edited');
            }
        }
        else
        {
            return redirect('/');
        }
    }
    public function delete($id)
    {
        $c = Banks::where('id',$id)->count();
        if($c !=0)
        {
            $data = Banks::where('id',$id)->get();
            Banks::where('id',$id)->delete();
            return redirect()->back();
        }
        else
        {
            return redirect('/');
        }
    }

    public function data(Request $request)
    {
        $table = Banks::query();
        $data = DataTables::of($table)
            ->addColumn('edit',function ($table){
                return '<a href="'.route('banks.edit',['id'=>$table->id]).'">Edit</a>';
            })
            ->addColumn('delete',function ($table){
                return '<a href="'.route('banks.delete',['id'=>$table->id]).'">Delete</a>';
            })

            ->rawColumns(['edit','delete'])
            ->make(true);
        return $data;
    }

}
