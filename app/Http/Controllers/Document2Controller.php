<?php

namespace App\Http\Controllers;

use App\document_action;
use App\e_gq;
use App\reference_naga;
use Illuminate\Http\Request;

class Document2Controller extends Controller
{
    public function reference_naga()
    {
        if (!session()->has('user')) {
            return redirect('login');
        } else {
            $data_document = array();
            $count_document = 0;
            $document = reference_naga::orderBy('id', 'DESC')->get();

            $data = $this->showMenu();
            $data['document'] = $document;


            return view('admin.document.naga', $data);
        }
    }

    public function reference_naga_insert(Request $request)
    {

        if (!empty($request->ref_id)) {
            $data = reference_naga::where('id', $request->ref_id)->first();
        } else {
            $data = new reference_naga();
        }

        $data->year = $request->year;
        $data->string_number = $request->string_number;
        $data->title = $request->title;
        $data->type = $request->type;
        $data->budget = $request->budget;

        $data->account_action = session()->get('user.ldap_username');
        $data->date_action = $this->today();

        $data->save();
        return redirect()->back();

    }

    public function delete_reference_naga($id = '')
    {
        $data = reference_naga::find($id)->delete();
        return redirect()->back();
    }


    public function document_rdi($id = '')
    {
        if (!session()->has('user')) {
            return redirect('login');
        } else {
            $data_document = array();
            $count_document = 0;
            if (!empty($id)) {
                $document = document_action::where('type', $id)->orderBy('id', 'DESC')->get();
            } else {
                $document = document_action::orderBy('id', 'DESC')->get();
            }


            $data = $this->showMenu();
            $data['document'] = $document;

//dd($data['document']);
            return view('admin.document.document', $data);
        }
    }

    public function document_rdi_insert(Request $request)
    {

        if (!empty($request->ref_id)) {
            $data = document_action::where('id', $request->ref_id)->first();
        } else {
            $data = new document_action();
        }

        $data->number = $request->number;
        $data->string_number = $request->string_number;
        $data->date_register = $request->date_register;
        $data->office_from = $request->office_from;
        $data->office_to = $request->office_to;
        $data->title = $request->title;
        $data->account_active = $request->account_active;
        $data->year = $request->year;
        $data->type = $request->type;
        $data->comment = $request->comment;

        $data->account_action = session()->get('user.ldap_username');
        $data->date_action = $this->today();

        $data->save();
        return redirect()->back();

    }

    public function delete_document_rdi($id = '')
    {
        $data = document_action::find($id)->delete();
        return redirect()->back();
    }

    public function running()
    {
        if (!session()->has('user')) {
            return redirect('login');
        } else {
            $data_document = array();
            $count_document = 0;
            $document = e_gq::orderBy('id', 'DESC')->get();

            $data = $this->showMenu();
            $data['document'] = $document;


            return view('admin.document.running', $data);
        }
    }

    public function running_insert(Request $request)
    {

        if (!empty($request->id)) {
            $data = e_gq::where('id', $request->id)->first();
        } else {
            $data = new e_gq();
        }

        $data->runing_number = $request->runing_number;
        $data->gp_number = $request->gp_number;
        $data->person_responsible = $request->person_responsible;
        $data->person_seller = $request->person_seller;
        $data->title = $request->title;
        $data->type_project = $request->type_project;
        $data->budget = $request->budget;
        $data->date_save = $request->date_save;
        $data->year = $request->year;
        $data->comment = $request->comment;

        $data->account_action = session()->get('user.ldap_username');
        $data->date_action = $this->today();

        $data->save();
        return redirect()->back();

    }

    public function delete_running($id = '')
    {
        $data = e_gq::find($id)->delete();
        return redirect()->back();
    }
}
