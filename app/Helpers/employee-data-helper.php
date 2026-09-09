<?php

use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

function get_logged_in_user_employee_data() {
    if (!Auth::check()) {
        return null;
    }

    return Employee::find(Auth::user()->adm_emp_id);
}

function get_employee_data($emp_id) {
    return Employee::find($emp_id);
}
function get_logged_in_user_id() {
    return Auth::id();
}

function get_logged_in_adm_name() {
    if (!Auth::check()) {
        return null;
    }
    return Auth::user()->adm_name;
}

function get_logged_in_adm_pic() {
    return Auth::user()?->adm_pic;
}

function get_logged_in_user_emp_id() {
    return get_logged_in_user_employee_data()?->emp_id;
}

function get_logged_in_user_emp_name() {
    return get_logged_in_user_employee_data()?->emp_full_name;
}

function get_logged_in_user_emp_internal_id() {
    return get_logged_in_user_employee_data()?->emp_internal_id;
}

function get_logged_in_user_emp_department() {
    return get_logged_in_user_employee_data()?->emp_department;
}

function get_logged_in_user_emp_sub_department() {
    return get_logged_in_user_employee_data()?->emp_sub_department;
}

function get_logged_in_user_emp_status() {
    return get_logged_in_user_employee_data()?->emp_status;
}

function get_logged_in_user_emp_profile_pic() {
    return get_logged_in_user_employee_data()?->emp_photo;
}

function is_admin() {
    return Auth::user()->adm_role == 'admin';
}

if (!function_exists('getEmployeeChildren')) {

    /**
     * Get children of an employee up to a specified depth.
     *
     * @param int $employeeId
     * @param bool $onlyIds
     * @param int|null $depth
     * @return array
     */
    function get_employee_children_in_depth(int $employeeId, bool $onlyIds = false, ?int $depth = 1): array {
        $employees = Employee::query()->select('emp_id', 'emp_full_name', 'emp_reporting_to')->get()->groupBy('emp_reporting_to');
        $result = [];
        $findChildren = function (int $parentId, int $currentDepth) use (&$findChildren, &$result, $employees, $onlyIds, $depth) {
            // Stop when depth limit is reached
            if ($depth !== null && $currentDepth > $depth) {
                return;
            }

            foreach ($employees->get($parentId, collect()) as $employee) {
                $result[] = $onlyIds ? $employee->emp_id : $employee->toArray();
                $findChildren($employee->emp_id, $currentDepth + 1);
            }
        };
        $findChildren($employeeId, 1);
        return $result;
    }
}
