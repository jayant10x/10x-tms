<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectAndTaskActivityLog extends Model
{
    protected $table = 'project_and_task_activity_logs';
    public $timestamps = false;
    protected $primaryKey = 'pal_id';

    protected function casts(): array {
        return [
            'pal_activity_data' => 'array',
        ];
    }
    protected $fillable = [
        'pal_pro_id',
        'pal_prt_id',
        'pal_activity_slug',
        'pal_activity_data',
        'pal_activity_desc',
        'pal_performed_by',
        'pal_created_by',
        'pal_created_on',
    ];
}
