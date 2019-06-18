<?php
namespace App\Http\Controllers\front\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class indexController extends Controller
{
    public function index()
    {
        return view('front.home.index');
       /* $chart = new SampleChart;
        $chart->labels(['One', 'Two', 'Three', 'Four']);
        $chart->dataset('My dataset', 'line', [1, 2, 3, 4]);
        $chart->dataset('My dataset 2', 'line', [4, 3, 2, 1]);
        return view('front.home.index',['chart'=>$chart]);
       */
    }
}