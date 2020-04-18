<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Information,App\Emp,App\Dept,App\Negotiation;
use Auth,DB;

class ReportController extends Controller
{
    //
    public function index(){

    	$admin_id=Auth::user()->id;
        //dd($admin_id);
        $emp = Emp::findOrFail($admin_id);
        $admin_director_id = $emp->dept->director_id;
        //dd($admin_director_id);
        $emp_arry = array ();
        //判断用户是否为所在用户组领导
        $dept_id=$emp->dept_id;
        $info = [];
        //dd($info);
        //dd($dept_id);
        //获取进程状态
        $infoprocess=Infoprocess::where('level','0')->get();
        if($admin_id == $admin_director_id){
            //获取用户所在组成员
            $emps=Emp::where('dept_id', $dept_id)->get();
            //获取用户所在组成员id数组
            foreach ($emps as $key => $value) {
                $emp_arry[$key]= $value->id;
                   
            }
            //dd($emp_arry);
       

        	$information=Information::whereIn('emp_id',$emp_arry)->where([
    			['process', '=', '0'],
    			['is_show', '=', '1'],
			])->get();
        	//dd($information);
        	
            foreach ($information as $key => $value) {
            	$nego = Negotiation::where([
            		['info_id','=',$value->id],
            		['actiontype','=','11'],

            	])->get();
            	foreach ($nego as $key => $val) {
            		$info[]=[
                    'id'=> $value->id,
                    'name' => $value->name,
                    'cont_name' => $value->cont_name,
                    'cont_phone' => $value->cont_phone,
                    'emp_id' => $value->emp_id,
                    'status' => $value->status,
                    'process' => $value->process,
                    'is_show' => $value->is_show,
                    'nego_id' => $val->id,
                    ];
            	}

            }  
            //dd($info);
              return view('report.index')->with(compact('info'));
        }
        
    }

     public function add($id)
    {
        //echo $id;
        //$negotiation = Negotiation::findOrFail($id);
        $informations = Information::findOrFail($id);
        $users = Auth::user();
        $eaction = '项目上报';
        $actiontype = '11';
        //dd($informations);
        return view('report.add')->with(compact('informations','users','eaction','actiontype'));
    }


    public function store(Request $request)
    {

         $data=$request->all();
             //$flow=Flow::where('flow_no','=',$data['flow_no'])->firstOrFail();

             //$flowlink=Flowline::where('flow_no',$data['flow_no'])->get();
             //dd($data);
             $Negotiation=Negotiation::create([
                'info_id' =>$data['info_id'],
                'emp_id'  =>Auth::id(),
                'currency' =>$data['currency'],
                'investment' =>$data['investment'],
                'status' =>0,
                'eaction' =>$data['eaction'],
                'actiontype' =>$data['actiontype'],

                //'neg_at' =>$data['neg_at'],
                'remark' =>$data['remark'],
                'contract_file' =>$data['contract_file'],

            ]);
             $info_id=$data['info_id'];
             //DB::update('update student set name = ? where id = ?',[$name,$id]);
             $test=DB::update('update information set is_show = ? where id = ?',['1',$info_id]);
             //dd($test);
             $result=$Negotiation->save();
             //dd($result);
             DB::commit();
             return $result ?"1":"0";
    }

    public function edit($id)
    {
        
        //$negotiation=Negotiation::findOrFail($id);
        //dd($id);


        $negotiation=Negotiation::findOrFail($id);
        //dd($negotiation->info_id);
		$info_name=Information::findOrFail($negotiation->info_id)->name;
        //echo $negotiation->currency;
        //dd($negotiation);
        $director_id=Auth::user()->id;
        $daction = '上报审核';
        $actiontype = '11';
        
        return view('report.edit')->with(compact('negotiation','info_name','director_id','daction','actiontype'));
    }

    public function update(Request $request, $id)
    {

        $negotiation=Negotiation::findOrFail($id);

         $data=$request->all();
         //dd($data);
         
         $result=$negotiation->update($data);
         $info_id=$data['info_id'];
         if($data['status'] == 1){
            //DB::update('update information set process = ? where id = ?',[1,$info_id]);
\
            DB::update('update information set is_show = ? where id = ?',[2,$info_id]);
         }elseif ($data['status'] == 2) {
             DB::update('update information set is_show = ? where id = ?',[0,$info_id]);
         }

         

       
        /*$negotiation=Negotiation::findOrFail($id);

        if($request->status ==0){

            $test=DB::update('update information set status = ? where id = ?',[$status,$info_id]);

        }elseif($request->status==1){

        }
        $test=DB::update('update information set status = ? where id = ?',[$status,$info_id]);

        $negotiation->update($request->all());*/
        return  $result ? '1' : '0';
    }
}
