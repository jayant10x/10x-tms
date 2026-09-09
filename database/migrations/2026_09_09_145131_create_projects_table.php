<?php

use App\Enums\ProjectStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private $_pre_col = 'pro_';

    public function up(): void {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigInteger($this->_pre_col . 'id')->unsigned()->autoIncrement();
            $table->string($this->_pre_col . 'name', 100);
            $table->enum($this->_pre_col . 'status', array_column(ProjectStatus::cases(), 'value'));
            $table->unsignedBigInteger($this->_pre_col . 'manager')->nullable()->comment('Project Manager ID comes from employee table.');
            $table->foreign($this->_pre_col . 'manager')->references('emp_id')->on('employees')->nullOnDelete();
            $table->date($this->_pre_col. 'deadline')->nullable()->comment('Project Deadline');
            $table->text($this->_pre_col . 'description')->nullable()->comment('Project Description');
            get_created_updated_by_db_column($table, $this->_pre_col);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('projects');
    }
};
