<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CameraController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function camera()
    {
        return view('engkids.camera');
    }

    /**
     * @param Request $request
     */
    public function result_camera(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');

            $language = DB::table('languages')
                ->Where('en', 'LIKE', "%{$query}%")
                ->first();

            if ($language->language_id) {
                $language_descriptions = DB::table('language_descriptions')
                    ->Where('language_id', $language->language_id)
                    ->where('type_description', "vn")
                    ->get();
                $output = '<div class="form-control">';
                $output .= '<h3>Dịch từ : <i>' . $language->en . ' -> ' . $language->vn . '</i></h3>';
                $output .= '</div>';
                if ($language_descriptions){
                    $output .= '<div class="form-control" style="display: table">';

                    foreach ($language_descriptions as $language_description){
                        $output .='<h4>' . $language_description->title . '</h4>
                            <p class="text-color">'. $language_description->short_description .'</p>
                            <i class="text-color">'. $language_description->description .'</i>';
                    }
                    $output.= '</div>';
                }
                echo $output;
            }
        }
    }
}
