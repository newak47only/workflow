<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Dept,App\Information,App\Emp,App\Negotiation,App\Recode;

use Auth,DB;

use Carbon\Carbon;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $admin = Auth::user();
        $dept = Dept::where('id',$admin->dept_id)->firstOrFail();
        $dept_name = $dept->dept_name;
        //dd($dept->director_id);
        if($admin->dept_id == '6'){
            $status = 0;


        }elseif ($admin->id == $dept->director_id && $dept->id != '6') {
            $status = 1;
 
        }else{
            $status =2;

        }
        //dd($status);
        return view('index')->with(compact('status','dept_name'));

    }

    public function welcome()
    {
        
        $admin_id=Auth::user()->id;
        $info_count = Information::where('emp_id', $admin_id)->count();
        //dd($info_count);
        $nego_count = Information::where([
            ['emp_id','=',$admin_id],
            ['process','=','0'],

        ])->count();
        $cir_count = Negotiation::where([
            ['director_id','=',$admin_id],
            ['actiontype','=','5'],
            ['result','=','0'],
        ])->count();
        //dd($info_nego_count);
        $info_nego_count = $nego_count+$cir_count;
        //dd($info_nego_count);
        $info_cir_count = Information::where('emp_id',$admin_id)->whereIn('process',[1,10])->count();
        $info_land_count = Information::where([
            ['emp_id','=',$admin_id],
            ['process','>=','2'],
        ])->count();

        $startTime = Carbon::now()->startOfDay();
        $endTime = Carbon::now()->endOfDay();
        //dd($endTime);
        $info_new_count = Information::where('emp_id', $admin_id)->whereBetween('created_at',[$startTime,$endTime])->count();
        $recode_count =Recode::where('emp_id', $admin_id)->count();


        
        return view('welcome')->with(compact('info_count','info_nego_count','info_cir_count','info_land_count','info_new_count','recode_count'));
        //return view('welcome');
    }
}
