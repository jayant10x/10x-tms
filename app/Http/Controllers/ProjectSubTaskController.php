<?php

namespace App\Http\Controllers;

use App\Models\ProjectSubTask;
use Illuminate\Http\Request;

class ProjectSubTaskController extends Controller {
    public function storeSubTaskBulk(Request $request, $pro_task_id) {
        $sub_task_arr = [];

        $created_by = setCreatedUpdatedBy();
        $current_date = date(config('constants.DB_DATE_TIME_FORMAT'));

        if (!empty($request->sub_tasks)) {
            foreach ($request->sub_tasks as $sub_task) {
                $sub_task_arr[] = [
                    'pst_prt_id' => $pro_task_id,
                    'pst_sub_task_title' => $sub_task,
                    'pst_created_by' => $created_by,
                    'pst_created_on' => $current_date,
                ];
            }
            if (!empty($sub_task_arr)) {
                ProjectSubTask::query()->insert($sub_task_arr);
            }
            return true;
        }
        return false;
    }
}
