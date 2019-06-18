<?php

namespace App\Http\Controllers\front\products;

use App\Billingtransactions;
use App\Products;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class indexController extends Controller
{
    public function index()
    {
        return view('front.products.index');
    }
    public function create()
    {
        return view('front.products.create');
    }
    public function store(Request $request)
    {
        $all = $request->except('_token');
        $create = Products::create($all);
        if($create)
        {
           // Logger::Insert($all['productName']." Product was added","Product");
            return redirect()->back()->with('status','Product was successfully added');
        }
        else
        {
            return redirect()->back()->with('status','Item was not added');
        }
    }
    public function edit($id)
    {
        $c = Products::where('id',$id)->count();
        if($c !=0)
        {
            $data = Products::where('id',$id)->get();
            return view('front.products.edit',['data'=>$data]);
        }
        else
        {
            return redirect('/');
        }
    }
    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = Products::where('id',$id)->count();
        if($c !=0)
        {
            $all = $request->except('_token');
            $data = Products::where('id',$id)->get();
            $update = Products::where('id',$id)->update($all);
            if($update)
            {
                //Logger::Insert($data[0]['productName']." Product was edited","Product");
                return redirect()->back()->with('status','Product was edited');
            }
            else
            {
                return redirect()->back()->with('status','Product was not edited');
            }
        }
        else
        {
            return redirect('/');
        }
    }
    public function delete($id)
    {
        $c = Products::where('id',$id)->count();
        if($c !=0)
        {
            $data = Products::where('id',$id)->get();
            //Logger::Insert($data[0]['productName']." Product was deleted","Product");
            Products::where('id',$id)->delete();
            return redirect()->back();
        }
        else
        {
            return redirect('/');
        }
    }
    public function data(Request $request)
    {
        $table = Products::query();
        $data = DataTables::of($table)
            ->addColumn('edit',function ($table){
                return '<a href="'.route('products.edit',['id'=>$table->id]).'">Edit</a>';
            })
            ->addColumn('delete',function ($table){
                return '<a href="'.route('products.delete',['id'=>$table->id]).'">Delete</a>';
            })
            ->addColumn('stock',function ($table){
                $incoming = Billingtransactions::leftJoin('billings','billingtransactions.billingid','billings.id')
                    ->where('billingtransactions.productid',$table->id)
                    ->where('billings.billingtype',BILLING_OUTGOING)
                    ->sum('billingtransactions.amount');
                $outgoing = Billingtransactions::leftJoin('billings','billingtransactions.billingid','billings.id')
                    ->where('billingtransactions.productid',$table->id)
                    ->where('billings.billingtype',BILLING_INCOMING)
                    ->sum('billingtransactions.amount');
                return $incoming - $outgoing;
            })
            ->rawColumns(['edit','delete'])
            ->make(true);
        return $data;
    }
}
