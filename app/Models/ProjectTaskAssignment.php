<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectTaskAssignment extends Model {
    protected $table = 'project_task_assignments';
    public $timestamps = false;
    protected $primaryKey = 'pta_id';
    protected $guarded = [];

    public function project_tasks() {
        return $this->hasMany(ProjectTask::class, 'prt_pro_id', 'pro_id');
    }
}
