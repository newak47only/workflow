<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recode,App\Emp,App\Information,App\Negotiation;
use Auth,DB;


class NegotiationController extends Controller
{
    //
    public function index()
    {
    
        $admin_id=Auth::user()->id;
        //dd($admin_id);
        $admin=Emp::where('id',$admin_id)->firstOrFail();
        //dd($admin->dept->dept_name);

        //独立完成项目
        $information=Information::where([
                    ['is_show','=','2'],
                    ['process','>','3'],
                    ['circule_id','=','0']
             ])->get();

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
                'dept' =>$admin->dept->dept_name,
                'recodenum'=>$recodenum,
             ]; 
        }
        //流转项目
        $info1 = [];
        $information1=Information::where([
                    ['process','>','3'],
                    ['circule_id','!=','0']
             ])->get();
        foreach ($information1 as $key => $value) {
            $nego = Negotiation::where([
                        ['info_id','=',$value->id],
                        ['actiontype','=','13'],
                        ['result','=','4'],
                    ])->first();
                    $n_emp=Emp::where('id',$nego['director_id'])->firstOrFail(); 
                    $circule = Dept::where('id',  $nego['status'])->first();
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
                        'circule_n_dept' => $n_emp->dept->dept_name,
                        'circule_n_name' => $n_emp->username,
                        'circule_n_phone' => $n_emp->phone,
                        'circule_f_dept' => $dept['dept_name'],
                        'circule_f_name' => $value->info_emp->username,
                        'circule_f_phone'=>$value->info_emp->phone,
                        'circule_to'    =>$circule['dept_name'],

                    ];    
        }


            //dd($info);            
            return view('negotiation.index')->with(compact('info','info1'));
    }

    public function index1(){
        $admin_id=Auth::user()->id;
        //dd($admin_id);
        $admin=Emp::where('id',$admin_id)->firstOrFail();
        //dd($admin->dept->dept_name);
        $admin_id = Auth::user()->id;
        //获取用户信息
        $emp = Emp::findOrFail($admin_id);
        //获取用户部门领导id
        $admin_director_id = $emp->dept->director_id;
        //dd($admin_director_id);
        $emp_arry = array ();
        //判断用户是否为所在用户组领导
        $dept_id=$emp->dept_id;
        //获取用户所在组成员
        $emps=Emp::where('dept_id',$emp->dept->id)->get();
            //获取用户所在组成员id数组
        foreach ($emps as $key => $value) {
            $emp_arry[]= array(
                $key=>$value->id,
            );
        } 

        //全区独立完成项目
        $information=Information::whereIn('emp_id',$emp_arry)->where([
                    ['process','>','3'],
                    ['circule_id','=','0'],
                    ['is_show','=','2'],
             ])->get();

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
                'dept' =>$admin->dept->dept_name,
                'recodenum'=>$recodenum,
             ]; 
        }
        //流转项目
        $info1 = [];
        $information1=Information::whereIn('circule_id',$emp_arry)->where('process','>','3')->get();
        foreach ($information1 as $key => $value) {
            $c_emp=Emp::where('id',$value->emp_id)->firstOrFail();
            $recodenum = Recode::where('info_id',$value->id)->count();
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
                'recodenum'=>$recodenum,
             ]; 
        }
        //首谈地项目
        $info2 = [];
        $information2=Information::whereIn('emp_id',$emp_arry)->where([
                    ['process','>','3'],
                    ['circule_id','!=','0'],
             ])->get();
        foreach ($information2 as $key => $value) {
            $n_emp=Emp::where('id',$value->circule_id)->firstOrFail();  
            $recodenum = Recode::where('info_id',$value->id)->count();          
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
                'recodenum'=>$recodenum,
             ]; 
        }
            //dd($info);            
            return view('negotiation.index1')->with(compact('info','info1','info2'));       


    }
    public function index2(){
        $admin_id=Auth::user()->id;
        //dd($admin_id);
        $admin=Emp::where('id',$admin_id)->firstOrFail();
        //dd($admin->dept->dept_name);

        //独立完成项目
        $information=Information::where([
                    ['emp_id','=',$admin_id],
                    ['process','>','3'],
                    ['circule_id','=','0']
             ])->get();

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
                'dept' =>$admin->dept->dept_name,
                'recodenum'=>$recodenum,
             ]; 
        }
        //流转项目
        $info1 = [];
        $information1=Information::where([
                    ['circule_id','=',$admin_id],
                    ['process','>','3'],
             ])->get();
        foreach ($information1 as $key => $value) {
            $c_emp=Emp::where('id',$value->emp_id)->firstOrFail();
            $recodenum = Recode::where('info_id',$value->id)->count();
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
                'recodenum'=>$recodenum,
             ]; 
        }

        $info2 = [];
        $information2=Information::where([
                    ['emp_id','=',$admin_id],
                    ['process','>','3'],
                    ['circule_id','!=','0'],
             ])->get();
        foreach ($information2 as $key => $value) {
            $n_emp=Emp::where('id',$value->circule_id)->firstOrFail();  
            $recodenum = Recode::where('info_id',$value->id)->count();          
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
                'recodenum'=>$recodenum,
             ]; 
        }
            //dd($info);            
            return view('negotiation.index2')->with(compact('info','info1','info2'));

    }

    public function show($id)
    {
    	//echo $id;

    	$negotiation = Negotiation::findOrFail($id);
        $users = Auth::user();
    	//dd($informations);
    	return view('negotiation.add')->with(compact('informations','users'));
    }

    
     


    public function add($id)
    {
        //echo $id;
        //$negotiation = Negotiation::findOrFail($id);
        $informations = Information::findOrFail($id);
        $users = Auth::user();
        //dd($informations);
        $eaction = '项目落地';
        $actiontype = '1';
        return view('negotiation.add')->with(compact('informations','users','eaction','actiontype'));
    }


    public function store(Request $request)
    {

         $data=$request->all();

             $Negotiation=Negotiation::create([
                'info_id' =>$data['info_id'],
                'emp_id'  =>Auth::id(),
                'currency' =>$data['currency'],
                'investment' =>$data['investment'],
                'status' =>0,
                'contract_file' => $data['contract_file'],
                'eaction' =>$data['eaction'],
                'actiontype' =>$data['actiontype'],
                'neg_at' =>$data['neg_at'],
                'remark' =>$data['remark'],
                //'contract_file' =>$data['contract_file'],

            ]);
             $info_id=$data['info_id'];
             //DB::update('update student set name = ? where id = ?',[$name,$id]);
             $test=DB::update('update information set process = ? where id = ?',[4,$info_id]);
             //dd($test);
             $result=$Negotiation->save();
            
             DB::commit();
             return $result? '1':'0';
    }

    public function edit($id)
    {
        $negotiation=Negotiation::findOrFail($id);
       
        //dd($negotiation);
        $info_id=Negotiation::findOrFail($id)->info_id;

        $info_name=Information::findOrFail($info_id)->name;
        //echo $negotiation->currency;
        
        
        return view('negotiation.edit')->with(compact('negotiation','info_name'));
    }

    public function update(Request $request, $id)
    {
        
        $negotiation=Negotiation::findOrFail($id);

         $data=$request->all();
         
         $negotiation->update($data);
         $info_id=$data['info_id'];
         if($data['status'] == 1){
            DB::update('update information set process = ? where id = ?',[1,$info_id]);
            DB::update('update information set status = ? where id = ?',[0,$info_id]);
         }elseif ($data['status'] == 2) {
             DB::update('update information set status = ? where id = ?',[0,$info_id]);
         }

         

       
        /*$negotiation=Negotiation::findOrFail($id);

        if($request->status ==0){

            $test=DB::update('update information set status = ? where id = ?',[$status,$info_id]);

        }elseif($request->status==1){

        }
        $test=DB::update('update information set status = ? where id = ?',[$status,$info_id]);

        $negotiation->update($request->all());*/
        return redirect()->route('negotiation.index')->with(['success'=>1,'message'=>'更新成功']);
    }

}
