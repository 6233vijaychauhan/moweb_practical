<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Employee\Upsert;

class EmployeeController extends Controller {

    // Employee oject for global use in current controller
    protected $employeeObj;

    // Constructor passing employee details using employee object
    public function __construct(Employee $employeeObj) {
        $this->employeeObj = $employeeObj;
    }

    // Employee list method
    public function index() {

        $data['page_title'] = "Employee List";
        $companies = Company::orderBy('id', 'desc')->pluck('name', 'id');
        return view('admin.employee.index', compact('companies'))->with($data);
    }

    // Employee list ajax method
    public function listing(Request $request) {
        try {
            if ($request->ajax()) {
                $data = $this->employeeObj->with('company')->get();
                //dd($data->toArray());
                //$data = Employee::with('getCompanyDetails')->get();
                $all_doctor = Datatables::of($data)
                        ->addIndexColumn()
                        ->editColumn('company.name', function (Employee $data) {
                            return $data->company ? $data->company->name : "";
                        })
                        ->addColumn('action', function($employee) {
                            $action = "";
                            $action .= "<a href=" . route('employee.show', $employee->id) . " class='view btn btn-primary btn-sm mr-1'><i class='fa fa-eye' aria-hidden='true'></i></a>";

                            $action .= "<a href='javascript:void(0);' class='button_employee_edit btn btn-info btn-sm mr-1' data-edit='" . $employee . "' data-id=\"" . $employee->id . "\" data-url='" . route('employee.edit', $employee->id) . "'><i class='fa fa-pencil' aria-hidden='true'></i></a>";

                            $action .= "<a href='javascript:void(0);' class='button_employee_delete btn btn-danger btn-sm' data-id=\"" . $employee->id . "\" data-url='" . route('employee.delete', $employee->id) . "'><i class='fa fa-trash' aria-hidden='true'></i></a>";

                            return $action;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                return $all_doctor;
            }
        } catch (\Exception $exception) {
            return redirect()->route('employee.index')->with('error', 'Something went wrong, please try again');
        }
    }

    // Employee add method
    public function create() {

        $data['page_title'] = "Add Employee";
        $companies = Company::orderBy('id', 'desc')->pluck('name', 'id');
        return view('admin.employee.create', compact('companies'))->with($data);
    }

    // Employee store method for store data
    public function store(Upsert $request) {

        try {
            $this->employeeObj->create($request->validated());
            $data['page_title'] = "Employee List";
            return redirect()->route('employee.index')->with('success', 'Employee has been added successfully')->with($data);
        } catch (\Exception $exception) {
            return redirect()->route('employee.index')->with('error', 'Something went wrong, please try again');
        }
    }

    // Employee view method for show compay details
    public function show(Employee $employee, $id) {

        try {
            $employee = $this->employeeObj->with('company')->find($id);
            if (empty($employee)) {
                return redirect()->route('employee.index')->with('error', "Sorry, we didn't get the company");
            }
            $data['page_title'] = "View Employee";
            return view('admin.employee.view', compact('employee'))->with($data);
        } catch (\Exception $exception) {
            return redirect()->route('employee.index')->with('error', 'Something went wrong, please try again');
        }
    }

    // Employee update method for update company details
    public function update(Upsert $request, Employee $employee) {

        $employee->update($request->validated());
        return redirect()->route('employee.index');
    }

    // Employee delete method for delete company details
    public function destroy(Employee $employee, $id) {

        try {
            Employee::where('id', $id)->delete();
            return redirect()->route('employee.index')->with('success', 'Employee has been removed successfully');
        } catch (\Exception $exception) {
            return redirect()->route('employee.index')->with('error', 'Something went wrong, please try again');
        }
    }

}
