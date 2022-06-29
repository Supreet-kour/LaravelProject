<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{

  //function to view contact forms
  public function index()
  {
    $client = Client::all();
    return view('admin.client',compact('client'));
  }

//function to edit the contact forms
  public function edit($client_id)
  {
    $client = Client::find($client_id);
    return view('admin.clientEdit',compact('client'));
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
        return redirect('admin/client')->with('success','You Have Updated Successfully');
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
       return redirect('admin/client')->with('success','You Have Deleted Successfully');
    }
    else
    {
      return redirect('admin/client')->with('fail','Data Not Deleted');
    }

  }
  }
