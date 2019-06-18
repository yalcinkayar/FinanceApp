<?php

namespace App\Http\Controllers\front\billing;

use App\billing;
use App\Billingtransactions;
use App\Customers;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class indexController extends Controller
{
    public function index()
    {
        return view('front.billing.index');
    }
    public function create($type)
    {

        if($type == 0)
        {
            return view('front.billing.Incoming.create');
        }
        else
        {
            return view('front.billing.Outgoing.create');
        }

    }
    public function store(Request $request)
    {
        $type = $request->route('type');
        $all = $request->except('_token');
        $operation = $all['operation'];
        unset($all['operation']);
        $all['billingtype'] = $type;
        $c = billing::where('billingno',$all['billingno'])->count();
        if($c==0) {
            $create = billing::create($all);
            if ($create) {
                if (count($operation) != 0) {
                    foreach ($operation as $k => $v) {
                        $operationArray = [
                            'billingid' => $create->id,
                            'itemid' => $v['itemid'],
                            'productid' => $v['productid'],
                            'amount' => $v['day_quantity'],
                            'price' => $v['price'],
                            'tax' => $v['tax'],
                            'subtotal' => $v['subtotal'],
                            'total_taxed' => $v['total_taxed'],
                            'overalltotal' => $v['overalltotal'],
                            'text' => $v['text']
                        ];
                        Billingtransactions::create($operationArray);
                    }
                }
                return redirect()->back()->with('status', 'Billing was added');
            } else {
                return redirect()->back()->with('status', 'Billing was not added');
            }
        }
        else
        {
            return redirect()->back()->with('status','This billing is available');
        }

    }
    public function edit($id)
    {
        $c = billing::where('id',$id)->count();
        if($c !=0)
        {
            $data = billing::where('id',$id)->get();
            $operation = Billingtransactions::where('billingid',$id)->get();
            if($data[0]['billingtype'] == 0) {
                return view('front.billing.Incoming.edit',['data'=>$data,'operation'=>$operation]);
            }
            else
            {
                return view('front.billing.Outgoing.edit',['data'=>$data,'operation'=>$operation]);
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
        $c = billing::where('id',$id)->count();
        if($c != 0)
        {
            $all  =  $request->except('_token');
            $operation = $all['operation'];
            unset($all['operation']);
            $data = billing::where('id',$id)->get();

            if(count($operation)!=0) {
                Billingtransactions::where('billingid',$id)->delete();
                foreach ($operation as $k => $v) {
                    $operationArray = [
                        'billingid' => $id,
                        'itemid' => $v['itemid'],
                        'productid' => $v['productid'],
                        'amount' => $v['day_quantity'],
                        'price' => $v['price'],
                        'tax' => $v['tax'],
                        'subtotal' => $v['subtotal'],
                        'total_taxed' => $v['total_taxed'],
                        'overalltotal' => $v['overalltotal'],
                        'text' => $v['text']
                    ];
                    Billingtransactions::create($operationArray);
                }
            }
            $update = billing::where('id',$id)->update($all);
            return redirect()->back()->with('status','Editing Billing was successful');

        }
        else
        {
            return redirect('/');
        }
    }
    public function delete($id)
    {
        $c = billing::where('id',$id)->count();
        if($c !=0)
        {
            $data = billing::where('id',$id)->get();
            billing::where('id',$id)->delete();
            Billingtransactions::where('billingid',$id)->delete();
            return redirect()->back();
        }
        else
        {
            return redirect('/');
        }
    }

    public function data(Request $request)
    {
        $table = billing::query();
        $data = DataTables::of($table)
            ->addColumn('edit',function ($table){
                return '<a href="'.route('billing.edit',['id'=>$table->id]).'">Edit</a>';
            })
            ->addColumn('delete',function ($table){
                return '<a href="'.route('billing.delete',['id'=>$table->id]).'">Delete</a>';
            })
            ->addColumn('customer',function ($table){
                return Customers::getPublicName($table->customerid);
            })
            ->editColumn('billingtype',function ($table){
                if($table->billingtype == 0) { return "Incoming";}else { return "Outgoing";}
            })
            ->rawColumns(['edit','delete','billingtype'])
            ->make(true);
        return $data;
    }

}
