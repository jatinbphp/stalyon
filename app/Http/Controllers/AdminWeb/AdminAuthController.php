<?php

namespace App\Http\Controllers\AdminWeb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function adminLoginForm()
    {
        return view('admin.auth.admin_login', ['url' => route('admin.login'), 'title' => 'Admin']);
    }

    public function adminLogin(Request $request)
    {
        // return $request->all();
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::guard('admin_web')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('admin.dashboard');
        } else {
            \Session::flash('danger', 'Invalid Credentials!');
            return redirect()->route('admin.login');
        }
    }

    public function adminLogout()
    {
        Auth::guard('admin_web')->logout();
        return redirect()->route('admin.login');
    }
}
