<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
class LoginController extends Controller

{
    public function adminLogin()
    {
        return view('auth.login');
    }

    public function showChangePasswordForm()
    {
        $user = User::first();;
        return view('auth.password',compact('user'));
    }

    public function changePassword(Request $request)
    {
        // dd( $request->new_password);

        if ($request->new_password != $request->password_confirmation) {
            return back()->with(['failure' => 'Password does not match!']);
        }

        $userRecord = User::where('id', $request->id)->first();
        $user_pass = $userRecord->password;

        // Use Hash::check to verify the old password
        if (!Hash::check($request->password, $user_pass)) {
            return back()->with(['failure' => 'Old password incorrect!']);
        }

        // Update the password field with the hashed new password
        $data = [
            'password' => $request->new_password,
        ];

        $userRecord->update($data);

        return back()->with(['success' => 'Password updated successfully!']);
    }
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in the user using Laravel's built-in authentication
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication successful
            return redirect()->route('index')->with('success', 'Login successful!');
        }

        // Authentication failed
        return redirect()->route('login')->with('error', 'Invalid email or password. Please try again.');
    }
    public function logout(Request $request)
    {
        Auth::logout(); // Logs the user out

        return redirect('/admin'); // Redirect to the login page after logout
    }
//user login register
public function userLogin()
{
 return view('frontend.login');
} public function registerIndex()
{
 return view('frontend.register');
}
    public function userRegister(Request $request)
    {
        $data = $request->all();
        $email_exist = User::where('email', $request->email)->first();
        if (!empty($email_exist)) {
            $response = array('response' => 0);
            return json_encode($response);
        } else {
            $action = "Added";
            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }
            $affected_rows = User::create($data);
            event(new Registered($affected_rows));
            $response = array('response' => 1);
            return json_encode($response);
        }
    }
    public function authenticateUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('home')->with('success', 'Login successful!');
        }
        return redirect()->route('login')->with('error', 'Invalid email or password. Please try again.');
    }
    public function userLogout(Request $request)
    {
        Auth::logout(); // Logs the user out

        return redirect('/login'); // Redirect to the login page after logout
    }

}
