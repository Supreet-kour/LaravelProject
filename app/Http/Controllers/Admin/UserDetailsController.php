<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Permission;
use App\Models\PermissionList;

class UserDetailsController extends Controller
{
   //function to view all the users
    public function index(Request $request)
    {
       $search = $request['search'] ?? "";
       if($search !="")
       {
           $users = User::where('name','LIKE',"%$search%")
               ->orWhere('email','LIKE',"%$search%")
               ->get();
       }
       else
       {
           $users = User::all()->whereIn('role_as', [0, 2]);

       }

       $data = compact('users','search');
      return view('admin.user')->with($data);
    }

  //function to edit the user details
    public function edit($user_id)
    {
      $user = User::find($user_id);
      $permissions = PermissionList::select('id','permission_name')->get()->toArray();
      return view('admin.userEdit',compact('user','permissions'));
    }

  //function to update the user details
   public function update(Request $request, $user_id)
   {
       $permission_ids = $request->permission_ids;

       $permissionsToApply = [];
       if (!empty($permission_ids)) {
           foreach ($permission_ids as $permission_id) {
               if ($permission_id == 2 || $permission_id == 3) {
                   if (!in_array(1, $permission_ids)) {
                       return redirect('admin/users')->with('fail', 'Unable to process your request! Please apply valid permissions......');
                   } else {
                       $permissionsToApply[] = $permission_id;
                   }
               } elseif ($permission_id == 5 || $permission_id == 6) {
                   if (in_array(4, $permission_ids)) {
                       $permissionsToApply[] = $permission_id;
                   } else {
                       return redirect('admin/users')->with('fail', 'Unable to process your request! Please apply valid permissions......');
                   }
               }
               else {
                   $permissionsToApply[] = $permission_id;
               }
           }
       }

       $this->appendPermissionsToUser($permissionsToApply, $user_id);

       $user = User::find($user_id);
       if ($user) {
           $user->name = $request->name;
           $user->email = $request->email;
           $user->role_as = $request->role_as;
           $user->update();
       }

       return redirect('admin/users')->with('success', 'Updated Successfully!!');
   }

  //function to add the user
   public function add()
   {
     return view('admin.userAdd');
   }

    public function store(Request $request)
   {
     $user = new User;
     $user->name = $request->name;
     $user->email = $request->email;
     $user->password = Hash::make($request->password);
     $user->save();

   return redirect('admin/users')->with('success','User Added Successfully');
  }


  public function appendPermissionsToUser($permissionToApply, $userId){

        if(empty($permissionToApply)){
            return;
        }

        foreach($permissionToApply as $permission_id){
            $oldPermission = DB::table('permissions')
                ->where('permission_id','=',$permission_id)
                ->where('user_id','=',$userId)
                ->value('id');
            $permission = $oldPermission?Permission::find($oldPermission):new Permission;
            $permission->permission_id = $permission_id;
            $permission->user_id = $userId;
            $permission->save();
        }
  }



}
