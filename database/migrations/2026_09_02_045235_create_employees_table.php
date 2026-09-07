<?php

use App\Enums\DepartmentsEnum;
use App\Enums\DesignationEnum;
use App\Enums\EmploymentType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    private $_pre_col = 'emp_';

    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigInteger($this->_pre_col . 'id')->unsigned()->autoIncrement();
            $table->string($this->_pre_col . 'internal_id', 10)->unique();
            $table->string($this->_pre_col . 'full_name', 255);
            $table->string($this->_pre_col . 'phone_number', 20)->nullable();
            $table->string($this->_pre_col . 'email', 300)->unique();
            $table->enum($this->_pre_col . 'employment_type', array_column(EmploymentType::cases(), 'value'));
            $table->enum($this->_pre_col . 'designation', array_column(DesignationEnum::cases(), 'value'));
            $table->enum($this->_pre_col . 'department', array_column(DepartmentsEnum::cases(), 'value'));
            $table->enum($this->_pre_col . 'sub_department', array_column(DepartmentsEnum::cases(), 'value'))->nullable();

            $table->unsignedBigInteger($this->_pre_col . 'reporting_to')->nullable();
            $table->foreign($this->_pre_col . 'reporting_to')->references($this->_pre_col . 'id')->on('employees')->nullOnDelete();

            $table->date($this->_pre_col . 'joining_date')->nullable();
            $table->boolean($this->_pre_col . 'status')->default(1)->comment('1 - Active, 0 - Inactive');
            $table->string($this->_pre_col . 'photo')->nullable();
            get_created_updated_by_db_column($table, $this->_pre_col);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
