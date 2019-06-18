<?php

namespace App\Http\Controllers\front\offers;

use App\Customers;
use App\Offercontents;
use App\Offers;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class indexController extends Controller
{
    public function index()
    {
        return view('front.offers.index');
    }
    public function create()
    {
        return view('front.offers.create');
    }
    public function store(Request $request)
    {
        $all = $request->except('_token');
        $products = $all['products'];
        unset($all['products']);
        //$all['userid'] = Auth::id();
        $create = Offers::create($all);
        if($create)
        {
            foreach ($products as $k => $v)
            {
                Offercontents::create(['offerid'=>$create->id,'productid'=>$v['productid'],'quantity'=>$v['quantity']]);
            }
            return redirect()->back()->with('status','Offer was successfully added');
        }
        else
        {
            return redirect()->back()->with('status','Offer was not added');
        }
    }
    public function edit($id)
    {
        $c = Offers::where('id',$id)->count();
        if($c !=0)
        {
            $data = Offers::where('id',$id)->get();
            $content = Offercontents::where('offerid',$id)->get();
            return view('front.offers.edit',['data'=>$data,'content'=>$content]);
        }
        else
        {
            return redirect('/');
        }
    }
    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = Offers::where('id',$id)->count();
        if($c !=0)
        {
            $all = $request->except('_token');
            $products = $all['products'];
            unset($all['products']);
            Offercontents::where('offerid',$id)->delete();
            foreach ($products as $k => $v)
            {
                Offercontents::create(['offerid'=>$id,'productid'=>$v['productid'],'quantity'=>$v['quantity']]);
            }
            $update = Offers::where('id',$id)->update($all);
            if($update)
            {
                return redirect()->back()->with('status','Offer was edited');
            }
            else
            {
                return redirect()->back()->with('status','Offer was not edited');
            }
        }
        else
        {
            return redirect('/');
        }
    }
    public function delete($id)
    {
        $c = Offers::where('id',$id)->count();
        if($c !=0)
        {
            Offers::where('id',$id)->delete();
            Offercontents::where('offerid',$id)->delete();
            return redirect()->back();
        }
        else
        {
            return redirect('/');
        }
    }

    public function data(Request $request)
    {
        $table = Offers::query();
        $data = DataTables::of($table)
            ->addColumn('customer',function($table)
            {
                return Customers::getPublicName($table->customerid);
            })
            ->addColumn('edit',function ($table){
                return '<a href="'.route('offers.edit',['id'=>$table->id]).'">Edit</a>';
            })
            ->addColumn('delete',function ($table){
                return '<a href="'.route('offers.delete',['id'=>$table->id]).'">Delete</a>';
            })

            ->editColumn('status',function ($table){
                return($table->status == 0)?'Waiting':'Accepted';
            })
            ->rawColumns(['edit','delete'])
            ->make(true);
        return $data;
    }

}
