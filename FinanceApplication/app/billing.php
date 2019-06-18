<?php

namespace App;

use App\Billingtransactions;
use Illuminate\Database\Eloquent\Model;

class billing extends Model
{
    protected $guarded = [];

    static function getList($type)
    {
        return billing::where('billingtype',$type)->get();
    }
    static function getTotal($id)
    {
        return Billingtransactions::where('billingid',$id)->sum('overalltotal');
    }
    static function getMaxNo()
    {
        return billing::max('billingno') + 1;
    }
    static function getNo($id)
    {
        $c = billing::where('id',$id)->count();
        if($c!=0)
        {
            $w = billing::where('id',$id)->get();
            return $w[0]['billingno'];
        }
        else
        {
            return "#";
        }
    }
    static function getIncomingCount()
    {
        return billing::where('billingtype',BILLING_INCOMING)->count();
    }
    static function getOutgoingCount()
    {
        return billing::where('billingtype',BILLING_OUTGOING)->count();
    }
}
