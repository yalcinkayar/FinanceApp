<?php
namespace App\Http\Controllers\front\chart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Charts;
use App\Billingtransactions;
use Illuminate\Support\Facades\DB;
use App\Customers;


class indexController extends Controller
{
    public function index()
    {
        //  dd($data);
        /*Billingtransactions::select(
            DB::raw('sum(price)as sums'),
            DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")
            )
            ->sum('price')
            ->groupBy('months')
            ->get();*/


        /*$users = Billingtransactions::select('created_at',DB::raw('count(price)'))
            ->where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
            ->groupBy('created_at')
            ->get();
        */
        $data = Billingtransactions::select(
                \DB::raw('MONTH(created_at) as months'),
                \DB::raw("Sum(price) as sums")
            )
            ->groupBy('months')
            ->orderBy('months','asc')
            ->get();

        $chart = Charts::database($data, 'bar', 'highcharts')
            ->title("Monthly Amount")
            ->elementLabel("Total Amount")
            ->dimensions(300, 500)
            ->responsive(false)
            ->groupBy('months');

       /* $data = Billingtransactions::select(DB::raw('billingid'),DB::raw('sum(price) as sums'))
                ->groupBy('billingid')
                ->get();

        $chart = Charts::database($data, 'bar', 'highcharts')
            ->title('Billing Data')
            ->dimensions(700, 300)
            ->responsive(true)
            ->groupBy('billingid');
       */
        return view('front.chart.index',compact('chart'));
    }
}