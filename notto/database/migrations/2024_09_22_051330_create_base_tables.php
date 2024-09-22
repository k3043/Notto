<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uid')->constrained('users')->onDelete('cascade'); 
            $table->string('title');
            $table->string('description');
            $table->dateTime('deadline')->nullable();
            $table->enum('status', ['pending', 'completed', 'overdue'])->default('pending');
            $table->timestamps();
        });
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uid')->constrained('users')->onDelete('cascade'); 
            $table->string('title')->nullable()->default('No title');
            $table->text('content');
            $table->boolean('is_checked')->default(false);
            $table->timestamps();
        });
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks')->onDelete('cascade'); 
            $table->foreignId('uid')->constrained('users')->onDelete('cascade'); 
            $table->dateTime('reminder_time'); 
            $table->timestamps();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('notes');
        Schema::dropIfExists('reminders');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
