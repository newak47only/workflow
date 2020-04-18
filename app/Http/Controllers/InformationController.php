<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Information,App\Emp,App\Dept,App\Negotiation,App\Recode;
use Auth;

class InformationController extends Controller
{
    //
    public function index(){
        $admin_id=Auth::user()->id;
        //dd($admin_id);
        $emp = Emp::findOrFail($admin_id);
        $admin_director_id = $emp->dept->director_id;
        $dept_id=$emp->dept_id;
        //dd($dept_id);
        $emp_arry = array ();
       
            //获取用户所在组成员
            $emps=Emp::where('dept_id',$dept_id)->get();
            //获取用户所在组成员id数组
            foreach ($emps as $key => $value) {
                $emp_arry[]= array(
                     $key=>$value->id,
                  );        
            }
            //dd($emps);

        $info1 =[];
        $info2 =[];
        $info3 =[];
        //输出市局列表
        if ($dept_id == '6') {
            //获取所有is_show状态为2的信息
            $information=Information::where([
                ['is_show','=','2'],
                ['process','<','2']
            ])->get();

            foreach ($information as $key => $value) {
                $dept = Dept::where('id',$value->info_emp->dept_id)->first();
                    $info1[]=[
                        'id'=> $value->id,
                        'name' => $value->name,
                        'cont_name' => $value->cont_name,
                        'cont_phone' => $value->cont_phone,
                        'emp_id' => $value->emp_id,
                        'staff_name' => $value->staff_name,
                        'staff_phone' => $value->staff_phone,
                        'currency' => $value->currency,
                        'industry' => $value->industry,
                        'investment' => $value->investment,
                        'status' => $value->status,
                        'process' => $value->process,
                        'is_show' => $value->is_show,
                        'created_at' => $value->created_at,
                        'dept'  => $dept['dept_name'],
                    ];
            }
            return view('information.index')->with(compact('info1'));      

        }elseif($admin_id == $admin_director_id && $dept_id != '6' ){
            //本人的洽谈项目
            $information=Information::where('emp_id',$admin_id)->where('process','<','2')->get();
            foreach ($information as $key => $value) {
                $recodenum = Recode::where([['info_id','=',$value->id],['emp_id',$value->emp_id]])->count();
                    $info1[]=[
                        'id'=> $value->id,
                        'name' => $value->name,
                        'cont_name' => $value->cont_name,
                        'cont_phone' => $value->cont_phone,
                        'emp_id' => $value->emp_id,
                        'staff_name' => $value->staff_name,
                        'staff_phone' => $value->staff_phone,
                        'currency' => $value->currency,
                        'industry' => $value->industry,
                        'investment' => $value->investment,
                        'status' => $value->status,
                        'process' => $value->process,
                        'is_show' => $value->is_show,
                        'created_at' => $value->created_at,
                        'recodenum' =>$recodenum 
                    ];

                    
            }
            //上报的洽谈项目

            $information1=Information::whereIn('emp_id',$emp_arry)->where([
                ['process','<','3'],
                ['is_show', '>', '0'],
            ])->get();
            //dd($information); 
            foreach ($information1 as $key => $k) {
                $nego = Negotiation::where([
                    ['info_id','=',$k->id],
                    ['actiontype','=','11'],


                ])->get();
                foreach ($nego as $key => $kk) {
                    $recodenum1 = Recode::where([['info_id','=',$kk->info_id],['emp_id',$kk->emp_id]])->count();                  
                    $info2[]=[
                        'id'=> $k->id,
                        'name' => $k->name,
                        'cont_name' => $k->cont_name,
                        'cont_phone' => $k->cont_phone,
                        'emp_id' => $k->emp_id,
                        'staff_name' => $k->staff_name,
                        'staff_phone' => $k->staff_phone,
                        'currency' => $k->currency,
                        'investment' => $k->investment,
                        'industry' => $k->industry,

                        'status' => $k->status,
                        'process' => $k->process,
                        'is_show' =>$k->is_show,
                        'created_at' => $k->created_at, 
                        'nego_id' => $kk->id,
                        'recodenum'=>$recodenum1,
                    ];
                }

                
            }
            $reportnum = Negotiation::where([
                    ['director_id','=','0'],
                    ['actiontype','=','11'],
                ])->count();

            //流转项目
            $nego1 = Negotiation::whereIn('emp_id',$emp_arry)->where([
                    ['actiontype','=','5'],
                    ['result','=','0'],
            ])->get();
            foreach ($nego1 as $key => $v) {
                $information1=Information::where('id',$v->info_id)->where([
                    ['process', '=', '1'],
                ])->get();
                foreach ($information1 as $key => $vv) {
                    $recodenum2 = Recode::where([['info_id','=',$vv->id],['emp_id',$vv->emp_id]])->count();
                    $info3[]=[
                        'id'=> $vv->id,
                        'name' => $vv->name,
                        'cont_name' => $vv->cont_name,
                        'cont_phone' => $vv->cont_phone,
                        'currency' => $vv->currency,
                        'investment' => $vv->investment,
                        'industry' => $vv->industry,
                        'staff_name' => $vv->staff_name,
                        'staff_phone' => $vv->staff_phone,
                        'emp_id' => $vv->emp_id,
                        'status' => $vv->status,
                        'process' => $vv->process,
                        'is_show' => $vv->is_show,
                        'created_at' => $vv->created_at, 
                        'nego_id' => $v->id,
                        'recodenum'=>$recodenum2,
                    ];
                }
            }
            $circulenum = Information::whereIn('emp_id',$emp_arry)->where('process', '=', '1')->count();

            return view('information.index2')->with(compact('info1','info2','info3','reportnum','circulenum'));   
        }else{
             $information=Information::where([
                    ['emp_id','=',$admin_id],
                    ['process','<','2'],
             ])->orwhere([
                    ['emp_id','=',$admin_id],
                    ['process','=','9'],
             ])->get();
             //dd($information);
              $info = [];
                foreach ($information as $key => $value) {
                    $recodenum = Recode::where('info_id',$value->id)->count();   
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
                        'created_at' => $value->created_at,
                        'recodenum'=>$recodenum,
                    ];
                }        
              //dd($info);
              return view('information.index1')->with(compact('info','action'));
        }
    }

    public function show($id){
        $admin_id=Auth::user()->id;
        //dd($admin_id);
        $information=Information::where('id',$id)->firstOrFail();
        //dd($information->emp_id); 
            $c_emp=Emp::where('id',$information->emp_id)->firstOrFail();
            //dd($c_emp);
            
            if ($information->circule_id =='0') {
                $info[]=[
                    'id'=> $information->id,
                    'name' => $information->name,
                    'cont_name' => $information->cont_name,
                    'cont_phone' => $information->cont_phone,
                    'emp_id' => $information->emp_id,
                    'staff_name' => $information->staff_name,
                    'staff_phone' => $information->staff_phone,
                    'currency' => $information->currency,
                    'investment' => $information->investment,
                    'industry' => $information->industry,
                    'investment' => $information->investment,
                    'status' => $information->status,
                    'content' => $information->content,
                    'appeal' => $information->appeal,
                    'process' => $information->process,
                    'is_show' => $information->is_show, 
                    'circule_f_dept' => $c_emp->dept->dept_name,
                    'circule_f_name' => $c_emp->name,
                    'circule_f_phone' => $c_emp->phone,
                    'circule_n_dept' => '0',
                    'circule_n_name' => '0',
                    'circule_n_phone' => '0',
                ];      
            }else{

                $n_emp=Emp::where('id',$information->circule_id)->firstOrFail();
                 $info[]=[
                    'id'=> $information->id,
                    'name' => $information->name,
                    'cont_name' => $information->cont_name,
                    'cont_phone' => $information->cont_phone,
                    'emp_id' => $information->emp_id,
                    'staff_name' => $information->staff_name,
                    'staff_phone' => $information->staff_phone,
                    'currency' => $information->currency,
                    'investment' => $information->investment,
                    'industry' => $information->industry,
                    'content' => $information->content,
                    'appeal' => $information->appeal,
                    'status' => $information->status,
                    'process' => $information->process,
                    'is_show' => $information->is_show, 
                    'circule_f_dept' => $c_emp->dept->dept_name,
                    'circule_f_name' => $c_emp->name,
                    'circule_f_phone' => $c_emp->phone,
                    'circule_n_dept' => $n_emp->dept->dept_name,
                    'circule_n_name' => $n_emp->name,
                    'circule_n_phone' => $n_emp->phone,
                ];
            }
                //dd($info);
        return view('information.show')->with(compact('info'));
    }

    public function create()
    {
        $emp_id=Auth::user()->id;
        $emp=Emp::where('id',$emp_id)->firstOrFail();
        //dd($emp);
        return view('information.create')->with(compact('emp_id','emp'));
    }

    public function store(Request $request)
    {
        $data=$request->all();
        $result=Information::create($data);
        return  $result ? '1' : '0';
    }


    public function edit($id)
    {
        $emp_id=$id;
        $information=Information::findOrFail($id);
        return view('information.edit')->with(compact('information','emp_id'));
    }

    public function update(Request $request, $id)
    {
        $information=Information::findOrFail($id);

        $data=$request->all();

        $information->update($data);

        return redirect()->route('information.index');
    }





     public function destroy($id)
    {
        return response()->json([
            'error'=>1,
            'msg'=>'员工不能删除'
        ]);
    }


    	
}

