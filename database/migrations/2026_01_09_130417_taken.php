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
        Schema::create('taken', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('omschrijving')->nullable();
            $table->dateTime('deadline');
            $table->enum('type', ['backend', 'frontend', 'API', 'AI', 'database', 'devops', 'testing', 'design', 'documentation', 'anders'])->default('anders');
            $table->enum('status', ['niet klaar', 'klaar'])->default('niet klaar');
            $table->enum('prioriteit', ['laag', 'medium', 'hoog'])->default('medium');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taken');
    }
};
