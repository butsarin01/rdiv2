<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiRequestModel;


class nriisController extends Controller
{
	public function get_data_api()
    {
    	$url = "https://api.nriis.nrct.go.th/service/user/v1/authenticate";
    	$header = array('Content-Type: text/json');
    	$method = "POST";
    	$postfields = [
    		"loginName" => "Kreak.J", 
    		"loginPassword" => "nsru123!"
    	];

       $data_api = ApiRequestModel::RequestService($url,$header,$postfields,$method);

       return $data_api;

    }


    public function proposal(Request $request)
    {

    	// $data_api = $this->get_data_api();
     //    dd($data_api);

    	$url = "https://api.nriis.nrct.go.th/service/department/v1/Proposal/2561";
    	$header = array('Authorization: Bearer '.'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjUxMDM4OCIsImdyb3VwIjoiOTQiLCJuYmYiOjE2MTU3NzgzMjEsImV4cCI6MTYxNjM4MzEyMSwiaWF0IjoxNjE1Nzc4MzIxfQ.YMzxcB7OkhCPBpJ7pQf0_rREAB5_A_arLe53AjsXwgU');
    	$method = "GET";
    	$postfields = array();

       	$proposals = ApiRequestModel::RequestService($url,$header,$postfields,$method);

		$data = $this->showMenu(); 
		$data['proposals'] = $proposals;   

        return view('nriis_index', $data);
     
    }

    public function proposalDetail($propID = "")
    {
    	$data_api = $this->get_data_api();

    	$url = "https://api.nriis.nrct.go.th/service/department/v1/Proposal/ProposalDetail/376688";
    	$header = array('Authorization: Bearer '.$data_api->token);
    	$method = "GET";
    	$postfields = array();

       	$proposalDetail = ApiRequestModel::RequestService($url,$header,$postfields,$method);

		dd($proposalDetail);
		$data = $this->showMenu(); 
		$data['proposalDetail'] = $proposalDetail;   

        return view('nriis_index', $data);
     
    }

    public function researcherList(Request $request)
    {
    	$data_api = $this->get_data_api();

    	$url = "https://api.nriis.nrct.go.th/service/department/v1/Researcher/List";
    	$header = array('Authorization: Bearer '.$data_api->token);
    	$method = "GET";
    	$postfields = array();

       	$researchers = ApiRequestModel::RequestService($url,$header,$postfields,$method);

		$data = $this->showMenu();
		$data['researchers'] = $researchers;

        return view('nriis_index', $data);
     
    }

    public function researcherProfile($userID ="")
    {
    	$data_api = $this->get_data_api();

    	$url = "https://api.nriis.nrct.go.th/service/department/v1/Researcher/UserProfile/12345";
    	$header = array('Authorization: Bearer '.$data_api->token);
    	$method = "GET";
    	$postfields = array();

       	$researcherProfile = ApiRequestModel::RequestService($url,$header,$postfields,$method);

		$data = $this->showMenu();
		$data['researcherProfile'] = $researcherProfile;

        return view('nriis_index', $data);
     
    }

}
