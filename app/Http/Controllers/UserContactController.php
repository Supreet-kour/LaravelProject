<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;
use App\Http\Controllers\Session;

class UserContactController extends Controller
{
    public function index()
    {
      if(Auth()->user()->id)
      {
        $id = Auth()->user()->id;
        $clients = User::find($id)->clients;


        return view('admin.userContactForm',compact('clients'));

      }
      else{
        dd('Invalid Attempt');
      }
    }


      public function edit($client_id)
      {
        $client = Client::find($client_id);
        return view('admin.userContactEdit',compact('client'));
      }

      public function update(Request $request, $client_id)
      {
          $client= Client::find($client_id);
          $client->name=$request->name;
          $client->email=$request->email;
          $client->phone=$request->phone;
          $client->msg=$request->msg;
          $result=$client->save();
          if($result)
          {
            return redirect('contact-form')->with('success','You Have Updated Successfully');
          }//if close
          else
          {
          return back()->with('fail','Something Went Wrong');
          }//else close
      }

      public function delete($client_id)
      {
        $client= Client::find($client_id);
          if($client)
        {
           $client->delete();
           return redirect('contact-form')->with('success','You Have Deleted Successfully');
        }
        else
        {
          return redirect('contact-form')->with('fail','Data Not Deleted');
        }

      }

}
