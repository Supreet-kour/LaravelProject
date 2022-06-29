<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;

class ChangePasswordController extends Controller
{
    public function index()
    {
      return view('auth.changePassword');
    }

    public function update(Request $request)
    {
    $request->validate([
      'old_password' =>'required|string|min:8',
      'new_password' =>'required|string|min:8',
      'confirm_password' => 'required|same:new_password'
    ]);

    $current_user = auth()->user();
    if(Hash::check($request->old_password,$current_user->password))
    {
      $current_user->update([
        'password'=>bcrypt($request->new_password )
      ]);
      return view('auth.login')->with('success','Password Successfully Changed');

    }
    else
    {
      return redirect()->back()->with('fail','Old Password Doesnot Match');
    }
}
}
