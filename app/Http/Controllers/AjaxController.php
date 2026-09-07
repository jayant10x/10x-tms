<?php

namespace App\Http\Controllers;

use App\Enums\DepartmentsEnum;
use App\Models\Employee;
use Illuminate\Http\Request;

class AjaxController extends Controller {

    public function getSubDepartments(Request $request, $department) {
        $department = DepartmentsEnum::from($department);

        $data = collect(
            DepartmentsEnum::get_sub_departments_by_department($department)
        )->map(fn($department) => [
            'value' => $department->value,
            'label' => $department->label(),
        ])->values();

        return response()->json([
            'data' => $data,
            'message' => 'Sub Departments Found For Department ' . $department->value,
        ]);
    }

    public function getReportingToEmployees(Request $request) {
        $department = $request->department;
        $sub_department = $request->sub_department;
        $emp_id = $request->emp_id;

        $reporting = [];

        if (!empty($department) || !empty($sub_department)) {
            $reportingQuery = Employee::query();
            if (!empty($department)) {
                $reportingQuery->where('emp_department', $department);
            }

            if (!empty($sub_department)) {
                $reportingQuery->where('emp_sub_department', $sub_department);
            }

            if (!empty($emp_id)) {
                $reportingQuery->whereNot('emp_id', $emp_id);
            }
            $reporting = $reportingQuery
                ->get(['emp_id', 'emp_full_name'])
                ->map(function ($employee) {
                    return [
                        'value' => $employee->emp_id,
                        'label' => $employee->emp_full_name,
                    ];
                })
                ->values();
        }
        return response()->json([
            'data' => $reporting,
            'message' => 'Reporting to ' . $department . ' For Department ' . $sub_department,
        ]);
    }
}
