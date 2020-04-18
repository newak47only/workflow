<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Emp,App\Information,App\Negotiation,App\Infoprocess;
use Auth,DB;
class LandingController extends Controller
{
    //
	 public function index()
    {
    
        $admin_id = Auth::user()->id;
        //获取用户信息
        $emp = Emp::findOrFail($admin_id);
        //获取用户部门领导id
        $admin_director_id = $emp->dept->director_id;
        //dd($admin_director_id);
        $emp_arry = array ();
        //判断用户是否为所在用户组领导
        $dept_id=$emp->dept_id;
        //获取进程状态
        if($admin_id == $admin_director_id){
            //获取用户所在组成员
            $emps=Emp::where('dept_id',$dept_id)->get();
            //获取用户所在组成员id数组
            foreach ($emps as $key => $value) {
                $emp_arry[]= array(
                     $key=>$value->id,
                  );        
            }
            //获取洽谈表信息
            $information=Information::wherein('emp_id',$emp_arry)->where('process','1')->where('status','1')->get();
            //dd($information);
            //组成展示页面数组
            $info = [];
            foreach ($information as $key => $value) {                   
                foreach ($infoprocess as $k => $val) {
                    if($val->node == $value->status){
                        
                        $nego = DB::table('landing')->where('info_id', $value->id)->where('status', 0)->get();
                        foreach ($nego as $key => $kk) {
                        $info[]=[
                            'id'=> $value->id,
                            'name' => $value->name,
                            'cont_name' => $value->cont_name,
                        'cont_phone' => $value->cont_phone,
                        'emp_id' => $value->emp_id,
                        'status' => $value->status,
                        'process' => $value->process,
                        'level' => $val->level,
                        'node' => $val->node,
                        'action' => $val->action,
                        'describe' => $val->describe,
                        'role' => $val->role,
                        'url' => $val->url,
                        'nego_id' =>$kk->id
                        ];
                        }
                    }
                }
            }
            //dd($info);
            return view('Landing.index')->with(compact('info'));
        }else{

            return view('information.index')->with(compact('information'));        
        }
    }

    public function show($id)
    {
    	//echo $id;

    	$informations = Information::findOrFail($id);
        $users = Auth::user();
    	//dd($informations);
    	return view('landing.add')->with(compact('informations','users'));
    }


    public function add($id)
    {
        $informations = Information::findOrFail($id);
        $users = Auth::user();
        $eaction = '项目开工';
        $actiontype = '3';
        //dd($informations);
        return view('landing.add')->with(compact('informations','users','eaction','actiontype'));
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
                'contract_file' =>$data['contract_file'],
                'neg_at' =>$data['neg_at'],
                'remark' =>$data['remark'],
            ]);
             $info_id=$data['info_id'];
             //DB::update('update student set name = ? where id = ?',[$name,$id]);
             $test=DB::update('update information set process = ? where id = ?',['5',$info_id]);
             //dd($test);
             $result=$Negotiation->save();
             //dd($result);
             DB::commit();
             return $result? '1':'0';
    }



    public function edit($id)
    {
        $landing=Landing::findOrFail($id);
       
        //dd($Landing);
        $info_id=Landing::findOrFail($id)->info_id;

        $info_name=Information::findOrFail($info_id)->name;
        //echo $Landing->currency;
        
        
        return view('landing.edit')->with(compact('landing','info_name'));
    }


    public function update(Request $request, $id)
    {
        
        $Landing=Landing::findOrFail($id);

         $data=$request->all();
         
         $Landing->update($data);
         $info_id=$data['info_id'];
         if($data['status'] == 1){
            DB::update('update information set process = ? where id = ?',[2,$info_id]);
            DB::update('update information set status = ? where id = ?',[0,$info_id]);
         }elseif ($data['status'] == 2) {
             DB::update('update information set status = ? where id = ?',[0,$info_id]);
         }
        return redirect()->route('Landing.index')->with(['success'=>1,'message'=>'更新成功']);
    }

}




    
