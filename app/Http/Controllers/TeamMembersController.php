<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class TeamMembersController extends Controller {
    public function index() {
        if (is_admin()) {
            $all_team_members = Employee::query()->select('emp_id', 'emp_internal_id', 'emp_full_name', 'emp_email', 'emp_designation', 'emp_department', 'emp_sub_department', 'emp_joining_date', 'emp_status', 'emp_photo')->where('emp_status', '=', 1)->get()->keyBy('emp_id')->toArray();
        } else {
            $all_team_members = get_employee_children_in_depth((int)get_logged_in_user_emp_id());
        }
        return view('team-members.all-team-members', compact('all_team_members'));
    }
}
