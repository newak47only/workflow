<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flow,App\Flowline,App\Emp,App\Information,App\Negotiation,App\Infoprocess;
use Auth,DB;

class CompletionController extends Controller
{
    //
        public function add($id)
    {
        $informations = Information::findOrFail($id);
        $users = Auth::user();
        $eaction = '项目投产';
        $actiontype = '4';
        //dd($informations);
        return view('completion.add')->with(compact('informations','users','eaction','actiontype'));
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
             $test=DB::update('update information set process = ? where id = ?',['6',$info_id]);
             //dd($test);
             $result=$Negotiation->save();
             //dd($result);
             DB::commit();
             return $result? '1':'0';
    }
}
