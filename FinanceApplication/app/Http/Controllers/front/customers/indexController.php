<?php

namespace App\Http\Controllers\front\customers;
use App\Billingtransactions;
use App\Helper\fileUpload;
use App\Logger;
use App\Customers;

use App\Operations;
use App\Reports;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class indexController extends Controller
{
    public function index()
    {
        return view('front.customers.index');
    }
    public function create()
    {
        return view('front.customers.create');
    }
    public function store(Request $request)
    {
        $all = $request->except('_token');
        $all['photo'] = fileUpload::newUpload(rand(1,9000),'customers',$request->file('photo'),0);
        $create = Customers::create($all);
        if($create)
        {
           // Logger::Insert("Customer was added","Customer");
            return redirect()->back()->with('status','Customer was successfully added');
        }
        else
        {
            return redirect()->back()->with('status','Customer was not added');
        }
    }
    public function edit($id)
    {
        $c = Customers::where('id',$id)->count();
        if($c !=0)
        {
            $data = Customers::where('id',$id)->get();
            return view('front.customers.edit',['data'=>$data]);
        }
        else
        {
            return redirect('/');
        }
    }
    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = Customers::where('id',$id)->count();
        if($c !=0)
        {
            $all = $request->except('_token');
            $data = Customers::where('id',$id)->get();
            $all['photo'] = fileUpload::changeUpload(rand(1,9000),"customers",$request->file('photo'),0,$data,"photo");
            $update = Customers::where('id',$id)->update($all);
            if($update)
            {
                //Logger::Insert(Customers::getPublicName($id)." It did not edited","Customer");
                return redirect()->back()->with('status','Customer was edited');
            }
            else
            {
                return redirect()->back()->with('status','Customer was not edited');
            }
        }
        else
        {
            return redirect('/');
        }
    }
    public function delete($id)
    {
        $c = Customers::where('id',$id)->count();
        if($c !=0)
        {
            $data = Customers::where('id',$id)->get();
            //Logger::Insert(Customers::getPublicName($data[0]['id'])." Silindi","Müşteri");
            fileUpload::directoryDelete($data[0]['photo']);
            Customers::where('id',$id)->delete();
            return redirect()->back();
        }
        else
        {
            return redirect('/');
        }
    }

    public function data(Request $request)
    {
        $table = Customers::query();
        $data = DataTables::of($table)
            ->addColumn('edit',function ($table){
                return '<a href="'.route('customers.edit',['id'=>$table->id]).'">Edit</a>';
            })
            ->addColumn('delete',function ($table){
                return '<a href="'.route('customers.delete',['id'=>$table->id]).'">Delete</a>';
            })
            ->addColumn('customername',function ($table){
                return Customers::getPublicName($table->id);
            })
            ->addColumn('balance',function ($table){
                $balance = Reports::getCustomerBalance($table->id);
                if($balance  < 0)
                {
                    return '<span style="color:red">'.$balance .'</span>';
                }
                elseif($balance > 0){
                    return '<span style="color:green">+ '.$balance.'</span>';
                }
                else
                {
                    return $balance;
                }
            })
             ->addColumn('extra',function ($table){
                  return '<a href="'.route('customers.extra',['id'=>$table->id]).'">Extra</a>';
              })

            ->editColumn('customerType',function ($table){
                if($table->customerType == 0) { return "Individual";}else { return "Corporate";}
            })
            ->rawColumns(['edit','delete','balance','extra'])
            ->make(true);
        return $data;
    }
    public function extra($id)
    {
        $c = Customers::where('id',$id)->count();
        if($c!=0)
        {
            $data = Customers::where('id',$id)->get();
            $billingTable = Billingtransactions::leftJoin('billings','billingtransactions.billingid','=','billings.id')
                ->where('billings.customerid',$id)
                ->groupBy('billings.id')
                ->orderBy('billings.billingdate','desc')
                ->select(['billings.id as id','billings.billingtype as type',
                    DB::raw('"billing" as uType'),
                    DB::raw('SUM(overalltotal) as price'),'billings.billingdate as date']);
            $operationTable = Operations::where('customerid',$id)
                ->orderBy('date','desc')
                ->select(['id','operationtype as type',
                    DB::raw('"operation" as uType'),'price','date']);
            $viewData = $billingTable->union($operationTable)
                ->orderBy('date','desc')
                ->get();
            return view('front.customers.extra',['data'=>$data,'viewData'=>$viewData]);
        }
        else
        {
            return redirect('/');
        }
    }
}