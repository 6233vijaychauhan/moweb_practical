<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\company\Upsert;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller {

    // Company oject for global use in current controller
    protected $companyObj;

    // Constructor passing company details using company object
    public function __construct(Company $companyObj) {
        $this->companyObj = $companyObj;
    }

    // Company list method
    public function index() {
        $data['page_title'] = "Company List";
        return view('admin.company.index')->with($data);
    }

    // Company list ajax method
    public function listing(Request $request) {
        try {
            if ($request->ajax()) {
                $data = $this->companyObj->get();
                $all_doctor = Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function ($company) {
                            $action = "";
                            $action .= "<a href=" . route('companies.show', $company->id) . " class='view btn btn-primary btn-sm mr-1'><i class='fa fa-eye' aria-hidden='true'></i></a>";

                            $action .= "<a href='javascript:void(0);' class='button_copmany_edit btn btn-info btn-sm mr-1' data-edit='" . $company . "' data-id=\"" . $company->id . "\" data-url='" . route('companies.edit', $company->id) . "'><i class='fa fa-pencil' aria-hidden='true'></i></a>";

                            $action .= "<a href='javascript:void(0);' class='button_copmany_delete btn btn-danger btn-sm' data-id=\"" . $company->id . "\" data-url='" . route('companies.delete', $company->id) . "'><i class='fa fa-trash' aria-hidden='true'></i></a>";

                            return $action;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                return $all_doctor;
            }
        } catch (\Exception $exception) {
            return redirect()->route('companies.index')->with('error', 'Something went wrong, please try again');
        }
    }

    // Company add method
    public function create() {
        $data['page_title'] = "Add Company";
        return view('admin.company.create')->with($data);
    }

    // Company store method for store data
    public function store(Upsert $request) {
        try {
            $inputs = $request->validated();
            if (isset($inputs['logo']) && !empty($inputs['logo'])) {
                $logoImageName = saveAvatar($request->file('logo'));
                $inputs['logo'] = $logoImageName ? $logoImageName : null;
            }
            $this->companyObj->create($inputs);
            $data['page_title'] = "Company List";
            return redirect()->route('companies.index')->with('success', 'Company has been added successfully')->with($data);
        } catch (\Exception $exception) {
            return redirect()->route('companies.index')->with('error', 'Something went wrong, please try again');
        }
    }

    // Company view method for show company details
    public function show(Company $company, $id) {
        try {
            $company = $this->companyObj->find($id);
            if (empty($company)) {
                return redirect()->route('companies.index')->with('error', "Sorry, we didn't get the company");
            }
            $data['page_title'] = "View Company";
            return view('admin.company.view', compact('company'))->with($data);
        } catch (\Exception $exception) {
            return redirect()->route('companies.index')->with('error', 'Something went wrong, please try again');
        }
    }

    // Company update method for update company details
    public function update(Upsert $request, Company $company) {
        $inputs = $request->validated();
        if (isset($inputs['logo']) && !empty($inputs['logo'])) {
            $logoImageName = saveAvatar($inputs['logo']);
            if ($logoImageName) {
                deleteAvatar($this->companyObj->logo);
                $inputs['logo'] = $logoImageName;
            }
        }
        $company->update($inputs);
        return redirect()->route('companies.index');
    }

    // Company delete method for delete company details
    public function destroy(Company $company, $id) {
        try {
            $this->companyObj->where('id', $id)->delete();
            return redirect()->route('companies.index')->with('success', 'Company has been removed successfully');
        } catch (\Exception $exception) {
            return redirect()->route('companies.index')->with('error', 'Something went wrong, please try again');
        }
    }

}
