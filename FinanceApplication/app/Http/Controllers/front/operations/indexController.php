<?php

namespace App\Http\Controllers\front\operations;

use App\billing;
use App\Customers;
use App\Operations;

use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class indexController extends Controller
{
    public function index()
    {
        return view('front.operations.index');
    }
    public function create($type)
    {

        if($type == 0)
        {
            return view('front.operations.payment.create');
        }
        else
        {
            return view('front.operations.collection.create');
        }

    }
    public function store(Request $request)
    {
        $all = $request->except('_token');
        $type = $request->route('type');
        $all['operationtype'] = $type;
        $create = Operations::create($all);
        if($create)
        {
            return redirect()->back()->with('status','Operation was added');
        }
        else
        {
            return redirect()->back()->with('status','Operation was not added');
        }
    }
    public function edit($id)
    {
        $c = Operations::where('id',$id)->count();
        if($c!=0)
        {
            $w = Operations::where('id',$id)->get();
            if($w[0]['operationtype'] == 0)
            {
                return view('front.operations.payment.edit',['data'=>$w]);
            }
            else
            {
                return view('front.operations.collection.edit',['data'=>$w]);
            }
        }
        else
        {
            return redirect('/');
        }
    }
    public function update(Request $request)
    {
        $id = $request->route('id');
        $all = $request->except('_token');
        $c = Operations::where('id',$id)->count();
        if($c!=0)
        {
            $data = Operations::where('id',$id)->get();

            Operations::where('id',$id)->update($all);
            return redirect()->back()->with('status','Operation was edited');
        }
        else
        {
            return redirect('/');
        }
    }

    public function data(Request $request)
    {
        $table = Operations::query();
        $data = DataTables::of($table)
            ->addColumn('edit',function ($table){
                return '<a href="'.route('operations.edit',['id'=>$table->id]).'">Edit</a>';
            })
            ->addColumn('delete',function ($table){
                return '<a href="'.route('operations.delete',['id'=>$table->id]).'">Delete</a>';
            })
            ->addColumn('billingno',function ($table){
                return billing::getNo($table->billingno);
            })
            ->addColumn('customer',function ($table){
                return Customers::getPublicName($table->customerid);
            })
            ->editColumn('operationtype',function ($table){
                if($table->operationtype == 0) { return "Payment";}else { return "Collection";}
            })
            ->rawColumns(['edit','delete'])
            ->make(true);
        return $data;
    }
    public function delete($id)
    {
        $c = Operations::where('id',$id)->count();
        if($c!=0)
        {
            $data = Operations::where('id',$id)->get();
            Operations::where('id',$id)->delete();

            return redirect()->back()->with('status','Deletion was successful');
        }
        else
        {
            return redirect('/');
        }
    }
}