<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Dept,App\Emp;
use Auth;

class DeptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $depts=Dept::recursion(Dept::with(['director','manager'])->orderBy('rank','ASC')->get());
        return view('dept.index')->with(compact('depts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $depts=Dept::recursion(Dept::orderBy('rank','ASC')->get());
        $emps=Emp::orderBy('id','DESC')->get();
        return view('dept.add')->with(compact('depts','emps'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->all();

        $this->validate($request,[
            'dept_name'=>'required'
        ]);

        Dept::create($data);

        return redirect()->route('dept.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dept=Dept::findOrFail($id);
        //dd($dept);

        $emps=Emp::orderBy('id','DESC')->get();
         //dd($emps);

        $depts=Dept::recursion(Dept::orderBy('rank','ASC')->get());
        //dd($depts);
        return view('dept.edit')->with(compact('dept','emps','depts'));
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
        $dept=Dept::findOrFail($id);

        $data=$request->all();

        $this->validate($request,[
            'dept_name'=>'required'
        ]);

        $result = $dept->update($data);
        return  $result ? '1' : '0';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dept=Dept::findOrFail($id);

        if(Dept::where('pid',$dept->id)->first()){
            $result = '2';
            return $result;
        }

        if(Emp::where('dept_id',$dept->id)->first()){
            $result = '3';
            return $result;
        }

        $result = $dept->delete();

        return $result ? '1':'0';
    }
}
