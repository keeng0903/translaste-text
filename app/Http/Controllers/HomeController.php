<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $lang  = DB::table('type_languages')->orderByRaw('language_type_id')->get();
        $data['option_languages'] = $lang;
        $data['randomEns'] = DB::table('languages')
            ->inRandomOrder()
            ->limit(8)
            ->get();
        return view('engkids.homeTranslate', $data);
    }

    /**
     * @param Request $request
     */
    function result_search(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $type = $request->get('type');

            $data = DB::table('languages')
                ->Where("{$type}", 'LIKE', "%{$query}%")
                ->limit(10)
                ->orderByRaw('language_id')
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row) {
                    $output .= '<li style="width: 300px;font-size: large"><a href="#">' . $row->{$type} . '</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    /**
     * @param Request $request
     */
    function translated(Request $request)
    {
        if ($request->get('translated')) {
            $type_output = $request->get('type_output');
            $type_input = $request->get('type_input');
            $translated = $request->get('translated');
            $data_translated = DB::table('languages')
                ->where("{$type_input}", '=', "$translated")
                ->limit(1)
                ->get();
            $output = '';
            foreach ($data_translated as $row) {
                $output .=$row->{$type_output};
            }
            echo $output;

        }
    }
    function input_translated(Request $request)
    {
        if ($request->get('translated')) {
            $type_output = $request->get('type_output');
            $type_input = $request->get('type_input');
            $translated = $request->get('translated');
            $data_translated = DB::table('languages')
                ->where("{$type_input}", 'LIKE', "%{$translated}%")
                ->limit(1)
                ->get();
            $output = '';
            foreach ($data_translated as $row) {
                $output .=$row->{$type_output};
            }
            echo $output;

        }
    }

    /**
     * @param Request $request
     */
    public function insert_history(Request $request)
    {
        if (!empty(Session()->get('user_id'))) {
            $type_input = $request->get('type_input');
            $translated = $request->get('translated');
            $user_id = Session()->get('user_id');

            $data_translated = DB::table('languages')
                ->where("{$type_input}", '=', "$translated")
                ->limit(1)
                ->get();

            foreach ($data_translated as $row) {
                $language_id = $row->language_id;
            }

            if ($data_translated){
                $history = [
                    'id' => null,
                    'user_id' => $user_id,
                    'language_id' => $language_id,
                    'type' => $type_input
                ];
                DB::table('history')->insert($history);
            }
        }
    }
    /**
     * @param Request $request
     */
    public function output_lang(Request $request)
    {
        if ($request->get('type_language')) {
            $type = $request->get('type_language');
            $lang_type = DB::table('type_languages')
                ->where('type', '!=', "$type")
                ->get();
            $output = '';
            foreach ($lang_type as $row) {
                $output .= '<option value="' . $row->type . '">' . $row->name . '</option>';
            }
            echo $output;
        }
    }

    /**
     * @param Request $request
     */
    public function input_lang(Request $request)
    {
        if ($request->get('type_language')) {
            $type = $request->get('type_language');
            $lang_type = DB::table('type_languages')
                ->get();
            $output = '';
            foreach ($lang_type as $row) {
                $selected = '';
                if ($row->type == $type){
                    $selected = 'selected';
                }
                $output .= '<option value="' . $row->type . '" '.$selected.' >' . $row->name . '</option>';
            }
            echo $output;
        }
    }

    /**
     * @param Request $request
     */
    public function lang_details(Request $request)
    {
        if ($request->get('lang_translated')) {
            $type = $request->get('lang_translated');
            $type_output = $request->get('type_output');
            $language_id = DB::table('languages')
                ->where("{$type_output}", '=', "$type")
                ->value('language_id');

            $synonyms = DB::table('languages')
                ->where("{$type_output}", 'LIKE', "%{$type}%")
                ->get();

            $descriptions = DB::table('language_descriptions')
                ->where("language_id", "$language_id")
                ->where('type_description', "{$type_output}")
                ->get();

            $output = '<div class="form-group" id="lang_details" style="padding: 5px;"><div class="form-control" >
                            <h4 style="float: left">Bản dịch từ : <i>' . $type . '</i></h4>
                        </div>';
            $output .= '<div class="form-control" style="display: table">';
            foreach ($synonyms as $synonym) {
                $output .= '
                <a href="" class="button-result"><p>' . $synonym->{$type_output} . '</p></a><p class="button-result">,
                ';
            }
            $output .= '</div><div class="form-control" style="display: table">';
            foreach ($descriptions as $description) {
                $output .= '<h4 style="font-weight: bold">'.$description->title.' : </h4>
                            <p class="text-color"> '.$description->short_description.'</p>
                            <i class="text-color">'.$description->description.'</i>';
            }
            $output .='</div></div>';
            echo $output;
        }
    }

    /**
     * @param Request $request
     */
    public function histories(Request $request)
    {
        if (!empty($request->user_id)) {
            $language_ids = [];
            $histories = DB::table('history')
                ->where('user_id', "$request->user_id")
                ->orderBy('id','desc')
                ->get(array('language_id', 'type'));

            foreach ($histories as $history) {
                $language_ids[] = $history->language_id;
            }


            $languages = DB::table('languages')
                ->whereIn('language_id', array_unique($language_ids))
                ->get();

            foreach ($histories as &$history){
                foreach ($languages as $language){
                    if ($history->language_id == $language->language_id && $history->type == TYPE_VIETNAMESE){
                        $history->input = $language->vn;
                        $history->output = $language->en;
                    }elseif($history->language_id == $language->language_id && $history->type == TYPE_ENGLISH){
                        $history->input = $language->en;
                        $history->output = $language->vn;
                    }
                }
            }

            $output = '<div class="form-control">
                            <h4 style="float: left">Lịch Sử tìm kiếm</h4>
                        </div>';

            foreach ($histories as $history) {
                $output .= '<div class="form-control">
                            <h4 style="float: left">' . $history->input . ' : <i>' . $history->output . '</i></h4>
                        </div>';
            }
            echo $output;
        }
    }

    /**
     * @param Request $request
     */
    public function suggestion_input(Request $request)
    {
        if ($request->language_id) {
            $language_id = $request->language_id;
            $language = DB::table('languages')
                ->where('language_id', $language_id)
                ->first();
            echo $language->en;
        }
    }

    /**
     * @param Request $request
     */
    public function suggestion_output(Request $request)
    {
        if ($request->language_id) {
            $language_id = $request->language_id;
            $language = DB::table('languages')
                ->where('language_id', $language_id)
                ->first();
            echo $language->vn;
        }
    }
}
