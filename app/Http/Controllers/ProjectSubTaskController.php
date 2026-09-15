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
                    'pst_title' => $sub_task,
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

    public function updateSubTaskIsDone(Request $request, $pst_id) {
        $pst_id = my_decrypt($pst_id);
        $prt_id = my_decrypt($request->task_id);
        $sub_task = ProjectSubTask::query()
            ->where('pst_id', $pst_id)
            ->where('pst_prt_id', $prt_id)
            ->first();

        if (!$sub_task) {
            return response()->json(['status' => false, 'message' => 'Sub task not found.',], 404);
        }
        $sub_task->pst_is_done = !$sub_task->pst_is_done;
        $sub_task->pst_updated_by = setCreatedUpdatedBy();
        $sub_task->pst_updated_on = date(config('constants.DB_DATE_TIME_FORMAT'));
        $sub_task->save();
        return response()->json(['status' => true, 'message' => 'Checklist updated successfully.', 'is_done' => $sub_task->pst_is_done,]);
    }

    public function addSubTask(Request $request, $prt_id) {
        $prt_id = my_decrypt($prt_id);
        $sub_task = trim($request->sub_task);

        // Check if sub-task already exists for this task
        $subTaskExist = ProjectSubTask::query()
            ->where('pst_prt_id', $prt_id)
            ->whereRaw('LOWER(TRIM(pst_title)) = ?', [strtolower($sub_task)])
            ->exists();

        if ($subTaskExist) {
            return response()->json([
                'status' => false,
                'message' => 'This sub task already exists.',
            ],);
        }

        // Create sub-task
        $subTaskObj = new ProjectSubTask();
        $subTaskObj->pst_prt_id = $prt_id;
        $subTaskObj->pst_title = $sub_task;
        $subTaskObj->pst_created_by = setCreatedUpdatedBy();
        $subTaskObj->pst_created_on = date(config('constants.DB_DATE_TIME_FORMAT'));
        $is_saved = $subTaskObj->save();

        if (!$is_saved) {
            return response()->json(['status' => false, 'message' => 'Sub task not created.',], 500);
        }

        return response()->json([
            'status' => true,
            'message' => 'Sub task added successfully.',
            'data' => [
                'pst_id' => my_encrypt($subTaskObj->pst_id),
                'pst_title' => $subTaskObj->pst_title,
                'pst_is_done' => false,
            ],
        ]);
    }

    public function deleteSubTask($pst_id, $prt_id) {
        $pst_id = my_decrypt($pst_id);
        $prt_id = my_decrypt($prt_id);

        $subTask = ProjectSubTask::query()
            ->where('pst_id', $pst_id)
            ->where('pst_prt_id', $prt_id)
            ->first();

        if (!$subTask) {
            return response()->json(['status' => false, 'message' => 'This sub task does not exist.',], 404);
        }

        $subTask->delete();

        return response()->json(['status' => true, 'message' => 'Sub task deleted successfully.',], 200);
    }
}
