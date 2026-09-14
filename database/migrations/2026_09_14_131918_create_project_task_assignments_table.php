<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private $_pre_col = 'pta_';

    public function up(): void {
        Schema::create('project_task_assignments', function (Blueprint $table) {
            $table->bigInteger($this->_pre_col . 'id')->unsigned()->autoIncrement();

            $table->unsignedBigInteger($this->_pre_col . 'prt_id')->nullable()->comment('Project Task Id comes from project_tasks table.');
            $table->foreign($this->_pre_col . 'prt_id', $this->_pre_col . 'task_id_foreign')->references('prt_id')->on('project_tasks')->nullOnDelete();

            $table->unsignedBigInteger($this->_pre_col . 'assign_by');
            $table->foreign($this->_pre_col . 'assign_by', $this->_pre_col . 'assign_by_foreign')->references('emp_id')->on('employees');

            $table->unsignedBigInteger($this->_pre_col . 'assign_to');
            $table->foreign($this->_pre_col . 'assign_to', $this->_pre_col . 'assign_to_foreign')->references('emp_id')->on('employees');

            $table->json($this->_pre_col . 'reports')->nullable()->comment('Task uploaded reports by assignee.');
            get_created_updated_by_db_column($table, $this->_pre_col);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('project_task_assignments');
    }
};
