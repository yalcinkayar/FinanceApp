<?php

namespace App\Http\Controllers\front\item;

use App\Item;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class indexController extends Controller
{
    public function index()
    {
        return view('front.item.index');
    }
    public function create()
    {
        return view('front.item.create');
    }
    public function store(Request $request)
    {
        $all = $request->except('_token');
        $create = Item::create($all);
        if($create)
        {
            return redirect()->back()->with('status','Item was successfully added');
        }
        else
        {
            return redirect()->back()->with('status','Item was not added');
        }
    }
    public function edit($id)
    {
        $c = Item::where('id',$id)->count();
        if($c !=0)
        {
            $data = Item::where('id',$id)->get();
            return view('front.item.edit',['data'=>$data]);
        }
        else
        {
            return redirect('/');
        }
    }
    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = Item::where('id',$id)->count();
        if($c !=0)
        {
            $all = $request->except('_token');
            $data = Item::where('id',$id)->get();
            $update = Item::where('id',$id)->update($all);
            if($update)
            {
                return redirect()->back()->with('status','Item was edited');
            }
            else
            {
                return redirect()->back()->with('status','Item was not edited');
            }
        }
        else
        {
            return redirect('/');
        }
    }
    public function delete($id)
    {
        $c = Item::where('id',$id)->count();
        if($c !=0)
        {
            $data = Item::where('id',$id)->get();
            Item::where('id',$id)->delete();
            return redirect()->back();
        }
        else
        {
            return redirect('/');
        }
    }

    public function data(Request $request)
    {
        $table = Item::query();
        $data = DataTables::of($table)
            ->addColumn('edit',function ($table){
                return '<a href="'.route('item.edit',['id'=>$table->id]).'">Edit</a>';
            })
            ->addColumn('delete',function ($table){
                return '<a href="'.route('item.delete',['id'=>$table->id]).'">Delete</a>';
            })

            ->editColumn('itemtype',function ($table){
                if($table->itemtype == 0) { return "Incoming";}else { return "Outgoing";}
            })
            ->rawColumns(['edit','delete','itemtype'])
            ->make(true);
        return $data;
    }

}
