<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use App\tickets;
use App\admin_pages;
use App\inprogress_tickets;
use App\closed_tickets;
use App\logs;
use App\logs2;
use App\notification;

class AdminPageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function display(){
      $users = tickets::all();
      return view('admin_page', ['users'=>$users]);
    }

    public function delete($id){
      tickets::where('id', $id)->delete();
      return redirect('admin');
    }

    public function status_inprogress(Request $request){

      $user = new inprogress_tickets;

      $user->ticket_code = $request->ticket_id;
      $user->name = $request->name;
      $user->title = $request->title;
      $user->description = $request->description;
      $user->importance = $request->importance;
      $user->date = $request->date;
      $user->status = $request->status;

      $user->save();

      $id = $request->ticket_id;

      tickets::where('ticket_code', $id)->delete();

      $user = new logs;

      $user->date = $request->date_logs;
      $user->action = $request->accpt_logs;

      $user->save();

      $user = new notification;

      $user->ticket_code = $request->ticket_id;
      $user->name = $request->notif_name;
      $user->text = $request->text;

      $user->save();


      $user = new logs2;

      $user->ticket_id = $request->ticket_id;
      $user->date = $request->date_logs;
      $user->action = $request->accpt_logs;

      $user->save();

    }
    public function display_inprogress_ticket(){
      $inprogress_tickets = inprogress_tickets::all();
      return view('inprogress_list_ticket', ['inprogress_tickets'=>$inprogress_tickets]);
    }
    public function inprogress_to_closed(Request $request){
      $user = new closed_tickets;

      $user->ticket_code = $request->ticket_id;
      $user->name = $request->name;
      $user->title = $request->title;
      $user->description = $request->description;
      $user->importance = $request->importance;
      $user->date = $request->date;
      $user->status = $request->status;

      $user->save();

      $id = $request->ticket_id;

      inprogress_tickets::where('ticket_code', $id)->delete();

      $user = new logs;

      $user->date = $request->date_logs;
      $user->action = $request->closed_logs;

      $user->save();

      $user = new notification;

      $user->ticket_code = $request->ticket_id;
      $user->text = $request->text;
      $user->name = $request->notif_name;

      $user->save();

      $user = new logs2;

      $user->ticket_id = $request->ticket_id;
      $user->date = $request->date_logs;
      $user->action = $request->closed_logs;

      $user->save();
    }


    public function status_closed(Request $request){

      $user = new closed_tickets;

      $user->ticket_code = $request->ticket_id;
      $user->name = $request->name;
      $user->title = $request->title;
      $user->description = $request->description;
      $user->importance = $request->importance;
      $user->date = $request->date;
      $user->status = $request->status;

      $user->save();

      $id = $request->ticket_id;

      tickets::where('ticket_code', $id)->delete();

      $user = new logs;

      $user->date = $request->date_logs;
      $user->action = $request->closed_logs;

      $user->save();

//-----------------------------------------------------------------------

      $user = new logs2;

      $user->tickets_id = $id;
      $user->action = Auth::user()->name."Admin accepted the ticket";

      $user->save();

//-----------------------------------------------------------------------
    }
    public function display_closed_ticket(){
      $closed_tickets = closed_tickets::all();
      return view('closed_list_ticket', ['closed_tickets'=>$closed_tickets]);
    }
    public function closed_to_open(Request $request){
      $user = new tickets;

      $user->ticket_code = $request->ticket_id;
      $user->name = $request->name;
      $user->title = $request->title;
      $user->description = $request->description;
      $user->importance = $request->importance;
      $user->date = $request->date;
      $user->status = $request->status;

      $user->save();

      $id = $request->ticket_id;

      closed_tickets::where('ticket_code', $id)->delete();

      $user = new logs;

      $user->date = $request->date_logs;
      $user->action = $request->reopen_logs;

      $user->save();

      $user = new notification;

      $user->ticket_code = $request->ticket_id;
      $user->name = $request->notif_name;
      $user->text = $request->text;

      $user->save();

      $user = new logs2;

      $user->ticket_id = $request->ticket_id;
      $user->date = $request->date_logs;
      $user->action = $request->reopen_logs;

      $user->save();
    }
//---------------------------------------------------------

    public function display_logs1(Request $request){

      $id_logs = $request->id_logs;
      $logs = logs2::where('tickets_id', $id_logs)->get();

      return response()->json($logs);

    }

//----------------------------------------------------------
    public function display_logs(Request $request){

      $logs = Logs::all();
      return $logs;
    }


}
