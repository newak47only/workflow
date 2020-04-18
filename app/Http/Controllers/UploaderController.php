<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Negotiation,App\Uploader,App\Information,App\Emp;
use Storage,DB,Auth;

class UploaderController extends Controller
{
    //
    public function index(){

        $admin_id = Auth::user()->id;
        $information = Information::where('is_show','2')->get();
        return view('uploader.index')->with(compact('information'));

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
        $information = Information::whereIn('emp_id',$emp_arry)->get();
        return view('uploader.index1')->with(compact('information'));

    }

    public function index2(){

        $admin_id = Auth::user()->id;
        $information = Information::where('emp_id',$admin_id)->orwhere('circule_id',$admin_id)->get();
        return view('uploader.index2')->with(compact('information'));

    }


    public function webuploader(Request $request){

    	if($request->hasFile('file') && $request->file('file')->isValid()){
    		$filename	=	sha1(time().$request->file('file')->getClientOriginalName()).'.'.$request -> file('file') -> getClientOriginalExtension();
    		
    		Storage::disk('public')->put($filename, file_get_contents($request->file('file')->path()));
    	
    		$uploader=Uploader::create([
                'emp_id'  =>$_POST['emp_id'],
                'name' =>$request->file('file')->getClientOriginalName(),
                'actiontype' =>$_POST['actiontype'],
                'info_id' => $_POST['info_id'],
                'httpurl' =>'/storage/'.$filename,
                'filetype' =>$request -> file('file') -> getClientOriginalExtension(),
            ]);
            $uploader->save();
            DB::commit();

    		$result	=	[

    			'errCode' => '0',
    			'errMsg'  => '',
    			'succMsg' => "文件上传成功！",
    			'path'	  => '/storage/'.$filename,

			];
    			
    	}else{

    		$result = [
    			'errCode' => '1',
    			'errMsg'  => $request->file('file')->getErrorMessage(),
    		];
    	}

    	return response() -> json($result);

    }
}
