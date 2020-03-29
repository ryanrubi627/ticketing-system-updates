<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\tickets;
use App\notification;

class HomeController extends Controller
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
      $notifications = notification::all();
      return view('home', ['users'=>$users, 'notifications'=>$notifications]);
    }


    // public function insert(Request $request){
    //   $user = new tickets;

    //   $user->name = $request->name;
    //   $user->title = $request->title;
    //   $user->description = $request->description;
    //   $user->importance = $request->importance;
    //   $user->date = $request->date;
    //   $user->status = $request->status;

    //   $user->save();

    // }
    public function insert(Request $request){
      $user = new tickets;

      //$created = preg_replace("/[\s-:]/", "", $user->created_at);
      $date = preg_replace("/[\s-:]/", "", $request->date);
      $importance = $request->importance;

      $user->ticket_code = 'CODE: ' . $date . $importance;
      $user->name = $request->name;
      $user->title = $request->title;
      $user->description = $request->description;
      $user->importance = $request->importance;
      $user->date = $request->date;
      $user->status = $request->status;

      $user->save();

    }

    public function update(Request $request){
      
      $id = $request->id;
      $title = $request->title;
      $description = $request->description;
      $importance = $request->importance;

      tickets::where('ticket_code', $id)
                    ->update(['title' => $title, 'description' => $description, 'importance' => $importance]);

    }

    public function display_notification(){
      $notification = notification::all();
      dd($notification);
      // return view('layout.app')->with('notification', $notification);
    }

}
