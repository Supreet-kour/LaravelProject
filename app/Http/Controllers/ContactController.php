<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Hash;
use Mail;

class ContactController extends Controller
{
    public function contact()
    {
      return view('admin.contact');
    }

   //function to add data to Database
   public function addData(Request $req)
   {
     //validate
     $req->validate([
       'name'=>'required | max:15',
       'email'=>'required | max:50',
       'phone'=>'required | max:20'
     ]);

     $user = DB::table('users')->where('email','=',$req->email)->exists();

     if(!$user){
       $user = new User;
       $user->name = $req->name;
       $user->email = $req->email;
       $user->password = Hash::make($req->email);
       $user->save();
     }

     $userId = DB::table('users')->where('email','=',$req->email)->value('id');


    //save in database
     $client= new Client;
     $client->name=$req->name;
     $client->email=$req->email;
     $client->phone=$req->phone;
     $client->msg=$req->msg;
     $client->user_id = $userId;
     $client->save();
     $this->sendEmail($req);
     return back()->with('message_sent','Your message has been sent successfully');
   }


    //function to send email
    private function sendEmail(Request $request)
    {
      $details=[
        'name' => $request->name,
        'email'=> $request->email,
        'phone'=> $request->phone,
        'msg'=>   $request->msg
      ];
      Mail::to('k6252520@gmail.com')->send(new ContactMail($details));
    }
}
