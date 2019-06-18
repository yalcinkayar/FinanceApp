<?php

namespace App;

use App\Billingtransactions;
use App\billing;
use App\Operations;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    static function getPayment()
    {
        return Operations::where('operationtype',0)->sum('price');
    }
    static function getCollection()
    {
        return Operations::where('operationtype',1)->sum('price');
    }
    static function getCustomerPayment($id)
    {
        $billing = Billingtransactions::leftJoin('billings','billingtransactions.billingid','=','billings.id')
            ->where('billings.customerid',$id)
            ->where('billings.billingtype',BILLING_OUTGOING)
            ->sum('billingtransactions.overalltotal');
        $operation =  Operations::where('customerid',$id)->where('operationtype',TRANSACTION_PAYMENT)->sum('price');
        return $billing - $operation;
    }
    static function getCustomerCollection($id)
    {
        $billing = Billingtransactions::leftJoin('billings','billingtransactions.billingid','=','billings.id')
            ->where('billings.customerid',$id)
            ->where('billings.billingtype',BILLING_INCOMING)
            ->sum('billingtransactions.overalltotal');
        $operation =  Operations::where('customerid',$id)->where('operationtype',TRANSACTION_COLLECTION)->sum('price');
        return $billing - $operation;
    }
    static function getCustomerBalance($id)
    {
        return   self::getCustomerPayment($id) - self::getCustomerCollection($id);
    }
    static function getBankPayment($id)
    {
        return Operations::where('operationtype',TRANSACTION_PAYMENT)->where('account',$id)->sum('price');
    }
    static function getBankCollection($id)
    {
        return Operations::where('operationtype',TRANSACTION_COLLECTION)->where('account',$id)->sum('price');
    }
    static function getBankBalance($id)
    {
        return self::getBankCollection($id) - self::getBankPayment($id);
    }
    static function returnTest()
    {
        $billingPrice = DB::table('Billingtransactions')
            ->groupby(\DB::raw('MONTH(created_at)'))
            ->sum('price');
        return $billingPrice;
    }
}
