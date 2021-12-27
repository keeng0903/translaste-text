<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class AdminController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        return view('admin.login');
    }

    /**
     * @param Request $request
     */
    public function confirm(Request $request)
    {
        $password = md5($request->password);
        $admin = DB::table('users')
            ->where('email', "$request->email")
            ->where('password', "$password")
            ->where('type', TYPE_USER_ADMIN)
            ->where('status', STATUS_ACTIVE)
            ->first();

        if (!empty($admin)) {
            $request->session()->put('email', $admin->email);
            $request->session()->put('name', $admin->name);
            return redirect('admin/dashboard');
        }

        return back()->with('message', 'Sai mật khẩu hoặc tài khoản');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show_dashboard(Request $request)
    {
        $data['languages'] = DB::table('languages')
            ->count();
        $data['accountAdmin'] = DB::table('users')
            ->where('type', TYPE_USER_ADMIN)
            ->where('type', TYPE_USER_EDITOR)
            ->count();
        $data['accountUser'] = DB::table('users')
            ->where('type', TYPE_USER_NORMAL)
            ->count();
        return view('admin.dashboard', $data);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function logout()
    {
        Session()->put('email', null);
        Session()->put('name', null);
        return redirect('/');

    }
}
