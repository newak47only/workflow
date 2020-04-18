<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Permission;
use Input;
use DB;
use App\Permission;

class PermissionController extends Controller
{
    //
	public function index()
	{

		
		$data = DB::table('permission as t1') ->select('t1.*','t2.permissionname as perant_name')->leftJoin('permission as t2','t1.pid','=','t2.id')->get();
		//dd($data);
		//$permissions=Permission::orderBy('id','desc')->get();
		return view('permission.index')->with(compact('data'));
	}

   	public function create()
   	{
   		
   		$parents	= Permission::where('pid','=','0') -> get();
   		return view('permission.create')->with(compact('parents'));	
  
	}

	public function store(Request $request)
    {
        $data=$request->all();
        //dd($data);
        /*$this->validate($request,[
            'name'=>'required',
            'email'=>'required|unique:emp,email',
            'password'=>'required',
            'dept_id'=>'required',
        ]);*/

        $result = Permission::create($data);
        //dd($result);
        return $result ? '1':'0';
         
    }

        public function edit($id)
    {	
        $permission = Permission::findOrFail($id);
        $parents = Permission::where('pid','=','0') -> get();
        return view('permission.edit')->with(compact('permission','parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=$request->all();

        $permission=Permission::findOrFail($id);

        $result = $permission->update($data);

        return  $result ? '1' : '0';

    }

    public function destroy($id)
    {
        
    	//dd($id);
        $permission=Permission::findOrFail($id);

        $permission->delete();
        return response()->json([
            'error'=>1,
            'msg'=>'顶级权限不能删除'
        ]);
    }

    public function aajax($str){
        //获取到ajax传来的需要删除的id
        //把传来的所有id改为数组形式  explode  字符串转数组
        $str = explode(",",$str);
        //利用循环将需要删除的id 一个一个进行执行sql；
        foreach($str as $v){
           Permission::where('id','=',$v)->delete();
        }

    }
   
}
