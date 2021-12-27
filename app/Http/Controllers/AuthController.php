<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        return view('user.login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function confirm(Request $request)
    {
        $password = md5($request->get('password'));
        $email = $request->get('email');
        $admin = DB::table('users')
            ->where('email', "$email")
            ->where('password', "$password")
            ->where('type', TYPE_USER_NORMAL)
            ->where('status', STATUS_ACTIVE)
            ->first();

        if (!empty($admin)) {
            $request->session()->put('user', $admin->email);
            $request->session()->put('user_id', $admin->id);
            $request->session()->put('name_user', $admin->name);
            $response = false;
        }else{
            $response = true;
        }
        echo json_encode($response);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Session()->put('user', NULL);
        Session()->put('user_id', NULL);
        Session()->put('name_user', NULL);
        return redirect('/home')->with('status','Đăng xuất thành công!');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function confirm_register(Request $request)
    {
        $user = [];

        if (!empty($request->name) && !empty($request->email) && !empty($request->password)) {
            $user = [
                'id' => null,
                'name' => $request->name,
                'email' => $request->email,
                'password' => md5($request->password),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'status' => STATUS_ACTIVE,
                'type' => TYPE_USER_NORMAL
            ];

            $id = DB::table('users')->insertGetId($user);
            if (!empty($id)) {
                $response = true;
            } else {
                $response = false;
            }
            echo json_encode($response);
        }
    }

    /**
     * @param Request $request
     */
    public function check_exist_email(Request $request)
    {
        $email = $request->get('email_exist');
        if ($email){
            $admin = DB::table('users')
                ->where('email', "$email")
                ->count();
            if (!empty($admin)) {
                $response = true;
            } else {
                $response = false;
            }
        }
        echo json_encode($response);

    }

    public function forgot(){
        return view('auth.forgot');
    }
}
