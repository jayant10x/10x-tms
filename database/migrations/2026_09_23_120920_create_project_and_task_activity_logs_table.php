<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private $_pre_col = 'pal_';

    public function up(): void
    {
        Schema::create('project_and_task_activity_logs', function (Blueprint $table) {
            $table->bigInteger($this->_pre_col . 'id')->unsigned()->autoIncrement();

            $table->unsignedBigInteger($this->_pre_col . 'pro_id')->nullable()->comment('Project ID comes from projects table.');
            $table->foreign($this->_pre_col . 'pro_id')->references('pro_id')->on('projects')->nullOnDelete();

            $table->unsignedBigInteger($this->_pre_col . 'prt_id')->nullable()->comment('Project Task Id comes from project_tasks table.');
            $table->foreign($this->_pre_col . 'prt_id')->references('prt_id')->on('project_tasks')->nullOnDelete();

            $table->string($this->_pre_col . 'activity_slug');
            $table->json($this->_pre_col . 'activity_data');
            $table->text($this->_pre_col . 'activity_desc');

            $table->unsignedBigInteger($this->_pre_col . 'performed_by')->nullable()->comment('Performed By Id comes from admin_users table.');
            $table->foreign($this->_pre_col . 'performed_by')->references('adm_id')->on('admin_users')->nullOnDelete();

            get_created_updated_by_db_column($table, $this->_pre_col);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_and_task_activity_logs');
    }
};
