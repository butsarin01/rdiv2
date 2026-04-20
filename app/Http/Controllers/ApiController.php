<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ApiRequestModel;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function get_data_api()
    {
        $url = "https://e-meeting.nsru.ac.th/api/get/search-emp-token/butsarin.n/GXuACswDE1Vs842na";
        $header = array('Content-Type: application/json');
        $method = "GET";
        $postfields = array();
        $send_mode = '';
        $data_api = ApiRequestModel::RequestService($url, $header, $postfields, $method, $send_mode);
        return $data_api;
    }

    public function get_data_api_2()
    {
        $url = "https://e-meeting.nsru.ac.th/api/get/search-token/da438526-ce58-4fa2-a402-c586495148ee";
        $header = array('Content-Type: application/json');
        $method = "GET";
        $postfields = array();
        $send_mode = '';
        $data_api = ApiRequestModel::RequestService($url, $header, $postfields, $method, $send_mode);
        return $data_api;
    }

    public function emp_mail_list($user_account = "")
    {
        $data_api = $this->get_data_api();

        $url = "https://e-meeting.nsru.ac.th/api/get/emp/mail-list/" . $data_api->searchEmpToken . "/" . $user_account;
        $header = array('Content-Type: application/json');
        $method = "GET";
        $postfields = array();

        $student = ApiRequestModel::RequestService($url, $header, $postfields, $method);

        $mail_std = $student->result[0]->NSRU_MAIL ?? null;

        return $mail_std ?? null;
    }

     public function all_search_data_by_mail($email = "")
    {
        $data_api = $this->get_data_api_2();
        $token = urlencode($data_api->searchToken);
        $url = 'https://e-meeting.nsru.ac.th/api/get/account-data/' . $token . '/email/' . urlencode($email) . '/all/student_id,user_id,user_type,orgs,names';
        //        $url = 'https://e-meeting.nsru.ac.th/api/get/account-data/' . $token . '/email/' . urlencode($email) . '/all/student_id,user_id,user_type,orgs,names';
        $header = array('Content-Type: application/x-www-form-urlencoded');
        $method = "GET";
        $postfields = array();
        $send_mode = '';
        $student = ApiRequestModel::RequestService($url, $header, $postfields, $method, $send_mode);

        if (!empty($student->status)) {
            $data = $student->result;
        }
        //       dd($data,$token,$email);
        return $data ?? null;
    }

    public function get_data_token_e_asset()
    {
        $url = "https://e-asset.nsru.ac.th/service/get/sys-token";
        $header = array('Content-Type: application/json');
        $method = "GET";
        $postfields = ["userRequestor" => "butsarin.n"];
        $send_mode = '';
        $data_api = ApiRequestModel::RequestService($url, $header, $postfields, $method, $send_mode);
        // dd($data_api->accessToken);
        return $data_api;
    }


    public function emp_data_search_list($name = "")
    {
        $data_token = $this->get_data_token_e_asset();
        $url = "https://e-asset.nsru.ac.th/service/get/search/user-list";
        $header = array('Content-Type: application/json');
        $method = "POST";
        //        $postfields = ["searchTitle" => $name, "accessToken" => $data_token['accessToken']];
        $postfields = ["searchTitle" => $name, "accessToken" => $data_token->accessToken];
        $send_mode = '';
        $data_user = ApiRequestModel::RequestService($url, $header, $postfields, $method, $send_mode);
        return $data_user ?? null;
    }
}
