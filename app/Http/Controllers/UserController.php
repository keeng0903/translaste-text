<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function history()
    {

        $data = [];
        if (!empty(Session()->get('user_id'))) {
            $user_id = Session()->get('user_id');

            $language_ids = [];
            $histories = DB::table('history')
                ->where('user_id', "$user_id")
                ->orderBy('id', 'desc')
                ->get(array('language_id', 'type'));

            foreach ($histories as $history) {
                $language_ids[] = $history->language_id;
            }

            $languages = DB::table('languages')
                ->whereIn('language_id', array_unique($language_ids))
                ->get();

            foreach ($histories as &$history) {
                foreach ($languages as $language) {
                    if ($history->language_id == $language->language_id && $history->type == TYPE_VIETNAMESE) {
                        $history->input = $language->vn;
                        $history->output = $language->en;
                    } elseif ($history->language_id == $language->language_id && $history->type == TYPE_ENGLISH) {
                        $history->input = $language->en;
                        $history->output = $language->vn;
                    }
                }
            }
            $data['histories'] = $histories;
        }
        return view('engkids.history', $data);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function forgot_account()
    {
        return view('user.forgotPassword.forgotEmail');
    }

    public function otp_account(){
        return view('user.forgotPassword.otp');
    }

    public function change_password(){
        return view('user.forgotPassword.changePassword');
    }
}
