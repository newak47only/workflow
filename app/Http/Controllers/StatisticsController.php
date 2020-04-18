<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Information,App\Emp,App\Dept,App\Negotiation,App\Statistics;
use Auth,DB;

class StatisticsController extends Controller
{
    //
    public function index(){
    	$admin_id=Auth::user()->id;
    	//dd($admin_id);
    	$admin=Emp::where('id',$admin_id)->firstOrFail();
    	//dd($admin->dept->dept_name);

    	//独立完成项目
    	$information=Information::where([
                    ['emp_id','=',$admin_id],
                    ['process','>','3'],
                    ['process','!=','10'],
                    ['circule_id','=','0']
             ])->get();
             //dd($information);
    	
        $info = [];
        foreach ($information as $key => $value) {
            $info[]=[
                'id'=> $value->id,
                'name' => $value->name,
                'cont_name' => $value->cont_name,
                'cont_phone' => $value->cont_phone,
                'emp_id' => $value->emp_id,
                'staff_name' => $value->staff_name,
                'staff_phone' => $value->staff_phone,
                'currency' => $value->currency,
                'investment' => $value->investment,
                'industry' => $value->industry,
                'investment' => $value->investment,
                'status' => $value->status,
                'process' => $value->process,
                'is_show' => $value->is_show,
                'dept' =>$admin->dept->dept_name,
             ]; 
        }

        //流转地项目
        $info1 = [];
        $information1=Information::where([
                    ['circule_id','=',$admin_id],
                    ['process','>','1'],
                    ['process','!=','10'],
             ])->get();
        foreach ($information1 as $key => $value) {
        	$c_emp=Emp::where('id',$value->emp_id)->firstOrFail();
            $info1[]=[
                'id'=> $value->id,
                'name' => $value->name,
                'cont_name' => $value->cont_name,
                'cont_phone' => $value->cont_phone,
                'emp_id' => $value->emp_id,
                'staff_name' => $value->staff_name,
                'staff_phone' => $value->staff_phone,
                'currency' => $value->currency,
                'investment' => $value->investment,
                'industry' => $value->industry,
                'investment' => $value->investment,
                'status' => $value->status,
                'process' => $value->process,
                'is_show' => $value->is_show,
                'circule_f_dept' => $c_emp->dept->dept_name,
                'circule_f_name' => $c_emp->name,
                'circule_f_phone' => $c_emp->phone,
                'circule_n_dept' =>$admin->dept->dept_name,

             ]; 
        }
        //dd($info1);

        //首谈地项目
        $info2 = [];
        $information2=Information::where([
                    ['emp_id','=',$admin_id],
                    ['process','>','1'],
                    ['process','!=','10'],
                    ['circule_id','!=','0'],
             ])->get();
        foreach ($information2 as $key => $value) {
            $n_emp=Emp::where('id',$value->circule_id)->firstOrFail();
            
            $info2[]=[
                'id'=> $value->id,
                'name' => $value->name,
                'cont_name' => $value->cont_name,
                'cont_phone' => $value->cont_phone,
                'emp_id' => $value->emp_id,
                'staff_name' => $value->staff_name,
                'staff_phone' => $value->staff_phone,
                'currency' => $value->currency,
                'investment' => $value->investment,
                'industry' => $value->industry,
                'investment' => $value->investment,
                'status' => $value->status,
                'process' => $value->process,
                'is_show' => $value->is_show, 
                'circule_n_dept' => $n_emp->dept->dept_name,
                'circule_n_name' => $n_emp->name,
                'circule_n_phone' => $n_emp->phone,
                'circule_f_dept' => $admin->dept->dept_name,
             ]; 
        }
        //dd($info2);

              //dd($information);
              return view('statistics.index1')->with(compact('info','info1','info2'));
    }

    public function show($id)
    {
        $information = Information::where('id',$id)->firstOrFail(); 
        $gdp = [];
        $fund =[];
        $land = [];
        $tax =[]; 
        foreach ($information->info_sta as $key => $value) {
                //echo $value->data;
                if ($value->data_type == '1') {
                    $gdp[]=[
                        'id' =>$value->id,
                        'year'=> $value->year,
                        'data' => $value->data,
                        'currency' => $value->currency,
                    ]; 
                    
                }elseif ($value->data_type == '0') {
                    $fund[]=[
                        'id' =>$value->id,
                        'year'=> $value->year,
                        'data' => $value->data,
                        'currency' => $value->currency,
                    ]; 
                }elseif ($value->data_type == '2') {
                    $land[]=[
                        'id' =>$value->id,
                        'year'=> $value->year,
                        'data' => $value->data,
                        'currency' => $value->currency,
                    ]; 
                }elseif ($value->data_type == '3') {
                     $tax[]=[
                        'id' =>$value->id,
                        'year'=> $value->year,
                        'data' => $value->data,
                        'currency' => $value->currency,
                    ]; 
                }

           }    


        return view('statistics.show')->with(compact('information','gdp','fund','land','tax'));
    }
    


    public function add($id)
    {
        $informations = Information::findOrFail($id);
        $users = Auth::user();

        return view('statistics.add')->with(compact('informations','users'));
    }


    public function store(Request $request)
    {

         $data=$request->all();
         //dd($data);
         $statistics=Statistics::create([
            'info_id' =>$data['info_id'],
            'data_type'  =>$data['data_type'],
            'data'  =>$data['data'],
            'currency' =>$data['currency'],
            'emp_id' =>$data['emp_id'],
            'year' =>$data['year'],
            'contract_file' => $data['contract_file'],
            ]);
         $result=$statistics->save();
             //dd($result);
         DB::commit();
         return $result ? '1':'0';
    }

}
