<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private string $_pre_col = 'pst_';

    public function up(): void {
        Schema::create('project_sub_tasks', function (Blueprint $table) {
            $table->bigInteger($this->_pre_col . 'id')->unsigned()->autoIncrement();

            $table->unsignedBigInteger($this->_pre_col . 'prt_id')->nullable()->comment('Project Task Id comes from project_tasks table.');
            $table->foreign($this->_pre_col . 'prt_id')->references('prt_id')->on('project_tasks')->nullOnDelete();

            $table->string($this->_pre_col . 'sub_task_title');
            $table->string($this->_pre_col . 'status')->nullable();
            $table->boolean($this->_pre_col . 'is_done')->default(false);
            get_created_updated_by_db_column($table, $this->_pre_col);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('project_sub_tasks');
    }
};
