<?php

use App\Enums\TaskCategoryEnum;
use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private $_pre_col = 'prt_';

    public function up(): void {
        Schema::create('project_tasks', function (Blueprint $table) {
            $table->bigInteger($this->_pre_col . 'id')->unsigned()->autoIncrement();
            $table->string($this->_pre_col . 'title');

            $table->unsignedBigInteger($this->_pre_col . 'pro_id')->nullable()->comment('Project ID comes from projects table.');
            $table->foreign($this->_pre_col . 'pro_id')->references('pro_id')->on('projects')->nullOnDelete();

            $table->enum($this->_pre_col . 'category', array_column(TaskCategoryEnum::cases(), 'value'));
            $table->enum($this->_pre_col . 'priority', array_column(TaskPriority::cases(), 'value'));
            $table->enum($this->_pre_col . 'status', array_column(TaskStatus::cases(), 'value'));

            $table->date($this->_pre_col . 'start_date')->nullable()->comment('Task Start Date');
            $table->date($this->_pre_col . 'due_date')->nullable()->comment('Task Due Date');
            $table->string($this->_pre_col . 'est_hours', 20)->nullable()->comment('Task estimated hours to complete.');
            $table->json($this->_pre_col . 'tags')->nullable()->comment('Task tags.');
            $table->json($this->_pre_col . 'attachments')->nullable()->comment('Task attachments.');
            $table->text($this->_pre_col . 'description')->nullable()->comment('Task description.');
            get_created_updated_by_db_column($table, $this->_pre_col);
        });
    }

    public function down(): void {
        Schema::dropIfExists('project_tasks');
    }
};
