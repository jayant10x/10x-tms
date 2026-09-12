<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model {
    protected $table = 'project_tasks';
    public $timestamps = false;
    protected $primaryKey = 'prt_id';
    protected $guarded = [];
}
