<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class SearchController extends Controller
{
    // public function search()
    // {
    //     $users = DB::table('users')->get();

    //     return view('search', ['users' => $users]);
    // }

    public function search(Request $request)
    {
        // $data = DB::table('users')->select("id as id", "name as name", "password as password")->where("name", "LIKE", '%'.$request->input('query'). '%' )->get();

        $output = DB::table('anh_viet')->where('word', 'LIKE', $request->word)->get();

        $output1 = DB::table('anh_viet')->inRandomOrder()->limit(20)->get();

        

        // return $user->email;
        return view('engkids.search',compact('output','output1'));
    }

    public function detail($id){
        $vocabulary = DB::table('anh_viet')->find($id);
        $vocabulary1 = DB::table('anh_viet')->inRandomOrder()->limit(20)->get();
        return view('engkids.searchdetail',compact('vocabulary','vocabulary1'));
    }
}
