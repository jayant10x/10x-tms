<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{

    protected $table = 'employees';
    public $timestamps = false;
    protected $primaryKey = 'emp_id';
    protected $guarded = [];

    protected $casts = [
        'emp_department' => \App\Enums\DepartmentsEnum::class,
        'emp_sub_department' => \App\Enums\DepartmentsEnum::class,
        'emp_designation' => \App\Enums\DesignationEnum::class,
        'emp_employment_type' => \App\Enums\EmploymentType::class,
    ];


    public function reporting_to(): BelongsTo
    {
        // 'reporting_to' is the foreign key on this table pointing to the manager's ID
        return $this->belongsTo(Employee::class, 'emp_reporting_to');
    }

    /**
     * Get the subordinates (direct reports) for this employee.
     */
    public function subordinates(): HasMany
    {
        // 'reporting_to' is the foreign key on the child records pointing to this employee's ID
        return $this->hasMany(Employee::class, 'emp_reporting_to');
    }

    public function admin_user_details(): HasOne
    {
        return $this->hasOne(AdminUser::class, 'adm_emp_id', 'emp_id');
    }
}
