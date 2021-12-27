<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['users'] = DB::table('users')
            ->orderBy('id','desc')
            ->get();
        return view('admin.user.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = [
            'id' => null,
            'name' => $request->name,
            'email' => $request->email,
            'password' => md5($request->password),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'status' => $request->status,
            'type' => $request->type
        ];
        $id = DB::table('users')->insertGetId($user);
        if (!empty($id)) {
            $response = true;
        } else {
            $response = false;
        }
        echo json_encode($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [];
        $data['user'] = DB::table('users')
            ->where('id', "$id")
            ->first();
        return view('admin.user.edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];
        $data['user'] = DB::table('users')
            ->where('id',$id)
            ->get();
        return view('admin.user.edit', $data);
    }

    /**
     * @param Request $request
     */
    public function update(Request $request)
    {
        $user = [
            'name' => $request->name,
            'updated_at' => date("Y-m-d H:i:s"),
            'status' => $request->status,
            'type' => $request->type,
        ];

        if (!empty($request->password)) {
            $user['password'] = md5($request->password);
        }

        $updated = DB::table('users')
            ->where('id', $request->id)
            ->update($user);
        if ($updated) {
            $response = true;
        } else {
            $response = false;
        }
        echo json_encode($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $deleted = DB::table('users')
            ->where('id', $id)
            ->delete();

        if ($deleted) {
            DB::table('history')
                ->where('user_id',$id)
                ->delete();
            $response = true;
        } else {
            $response = false;
        }
        echo json_encode($response);
    }
}
