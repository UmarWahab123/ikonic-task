<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function users(){
        $users = User::where('role_id',2)->get();
        return view('user.index',compact('users'));
    }
    public function deleteUser(Request $request)
    {
        $id = $request->input('id');
        $user = User::find($id);
       if ($user) {
            $affected_rows = $user->delete();
            return back()->with(['success' => 'User has been deleted successfully!']);
       }else{
         return back()->with(['error' => 'User not found!']);
       }

    }
}
