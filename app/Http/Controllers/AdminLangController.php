<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminLangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['languages'] = DB::table('languages')->get();
        return view('admin.lang.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.lang.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lang = [
            'language_id' => null,
            'vn' => $request->vn,
            'en' => $request->en,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];

        $id = DB::table('languages')
            ->insertGetId($lang);

        if ($id && $request->lang){
            foreach ($request->lang as $lang){
                $lang_des[] = null;
                if ($lang['title']){
                    $lang_des = [
                        'language_description_id' => null,
                        'language_id' => $id,
                        'title' => $lang['title'],
                        'short_description' => $lang['short_description'],
                        'description' => $lang['description'],
                        'type_description' => $lang['type_description'],
                    ];
                    DB::table('language_descriptions')
                        ->insert($lang_des);
                }
            }
            return back()->with('status','Thêm từ vựng thành công');
        }
        return back()->with('status','Thêm từ vựng thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data['language'] = DB::table('languages')
                ->where('language_id',$id)
                ->first();
            $data['language_descriptions'] = DB::table('language_descriptions')
                ->where('language_id',$id)
                ->get();
            return view('admin.lang.edit', $data);
        }catch (\Exception $exception){
            return back()->with('status', 'Lỗi');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $deleted = DB::table('language_descriptions')
                ->where('language_id', $id)
                ->delete();
            if ($deleted) {
                $lang = [
                    'vn' => $request->vn,
                    'en' => $request->en,
                    'updated_at' => date("Y-m-d H:i:s"),
                ];

                $updated = DB::table('languages')
                    ->where('language_id', $id)
                    ->update($lang);

                if ($updated && $request->lang) {
                    foreach ($request->lang as $lang) {
                        $lang_des[] = null;
                        if ($lang['title']) {
                            $lang_des = [
                                'language_description_id' => null,
                                'language_id' => $id,
                                'title' => $lang['title'],
                                'short_description' => $lang['short_description'],
                                'description' => $lang['description'],
                                'type_description' => $lang['type_description'],
                            ];
                            DB::table('language_descriptions')
                                ->insert($lang_des);
                        }
                    }
                    return back()
                        ->with('status', 'Cập nhật thành công! Bạn muốn sang danh sách ?')
                        ->with('url', route('admin.lang.list'));
                }
            }
        } catch (\Exception $exception) {
            return back()->with('status', 'Lỗi không thể cập nhật');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id) {
            DB::table('languages')
                ->where('language_id', $id)
                ->delete();
            DB::table('language_descriptions')
                ->where('language_id', $id)
                ->delete();
            DB::table('history')
                ->where('language_id', $id)
                ->delete();
            $response = true;
        } else {
            $response = false;
        }
        echo json_encode($response);
    }
}
