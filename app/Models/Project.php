<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    public $timestamps = false;
    protected $primaryKey = 'pro_id';
    protected $guarded = [];

    protected $casts = [
        'pro_status' => ProjectStatus::class,
    ];

    public function tasks()
    {
        return $this->hasMany(ProjectTask::class, 'prt_pro_id', 'pro_id');
    }
}
