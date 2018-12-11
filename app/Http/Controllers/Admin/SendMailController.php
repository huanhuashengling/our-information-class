<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SendMailList;

class SendMailController extends Controller
{
    public function index() {
        return view('admin/send-mail/index');
    }

    public function listAllMails() {
        $senMailLists = SendMailList::all();
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
