<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Override the username method to use 'user_name' instead of 'email'
    public function username()
    {
        return 'user_name';
    }

    // Override the credentials method to include the 'user_name' field
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    // Override the authenticated method to customize the redirect logic
    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended($this->redirectTo);
    }
}

