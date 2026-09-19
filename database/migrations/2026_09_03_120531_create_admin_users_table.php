<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private string $_pre_col = 'adm_';

    public function up(): void
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->bigInteger($this->_pre_col . 'id')->unsigned()->autoIncrement();
            $table->unsignedBigInteger($this->_pre_col . 'emp_id')->nullable()->comment('Employee ID comes from employee table.');
            $table->foreign($this->_pre_col . 'emp_id')->references('emp_id')->on('employees')->nullOnDelete();
            $table->string($this->_pre_col . 'name', 100);
            $table->string($this->_pre_col . 'user_name', 100);
            $table->enum($this->_pre_col . 'role', array_keys(config('constants.ROLES')));
            $table->string($this->_pre_col . 'password');
            $table->boolean($this->_pre_col . 'status')->default(1)->comment('1 - Active, 0 - Inactive');
            $table->string($this->_pre_col . 'photo')->nullable();
            $table->timestamp($this->_pre_col . 'last_activity_at')->nullable();
            $table->timestamp($this->_pre_col . 'panel_last_seen_at')->nullable();
            $table->boolean($this->_pre_col . 'panel_active')->default(false);
            get_created_updated_by_db_column($table, $this->_pre_col);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_users');
    }
};
