<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller {
    public function index(Request $request) {
        $allProjectQuery = Project::query();
        if (!is_admin()) {
            $allProjectQuery->where('pro_manager', '=', get_logged_in_user_emp_id());
        }
        $all_projects = $allProjectQuery->get()->keyBy('pro_id')->toArray();
        return view('projects.all-projects', compact('all_projects'));
    }

    public function addProject() {
        $mode = 'add';
        return view('projects.add-edit-project', compact('mode'));
    }

    public function viewProject($pro_id) {
        $pro_id = my_decrypt($pro_id);
        $project_manager = [];
        $project_data = Project::query()->where('pro_id', '=', $pro_id)->first()->toArray();
        if (!empty($project_data['pro_manager'])) {
            $project_manager = get_employee_data($project_data['pro_manager']);
        }
        return view('projects.view-project', compact('project_data', 'project_manager', 'pro_id'));
    }

    public function saveProject(Request $request) {
        $request->validate([
            'project_name' => 'required|min:' . MIN_LENGTH . '|max:' . MAX_LENGTH_100,
            'project_desc' => 'nullable|min:' . MIN_LENGTH_10,
            'status' => 'required',
            'project_deadline' => 'required|date',
        ]);
        try {
            DB::beginTransaction();

            $project = new Project();
            $project->pro_name = $request->project_name;
            $project->pro_status = $request->status;
            $project->pro_manager = get_logged_in_user_emp_id();
            $project->pro_deadline = $request->project_deadline;
            $project->pro_description = $request->project_desc ?? null;
            $project->pro_created_by = setCreatedUpdatedBy();
            $project->pro_created_on = date(config('constants.DB_DATE_TIME_FORMAT'));

            if ($project->save()) {
                DB::commit();
                return redirect()->route('projects.list')->with('success', 'Project added successfully.');
            } else {
                return redirect()->route('projects.list')->with('error', 'Something went wrong.');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            return redirect()->route('projects.list')->with('error', 'Something went wrong.');
        }
    }


}
