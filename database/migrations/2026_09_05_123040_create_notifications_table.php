<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private $_pre_col = 'not_';

    public function up(): void {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid($this->_pre_col . 'id')->primary();
            $table->string($this->_pre_col . 'type');
            $table->morphs($this->_pre_col . 'notifiable');
            $table->text($this->_pre_col . 'data');
            $table->timestamp($this->_pre_col . 'read_at')->nullable();
            get_created_updated_by_db_column($table, $this->_pre_col);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('notifications');
    }
};
