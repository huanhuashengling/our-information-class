<?php

namespace App\Http\Controllers\School;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SendMailList;

class SendMailController extends Controller
{
    public function index() {
        return view('school/send-mail/index');
    }

    public function listAllMails() {
        $senMailLists = SendMailList::where("schools_id", "=", \Auth::guard("school")->id())->get();
        return $senMailLists;
    }

    public function addSendMail(Request $request) {
        $sendMail = new SendMailList();
        $sendMail->server_provider = $request->get('serverProvider');
        $sendMail->num_limit_one_day = $request->get('numLimitOneDay');
        $sendMail->username = $request->get('username');
        $sendMail->mail_address = $request->get('mailAddress');
        $sendMail->password = $request->get('password');
        $sendMail->auth_code = $request->get('authCode');
        $sendMail->is_useable = $request->get('isUseable');
        $sendMail->schools_id = \Auth::guard("school")->id();

        if ($sendMail->save()) {
            return "true";
        }
    }

    public function updateSendMail(Request $request) {

        $sendMail = SendMailList::find($request->get('id'));
        $sendMail->server_provider = $request->get('serverProvider');
        $sendMail->num_limit_one_day = $request->get('numLimitOneDay');
        $sendMail->username = $request->get('username');
        $sendMail->mail_address = $request->get('mailAddress');
        $sendMail->password = $request->get('password');
        $sendMail->auth_code = $request->get('authCode');
        $sendMail->is_useable = $request->get('isUseable');

        if ($sendMail->update()) {
            return "true";
        }
    }
}
