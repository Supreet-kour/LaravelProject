<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Client;
use App\Models\User;

class AdminAgentController extends Controller
{
  public function index()
  {
    return view('admin.AdminAgentDashboard');
  }

  //function to fetch all the contact forms
    public function details()
      {
        $client = Client::all();
        return view('admin.adminAgentContact',compact('client'));
      }

      //function to edit the contact forms
        public function edit($client_id)
        {
          $client = Client::find($client_id);
          return view('admin.adminAgentEdit',compact('client'));
        }

      //function to update the contact forms
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
              return redirect('admin/agent/client')->with('success','You Have Updated Successfully');
            }//if close
            else
            {
            return back()->with('fail','Something Went Wrong');
            }//else close
        }

      //function to delete the contact forms
        public function delete($client_id)
        {
          $client= Client::find($client_id);
            if($client)
          {
             $client->delete();
             return redirect('admin/agent/client')->with('success','You Have Deleted Successfully');
          }
          else
          {
            return redirect('admin/agent/client')->with('fail','Data Not Deleted');
          }

        }
}
