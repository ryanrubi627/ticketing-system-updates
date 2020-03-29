<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class client_page_controller extends Controller {
   public function insertform() {
      return view('client_page');
   }
    
   public function insert(Request $request) {
      $title = $request->input('title');
      $description = $request->input('description');
      $data=array('title'=>$title, 'description'=>$description);
      DB::table('client_page')->insert($data);
      echo "Ticket created successfully.<br/>";
      echo '<a href = "/insert">Click Here</a> to go back.';
   }

}