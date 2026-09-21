<?php

namespace App\Http\Controllers;

use App\Models\document_action;
use App\Models\e_gq;
use App\Models\reference_naga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Document2Controller extends Controller
{
    protected function authorizeRegisters(): void
    {
        $permission = (int) session('user.permission', session('user.permisstion', 0));
        abort_unless(in_array($permission, [2, 3, 5], true), 403);
    }

    public function reference_naga()
    {
        $this->authorizeRegisters();
        if (! session()->has('user')) {
            return redirect('login');
        } else {
            request()->validate(['year' => ['nullable', 'regex:/^(?:[0-9]{1,10}|all|unassigned)$/']]);
            $yearExpression = "COALESCE(NULLIF(TRIM(year), ''), 'unassigned')";
            $years = DB::query()->fromSub(reference_naga::selectRaw($yearExpression.' as budget_year'), 'year_records')
                ->selectRaw('budget_year as year, COUNT(*) as total')->groupBy('budget_year')->get()
                ->sortByDesc(fn ($row) => preg_match('/^[0-9]{4}$/', (string) $row->year) ? (int) $row->year : -1)->values();
            $selectedYear = (string) (request('year') ?: ($years->first()?->year ?? (date('Y') + 543)));
            $document = reference_naga::when($selectedYear !== 'all', fn ($query) => $query->whereRaw($yearExpression.' = ?', [$selectedYear]))
                ->orderByDesc('id')->get();

            $data = $this->showMenuv1();
            $data['document'] = $document;

            $data['years'] = $years;
            $data['selectedYear'] = $selectedYear;
            $data['totalCount'] = (int) $years->sum('total');

            return view('backend.rdi_document.naga', $data);
        }
    }

    public function reference_naga_insert(Request $request)
    {
        $this->authorizeRegisters();
        $request->validate(['year' => 'required|digits:4']);

        if (! empty($request->ref_id)) {
            $data = reference_naga::where('id', $request->ref_id)->first();
        } else {
            $data = new reference_naga;
        }

        $data->year = $request->year;
        $data->string_number = $request->string_number;
        $data->title = $request->title;
        $data->type = $request->type;
        $data->budget = $request->budget;

        $data->account_action = session()->get('user.ldap_username');
        $data->date_action = $this->today();

        $data->save();

        return redirect()->route('reference_naga.show', ['year' => $data->year]);

    }

    public function delete_reference_naga($id = '')
    {
        $this->authorizeRegisters();
        $data = reference_naga::find($id)->delete();

        return redirect()->back();
    }

    public function document_rdi($id = '')
    {
        $this->authorizeRegisters();
        abort_unless($id === '' || in_array((string) $id, ['1', '2'], true), 404);
        if (in_array((string) $id, ['1', '2'], true)) {
            request()->validate(['year' => ['nullable', 'regex:/^(?:[0-9]{1,10}|all|unassigned)$/']]);
            $validSuffix = DB::getDriverName() === 'sqlite'
                ? "TRIM(string_number) GLOB '*/[0-9][0-9][0-9][0-9]'"
                : "TRIM(string_number) REGEXP '/[0-9]{4}$'";
            $yearExpression = "CASE WHEN $validSuffix THEN SUBSTR(TRIM(string_number), -4) ELSE 'unassigned' END";
            $scope = document_action::where('type', (int) $id);
            $years = DB::query()->fromSub((clone $scope)->selectRaw($yearExpression.' as budget_year'), 'year_records')
                ->selectRaw('budget_year as year, COUNT(*) as total')->groupBy('budget_year')->get()
                ->sortByDesc(fn ($row) => preg_match('/^[0-9]{4}$/', (string) $row->year) ? (int) $row->year : -1)->values();
            $selectedYear = (string) (request('year') ?: ($years->first()?->year ?? (date('Y') + 543)));
            $document = $scope->when($selectedYear !== 'all', fn ($query) => $query->whereRaw($yearExpression.' = ?', [$selectedYear]))
                ->select('*')->selectRaw($yearExpression.' as display_year')
                ->orderByDesc('id')->get();

            return view('backend.rdi_document.document_yearly', array_merge($this->showMenuv1(), [
                'document' => $document, 'document_type' => (int) $id, 'years' => $years,
                'selectedYear' => $selectedYear, 'totalCount' => (int) $years->sum('total'),
            ]));
        }
        if (! session()->has('user')) {
            return redirect('login');
        } else {
            $data_document = [];
            $count_document = 0;
            if (! empty($id)) {
                $document = document_action::where('type', $id)->orderBy('id', 'DESC')->get();
            } else {
                $document = document_action::orderBy('id', 'DESC')->get();
            }

            $data = $this->showMenuv1();
            $data['document'] = $document;

            // dd($data['document']);
            $data['document_type'] = (int) ($id ?: 1);

            return view('backend.rdi_document.document', $data);
        }
    }

    public function document_rdi_insert(Request $request)
    {
        $this->authorizeRegisters();
        if (! $request->filled('ref_id') && $request->filled('doc_id')) {
            $request->merge(['ref_id' => $request->doc_id]);
        }
        $request->validate(['type' => 'required|in:1,2', 'ref_id' => 'nullable|integer|exists:document_actions,id']);
        if ((string) $request->type === '2') {
            $request->validate(['year' => 'nullable|digits:4']);
        }

        if (! empty($request->ref_id)) {
            $data = document_action::where('id', $request->ref_id)->first();
        } else {
            $data = new document_action;
        }

        $data->number = $request->number;
        $data->string_number = $request->string_number;
        $data->date_register = $request->date_register;
        $data->office_from = $request->office_from;
        $data->office_to = $request->office_to;
        $data->title = $request->title;
        $data->account_active = $request->account_active;
        $data->year = $request->year ?: ($data->year ?: (date('Y') + 543));
        $data->type = $request->type;
        if ($request->has('comment')) {
            $data->comment = $request->comment;
        }

        $data->account_action = session()->get('user.ldap_username');
        $data->date_action = $this->today();

        $data->save();

        $displayYear = preg_match('~/([0-9]{4})$~', trim((string) $data->string_number), $matches) ? $matches[1] : 'unassigned';

        return redirect()->route('document_rdi.show', ['id' => (int) $data->type, 'year' => $displayYear]);

    }

    public function delete_document_rdi($id = '')
    {
        $this->authorizeRegisters();
        $data = document_action::find($id)->delete();

        return redirect()->back();
    }

    public function running()
    {
        $this->authorizeRegisters();
        if (! session()->has('user')) {
            return redirect('login');
        } else {
            request()->validate(['year' => ['nullable', 'regex:/^(?:[0-9]{1,10}|all|unassigned)$/']]);
            $yearExpression = "COALESCE(NULLIF(TRIM(year), ''), 'unassigned')";
            $years = DB::query()->fromSub(e_gq::selectRaw($yearExpression.' as budget_year'), 'year_records')
                ->selectRaw('budget_year as year, COUNT(*) as total')->groupBy('budget_year')->get()
                ->sortByDesc(fn ($row) => preg_match('/^[0-9]{4}$/', (string) $row->year) ? (int) $row->year : -1)->values();
            $selectedYear = (string) (request('year') ?: ($years->first()?->year ?? (date('Y') + 543)));
            $document = e_gq::when($selectedYear !== 'all', fn ($query) => $query->whereRaw($yearExpression.' = ?', [$selectedYear]))
                ->orderByDesc('id')->get();

            $data = $this->showMenuv1();
            $data['document'] = $document;

            $data['years'] = $years;
            $data['selectedYear'] = $selectedYear;
            $data['totalCount'] = (int) $years->sum('total');

            return view('backend.rdi_document.running', $data);
        }
    }

    public function running_insert(Request $request)
    {
        $this->authorizeRegisters();
        $request->validate(['year' => 'required|digits:4', 'id' => 'nullable|integer|exists:e_gqs,id']);

        if (! empty($request->id)) {
            $data = e_gq::findOrFail($request->id);
        } else {
            $data = new e_gq;
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
        if ($request->has('comment')) {
            $data->comment = $request->comment;
        }

        $data->account_action = session()->get('user.ldap_username');
        $data->date_action = $this->today();

        $data->save();

        return redirect()->route('running.show', ['year' => $data->year]);

    }

    public function delete_running($id = '')
    {
        $this->authorizeRegisters();
        $data = e_gq::find($id)->delete();

        return redirect()->back();
    }
}
