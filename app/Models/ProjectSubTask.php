<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectSubTask extends Model {
    protected $table = 'project_sub_tasks';
    public $timestamps = false;
    protected $primaryKey = 'pst_id';
    protected $guarded = [];
}
