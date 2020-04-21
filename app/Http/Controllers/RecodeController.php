<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Emp,App\Information,App\Negotiation,App\Recode;
use Carbon\Carbon;
use Auth,DB;

class RecodeController extends Controller
{
    //
    public function show($id){


            $recode= Recode::where('info_id',$id)->get();
            //foreach ($recode as $key => $value) {
               // echo $value->emp->username;
            //}
           // dd($recode);
            

            $nego = Negotiation::where([
                ['info_id','=',$id],
                ['actiontype','=','5'],

            ])->orwhere([
                ['info_id','=',$id],
                ['actiontype','=','11'],

            ])->orwhere([
                ['info_id','=',$id],
                ['actiontype','=','13'],

            ])->get();
            //foreach ($nego as $key => $value) {
            //   echo $value->emp->username;
            //}
            //dd($nego);

            return view('recode.show')->with(compact('recode','nego'));     

    }



        


    public function add($id)
    {
        $information = Information::findOrFail($id);
        return view('recode.add')->with(compact('information'));
    }


    public function store(Request $request)
    {

         $data=$request->all();
             //$flow=Flow::where('flow_no','=',$data['flow_no'])->firstOrFail();

             //$flowlink=Flowline::where('flow_no',$data['flow_no'])->get();
             //dd($data);
             $recode=Recode::create([
                'info_id' =>$data['info_id'],
                'emp_id'  =>$data['emp_id'],
                'elephant' =>$data['elephant'],
                'mode' =>$data['mode'],
                'content' =>$data['content'],
            ]);
            
             $result=$recode->save();
             //dd($result);
             DB::commit();
            return $result ? '1':'0';
    }

    public function ciradd($id)
    {
        $nego = Negotiation::where('id',$id)->firstOrFail();
        
        $information = Information::where('id',$nego->info_id)->firstOrFail();
        //dd($information);
        $nego_id = $nego->id;
        return view('recode.ciradd')->with(compact('information','nego_id'));
    }


    public function cirstore(Request $request)
    {

        $data=$request->all();
        $recode=Recode::create([
            'info_id' =>$data['info_id'],
            'emp_id'  =>$data['emp_id'],
            'elephant' =>$data['elephant'],
            'mode' =>$data['mode'],
            'content' =>$data['content'],
        ]);
        $neg_at = Carbon::now();
        $nego_id = $data['nego_id'];
        $test=DB::update('update negotiation set neg_at = ? where id = ?',[$neg_at,$nego_id]);
        $result=$recode->save();
             //dd($result);
        DB::commit();
        return $result ? '1':'0';
    }
}
