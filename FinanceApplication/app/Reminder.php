<?php

namespace App;

use App\billing;
use App\Operations;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    static function BillingReminder()
    {
        $returnArray = [];
        if(billing::count() !=0)
        {
            $list = billing::all();
            foreach ($list as $k => $v)
            {
                if($v['billingtype'] == 0)
                {
                    // Gelir Faturası
                    $c = Operations::where('operationtype',TRANSACTION_COLLECTION)->where('billingid',$v['id'])->count();
                    $type = "Incoming Billing";
                    $uri = route('operations.create',['type'=>TRANSACTION_COLLECTION]);
                }
                else
                {
                    // Gider Faturası
                    $c = Operations::where('operationtype',TRANSACTION_PAYMENT)->where('billingid',$v['id'])->count();
                    $type = "Outgoing Billing";
                    $uri = route('operations.create',['type'=>TRANSACTION_PAYMENT]);
                }
                if($c == 0)
                {
                    $returnArray[$k]['name'] = $v['billingno']." - ".$type;
                    $returnArray[$k]['customerid'] = $v['customerid'];
                    $returnArray[$k]['price'] = billing::getTotal($v['id']);
                    $returnArray[$k]['uri'] = $uri;
                }
            }
        }
        return $returnArray;
    }
}