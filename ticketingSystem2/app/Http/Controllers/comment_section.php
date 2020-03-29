<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\comments;
use App\tickets;
use App\logs2;

class comment_section extends Controller
{
    public function insert(Request $request){
    	$cmmt = new comments;
      $cmmt->tickets_id = $request->tickets_id;
    	$cmmt->name = $request->name;
      $cmmt->comments = $request->comment;
      $cmmt->save();
    }



    public function display($id){
      //$tickets = tickets::find($id);
      $tickets = tickets::find($id);
      //dd($tickets);
      //$wews = tickets::with('comment')->get();
      //$tickets = tickets::find($id)->with('comment')->get();

      return view('comment_page')->with('ticket', $tickets);
      //return view('comment_page');
    }


    public function display1($id){

      $logs = logs2::where('ticket_id', $id)->get();
      return view('logs_page', ['logs'=>$logs]);
    }

}
