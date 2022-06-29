<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Client;
use App\Models\Permission;
use App\Models\User;



class AgentController extends Controller
{

  //function to view the dashboard

  public function index()
  {
    return view('admin.agentDashboard');
  }

//function to fetch all the contact forms
  public function details()
    {
      $client = Client::all();
      $permissions = $this->getAllPermissions();
      if(in_array(1,$permissions))
      {
      return view('admin.agentContact',compact('client','permissions'));
      }
      else
      {
        return redirect('agent/dashboard')->with('fail','You Donot Have Permissions');
      }
    }

    //function to edit the contact forms
    public function edit($client_id)
    {
      $client = Client::find($client_id);
      return view('admin.agentContactEdit',compact('client'));
    }

    //function to update the contact form
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
          return redirect('agent/client')->with('success','You Have Updated Successfully');
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
         return redirect('agent/client')->with('success','You Have Deleted Successfully');
      }
      else
      {
        return redirect('agent/client')->with('fail','Data Not Deleted');
      }

    }

    //function to fetch all the users
    public function view()
    {
      $users = User::all()->whereIn('role_as', [0, 2]);
      $permissions = $this->getAllPermissions();
      if($permissions)
      {
      return view('admin.agentUser',compact('users','permissions'));
      }
      else
      {
        return back()->with('fail','You Dont Have Permissions');
      }
    }

    //function to edit the user details
    public function useredit($user_id)
    {
      $user = User::find($user_id);
      return view('admin.agentUserEdit',compact('user'));
    }

   //function to update the user details
   public function userupdate(Request $request, $user_id)
   {
     $user = User::find($user_id);
     if($user)
     {
       $user->name = $request->name;
       $user->email = $request->email;
       $user->role_as = $request->role_as;
       $user->update();

       return redirect('agent/users')->with('success','Updated Successully');
     }
       return redirect('agent/users')->with('fail','Not Updated Successfully');
   }

   //function to add user
   public function useradd()
   {
     return view('admin.agentUserAdd');
   }

    public function userstore(Request $request)
   {
     $user = new User;
     $user->name = $request->name;
     $user->email = $request->email;
     $user->password = Hash::make($request->password);
     $user->save();

    return redirect('agent/users')->with('success','User Added Successfully');
  }

  //function to get permission
  public function getAllPermissions()
  {
    $permissions =  Permission::where('user_id','=',Auth()->user()->id)->pluck('permission_id')->toArray();
    return $permissions;
  }

}
